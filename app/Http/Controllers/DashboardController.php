<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\SidatData;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the main dashboard view with chart data.
     */
    public function index(Request $request): View
    {
        // --- Filter Logic ---
        $selectedYear = $request->input('year');
        $selectedMonth = $request->input('month');
        $selectedProvince = $request->input('province');
        $selectedSpecies = $request->input('species');

        $query = SidatData::query();

        if ($selectedYear) {
            $query->whereYear('date', $selectedYear);
        }
        if ($selectedMonth) {
            $query->whereMonth('date', $selectedMonth);
        }
        if ($selectedProvince) {
            $query->where('province', $selectedProvince);
        }
        if ($selectedSpecies) {
            $query->where('species_name', $selectedSpecies);
        }

        // --- Data for Animated Counters ---
        $totalEntries = (clone $query)->count();
        $totalWeightThisYear = (clone $query)->whereYear('date', now()->year)->sum('total_weight_per_day');
        $uniqueFishermen = (clone $query)->distinct('fisherman_name')->count('fisherman_name');


        // --- Data for Filter Dropdowns ---
        $filterYears = SidatData::select(DB::raw('YEAR(date) as year'))->distinct()->orderBy('year', 'desc')->pluck('year');
        $filterProvinces = SidatData::select('province')->distinct()->orderBy('province')->pluck('province');
        $filterSpecies = SidatData::select('species_name')->distinct()->orderBy('species_name')->pluck('species_name');

        // --- Chart Data (using the filtered query) ---
        $monthlyData = (clone $query)->select(
                DB::raw('YEAR(date) as year'),
                DB::raw('MONTH(date) as month'),
                DB::raw('SUM(total_weight_per_day) as total_weight')
            )
            ->groupBy(DB::raw('YEAR(date)'), DB::raw('MONTH(date)'))
            ->orderBy(DB::raw('YEAR(date)'), 'asc')
            ->orderBy(DB::raw('MONTH(date)'), 'asc')
            ->get();

        $monthlyCatchLabels = $monthlyData->map(fn($item) => Carbon::createFromDate($item->year, $item->month)->format('F Y'));
        $monthlyCatchData = $monthlyData->pluck('total_weight');
        
        $speciesData = (clone $query)->select('species_name', DB::raw('COUNT(*) as count'))->groupBy('species_name')->orderBy('count', 'desc')->limit(5)->get();
        $speciesLabels = $speciesData->pluck('species_name');
        $speciesCounts = $speciesData->pluck('count');
        
        $provinceData = (clone $query)->select('province', DB::raw('COUNT(*) as count'))->groupBy('province')->orderBy('count', 'desc')->limit(7)->get();
        $provinceLabels = $provinceData->pluck('province');
        $provinceCounts = $provinceData->pluck('count');
        
        $fishermanData = (clone $query)->select('fisherman_name', DB::raw('COUNT(*) as count'))->groupBy('fisherman_name')->orderBy('count', 'desc')->limit(5)->get();
        $fishermanLabels = $fishermanData->pluck('fisherman_name');
        $fishermanCounts = $fishermanData->pluck('count');

        $stageData = (clone $query)->select('stage', DB::raw('SUM(total_weight_per_day) as total_weight'))->groupBy('stage')->orderBy('total_weight', 'desc')->get();
        $stageLabels = $stageData->pluck('stage');
        $stageWeights = $stageData->pluck('total_weight');

        $riverData = (clone $query)->select('river', DB::raw('SUM(total_weight_per_day) as total_weight'))->groupBy('river')->orderBy('total_weight', 'desc')->limit(5)->get();
        $riverLabels = $riverData->pluck('river');
        $riverWeights = $riverData->pluck('total_weight');

        return view('dashboard', compact(
            'totalEntries', 'totalWeightThisYear', 'uniqueFishermen',
            'monthlyCatchLabels', 'monthlyCatchData',
            'speciesLabels', 'speciesCounts',
            'provinceLabels', 'provinceCounts',
            'fishermanLabels', 'fishermanCounts',
            'stageLabels', 'stageWeights',
            'riverLabels', 'riverWeights',
            'filterYears', 'filterProvinces', 'filterSpecies',
            'selectedYear', 'selectedMonth', 'selectedProvince', 'selectedSpecies',
            'request' // <-- FIX: Pass the request object to the view
        ));
    }
}
