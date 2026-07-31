<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Species;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SpeciesController extends Controller
{
    public function index(Request $request)
    {
        $query = Species::query()->orderBy('name');

        if ($request->filled('q')) {
            $search = trim($request->string('q'));
            $query->where('name', 'like', "%{$search}%");
        }

        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            }

            if ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $species = $query->paginate(20)->withQueryString();

        return view('admin.species.index', compact('species'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:species,name'],
        ]);

        Species::create([
            'name' => trim($validated['name']),
            'is_active' => true,
        ]);

        return redirect()->route('admin.species.index')->with('success', 'Species added successfully.');
    }

    public function update(Request $request, Species $species)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('species', 'name')->ignore($species->id),
            ],
        ]);

        $species->update([
            'name' => trim($validated['name']),
        ]);

        return redirect()->route('admin.species.index')->with('success', 'Species updated successfully.');
    }

    public function destroy(Species $species)
    {
        $species->delete();

        return redirect()->route('admin.species.index')->with('success', 'Species deleted successfully.');
    }

    public function toggleStatus(Species $species)
    {
        $species->update([
            'is_active' => !$species->is_active,
        ]);

        $status = $species->is_active ? 'activated' : 'deactivated';

        return redirect()->route('admin.species.index')->with('success', "Species {$status} successfully.");
    }
}
