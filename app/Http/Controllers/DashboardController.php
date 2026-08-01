<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\SidatData;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the main dashboard view with chart data.
     */
    public function index(Request $request)
    {
        if (auth()->user()->isEnum()) {
            return redirect()->route('enum.sidat.create');
        }

        $userCountry = $this->getAuthenticatedUserCountry();
        $countryScopeMissing = $userCountry === null;

        // --- Filter Logic ---
        $selectedYear = $request->input('year');
        $selectedMonth = $request->input('month');
        $selectedProvince = $request->input('province');
        $selectedSpecies = $request->input('species');

        $cacheKey = implode(':', [
            'dashboard',
            'v2',
            auth()->id(),
            $userCountry ?? 'none',
            $selectedYear ?: 'all',
            $selectedMonth ?: 'all',
            $selectedProvince ?: 'all',
            $selectedSpecies ?: 'all',
        ]);

        $dashboardData = Cache::remember($cacheKey, now()->addMinutes(10), function () use (
            $userCountry,
            $selectedYear,
            $selectedMonth,
            $selectedProvince,
            $selectedSpecies
        ) {
            $scopedApprovedQuery = SidatData::query()->where('isapproved', true);
            $this->applyCountryScope($scopedApprovedQuery, $userCountry);

            $query = clone $scopedApprovedQuery;

            if ($selectedYear) {
                $query->whereRaw("strftime('%Y', date) = ?", [$selectedYear]);
            }
            if ($selectedMonth) {
                $query->whereRaw("strftime('%m', date) = ?", [str_pad((string) $selectedMonth, 2, '0', STR_PAD_LEFT)]);
            }
            if ($selectedProvince) {
                $query->where('province', $selectedProvince);
            }
            if ($selectedSpecies) {
                $query->where('species_name', $selectedSpecies);
            }

            // --- Data for Animated Counters ---
            $totalEntries = (clone $query)->count();
            $totalWeightThisYear = (clone $query)->whereRaw("strftime('%Y', date) = ?", [now()->year])->sum('total_weight_per_day');
            $uniqueCountry = (clone $query)->distinct('country')->count('country');

            // --- Filter dropdown data (country-scoped) ---
            $filterYears = (clone $scopedApprovedQuery)
                ->select(DB::raw("strftime('%Y', date) as year"))
                ->distinct()
                ->orderBy('year', 'desc')
                ->pluck('year')
                ->toArray();

            $filterProvinces = (clone $scopedApprovedQuery)
                ->when($selectedYear, fn($q) => $q->whereRaw("strftime('%Y', date) = ?", [$selectedYear]))
                ->when($selectedMonth, fn($q) => $q->whereRaw("strftime('%m', date) = ?", [str_pad((string) $selectedMonth, 2, '0', STR_PAD_LEFT)]))
                ->select('province')
                ->whereNotNull('province')
                ->where('province', '!=', '')
                ->distinct()
                ->orderBy('province')
                ->pluck('province')
                ->toArray();

            $filterSpecies = (clone $scopedApprovedQuery)
                ->when($selectedYear, fn($q) => $q->whereRaw("strftime('%Y', date) = ?", [$selectedYear]))
                ->when($selectedMonth, fn($q) => $q->whereRaw("strftime('%m', date) = ?", [str_pad((string) $selectedMonth, 2, '0', STR_PAD_LEFT)]))
                ->select('species_name')
                ->whereNotNull('species_name')
                ->where('species_name', '!=', '')
                ->distinct()
                ->orderBy('species_name')
                ->pluck('species_name')
                ->toArray();

            // --- Chart Data (filtered and country-scoped) ---
            $yearlyData = (clone $query)->select(
                DB::raw("strftime('%Y', date) as year"),
                DB::raw('SUM(total_weight_per_day) as total_weight')
            )
                ->groupBy(DB::raw("strftime('%Y', date)"))
                ->orderBy(DB::raw("strftime('%Y', date)"), 'asc')
                ->get();

            $monthlyData = (clone $query)->select(
                DB::raw("strftime('%Y', date) as year"),
                DB::raw("strftime('%m', date) as month"),
                DB::raw('SUM(total_weight_per_day) as total_weight')
            )
                ->groupBy(DB::raw("strftime('%Y', date)"), DB::raw("strftime('%m', date)"))
                ->orderBy(DB::raw("strftime('%Y', date)"), 'asc')
                ->orderBy(DB::raw("strftime('%m', date)"), 'asc')
                ->get();

            $yearlyCatchLabels = $yearlyData->map(fn($item) => Carbon::createFromDate($item->year)->format('Y'))->toArray();
            $yearlyCatchData = $yearlyData->pluck('total_weight')->toArray();

            $monthlyCatchLabels = $monthlyData->map(fn($item) => Carbon::createFromDate($item->year, $item->month)->format('F Y'))->toArray();
            $monthlyCatchData = $monthlyData->pluck('total_weight')->toArray();

            $speciesData = (clone $query)->select('species_name', DB::raw('COUNT(*) as count'))->groupBy('species_name')->orderBy('count', 'desc')->limit(5)->get();
            $speciesLabels = $speciesData->pluck('species_name')->toArray();
            $speciesCounts = $speciesData->pluck('count')->toArray();

            $countryData = (clone $query)->select('country', DB::raw('COUNT(*) as count'))->groupBy('country')->orderBy('count', 'desc')->limit(7)->get();
            $countryLabels = $countryData->pluck('country')->toArray();
            $countryCounts = $countryData->pluck('count')->toArray();

            $provinceData = (clone $query)->select('province', DB::raw('COUNT(*) as count'))->groupBy('province')->orderBy('count', 'desc')->limit(7)->get();
            $provinceLabels = $provinceData->pluck('province')->toArray();
            $provinceCounts = $provinceData->pluck('count')->toArray();

            $fishermanData = (clone $query)->select('fisher_name', DB::raw('COUNT(*) as count'))->groupBy('fisher_name')->orderBy('count', 'desc')->limit(5)->get();
            $fishermanLabels = $fishermanData->pluck('fisher_name')->toArray();
            $fishermanCounts = $fishermanData->pluck('count')->toArray();

            $stageData = (clone $query)->select('stage', DB::raw('SUM(total_weight_per_day) as total_weight'))->groupBy('stage')->orderBy('total_weight', 'desc')->get();
            $stageLabels = $stageData->pluck('stage')->toArray();
            $stageWeights = $stageData->pluck('total_weight')->toArray();

            $riverData = (clone $query)->select('river', DB::raw('SUM(total_weight_per_day) as total_weight'))->groupBy('river')->orderBy('total_weight', 'desc')->limit(5)->get();
            $riverLabels = $riverData->pluck('river')->toArray();
            $riverWeights = $riverData->pluck('total_weight')->toArray();

            $totalOfFisherData = (clone $query)->select('river', DB::raw('SUM(number_of_fisher) as total_of_fisher'))->groupBy('river')->orderBy('total_of_fisher', 'desc')->limit(5)->get();
            $totalOfFisherLabels = $totalOfFisherData->pluck('river')->toArray();
            $TotalOfFisherCounts = $totalOfFisherData->pluck('total_of_fisher')->toArray();

            return compact(
                'totalEntries',
                'totalWeightThisYear',
                'uniqueCountry',
                'yearlyCatchLabels',
                'yearlyCatchData',
                'monthlyCatchLabels',
                'monthlyCatchData',
                'speciesLabels',
                'speciesCounts',
                'countryLabels',
                'countryCounts',
                'provinceLabels',
                'provinceCounts',
                'fishermanLabels',
                'fishermanCounts',
                'stageLabels',
                'stageWeights',
                'riverLabels',
                'riverWeights',
                'filterYears',
                'filterProvinces',
                'filterSpecies',
                'totalOfFisherLabels',
                'TotalOfFisherCounts'
            );
        });

        return view('dashboard', array_merge($dashboardData, [
            'selectedYear' => $selectedYear,
            'selectedMonth' => $selectedMonth,
            'selectedProvince' => $selectedProvince,
            'selectedSpecies' => $selectedSpecies,
            'countryScopeMissing' => $countryScopeMissing,
            'userCountry' => $userCountry,
            'request' => $request,
        ]));
    }

    public function getProvinces($country)
    {
        $userCountry = $this->getAuthenticatedUserCountry();

        if (!$userCountry || $country !== $userCountry) {
            return response()->json([]);
        }

        $provinces = SidatData::where('isapproved', true)
            ->where('country', $userCountry)
            ->select('province')
            ->whereNotNull('province')
            ->where('province', '!=', '')
            ->distinct()
            ->orderBy('province')
            ->pluck('province');

        return response()->json($provinces);
    }

    private function applyCountryScope($query, ?string $country): void
    {
        if (!$country) {
            $query->whereRaw('1 = 0');
            return;
        }

        $query->where('country', $country);
    }

    private function getAuthenticatedUserCountry(): ?string
    {
        $country = auth()->user()?->country;

        if (!is_string($country)) {
            return null;
        }

        $country = trim($country);
        return $country !== '' ? $country : null;
    }
}
