<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\SidatData;

class ApprovalController extends Controller
{
    public function index()
    {
        $pendingData = SidatData::with('user')
            ->where('isapproved', false)
            ->latest('created_at')
            ->paginate(15);

        return view('admin.approvals.index', compact('pendingData'));
    }

    public function edit(SidatData $sidat)
    {
        $rivers = SidatData::distinct()->pluck('river');
        return view('admin.approvals.edit', compact('sidat', 'rivers'));
    }

    public function update(Request $request, SidatData $sidat)
    {
        $validatedData = $request->validate([
            'date' => ['required', 'date'],
            'country' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'regency' => ['required', 'string', 'max:255'],
            'district' => ['required', 'string', 'max:255'],
            'river' => ['required', 'string', 'max:255'],
            'stage' => ['required', 'string', 'max:255'],
            'fisher_name' => ['required', 'string', 'max:255'],
            'number_of_fisher' => ['required', 'numeric', 'min:0'],
            'type_of_fishing_gear' => ['required', 'string', 'max:255'],
            'number_of_fishing_gear' => ['required', 'integer', 'min:0'],
            'species_name' => ['required', 'string', 'max:255'],
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
        $sidat->update([
            'isapproved' => true,
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('admin.approvals.index')->with('success', 'Data has been approved successfully.');
    }

    public function reject(SidatData $sidat)
    {
        $sidat->delete();

        return redirect()->route('admin.approvals.index')->with('success', 'Data has been rejected and deleted.');
    }
}
