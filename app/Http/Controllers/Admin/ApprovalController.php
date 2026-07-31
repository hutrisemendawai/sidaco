<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Models\SidatData;
use App\Models\Species;

class ApprovalController extends Controller
{
    public function index()
    {
        $adminCountry = $this->getAdminCountry();

        $pendingData = SidatData::with('user')
            ->where('isapproved', false)
            ->when($adminCountry, function ($query) use ($adminCountry) {
                $query->where('country', $adminCountry);
            }, function ($query) {
                $query->whereRaw('1 = 0');
            })
            ->latest('created_at')
            ->paginate(15);

        return view('admin.approvals.index', compact('pendingData'));
    }

    public function edit(SidatData $sidat)
    {
        $this->ensureAdminCountryAccess($sidat);

        $rivers = SidatData::distinct()->pluck('river');
        $speciesOptions = Species::active()->orderBy('name')->pluck('name');

        return view('admin.approvals.edit', compact('sidat', 'rivers', 'speciesOptions'));
    }

    public function update(Request $request, SidatData $sidat)
    {
        $this->ensureAdminCountryAccess($sidat);

        $activeSpeciesNames = Species::active()->pluck('name')->all();

        $validatedData = $request->validate([
            'date' => ['required', 'date'],
            'country' => ['required', 'string', Rule::in(['Indonesia', 'Philippines', 'Myanmar', 'Vietnam'])],
            'province' => ['required', 'string', 'max:255'],
            'regency' => ['required', 'string', 'max:255'],
            'district' => ['required', 'string', 'max:255'],
            'river' => ['required', 'string', 'max:255'],
            'stage' => ['required', 'string', 'max:255'],
            'fisher_name' => ['required', 'string', 'max:255'],
            'number_of_fisher' => ['required', 'numeric', 'min:0'],
            'type_of_fishing_gear' => ['required', 'string', 'max:255'],
            'number_of_fishing_gear' => ['required', 'integer', 'min:0'],
            'species_name' => ['required', 'string', 'max:255', Rule::in($activeSpeciesNames)],
            'operation_time' => ['required', 'numeric', 'min:0'],
            'total_weight_per_day' => ['required', 'numeric', 'min:0'],
            'price_per_kg' => ['required', 'numeric', 'min:0'],
            'fish_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5120'],
            'suhu' => ['nullable', 'numeric', 'min:-50', 'max:100'],
            'ph_air' => ['nullable', 'numeric', 'min:0', 'max:14'],
            'salinitas' => ['nullable', 'numeric', 'min:0', 'max:50'],
            'hujan' => ['nullable', 'boolean'],
            'stage_type' => ['nullable', 'string', 'in:Glasseel,Elver,Yellow Eel'],
            'sampling' => ['nullable', 'integer', 'min:0'],
        ]);

        $validatedData['country'] = $this->getAdminCountryOrAbort();

        // Handle fish photo upload
        if ($request->hasFile('fish_photo')) {
            if ($sidat->fish_photo && Storage::disk('public')->exists($sidat->fish_photo)) {
                Storage::disk('public')->delete($sidat->fish_photo);
            }
            $photo = $request->file('fish_photo');
            $filename = 'fish_' . time() . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('sidat_photos', $filename, 'public');
            $validatedData['fish_photo'] = 'sidat_photos/' . $filename;
        }

        // Handle photo removal
        if ($request->input('remove_photo') == '1' && !$request->hasFile('fish_photo')) {
            if ($sidat->fish_photo && Storage::disk('public')->exists($sidat->fish_photo)) {
                Storage::disk('public')->delete($sidat->fish_photo);
            }
            $validatedData['fish_photo'] = null;
        }

        $date = Carbon::parse($validatedData['date']);
        $validatedData['day'] = $date->format('l');
        $validatedData['month'] = $date->format('F');
        $validatedData['updated_by'] = Auth::id();
        $validatedData['hujan'] = $validatedData['hujan'] ?? false;

        // Handle approve-and-save vs save-only
        if ($request->has('approve')) {
            $validatedData['isapproved'] = true;
            $sidat->update($validatedData);
            return redirect()->route('admin.approvals.index')->with('success', 'Data has been updated and approved.');
        }

        $sidat->update($validatedData);
        return redirect()->route('admin.approvals.edit', $sidat)->with('success', 'Data updated successfully.');
    }

    public function approve(SidatData $sidat)
    {
        $this->ensureAdminCountryAccess($sidat);

        $sidat->update([
            'isapproved' => true,
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('admin.approvals.index')->with('success', 'Data has been approved successfully.');
    }

    public function reject(SidatData $sidat)
    {
        $this->ensureAdminCountryAccess($sidat);

        $sidat->delete();

        return redirect()->route('admin.approvals.index')->with('success', 'Data has been rejected and deleted.');
    }

    private function ensureAdminCountryAccess(SidatData $sidat): void
    {
        $country = $this->getAdminCountry();

        if (!$country || $sidat->country !== $country) {
            abort(403, 'Unauthorized action.');
        }
    }

    private function getAdminCountryOrAbort(): string
    {
        $country = $this->getAdminCountry();

        if (!$country) {
            abort(403, 'Unauthorized action.');
        }

        return $country;
    }

    private function getAdminCountry(): ?string
    {
        $country = Auth::user()?->country;

        if (!is_string($country)) {
            return null;
        }

        $country = trim($country);
        return $country !== '' ? $country : null;
    }
}
