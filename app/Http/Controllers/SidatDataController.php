<?php

namespace App\Http\Controllers;

use App\Models\SidatData;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Exports\SidatDataExport;
use Maatwebsite\Excel\Facades\Excel;

class SidatDataController extends Controller
{
    /**
     * Display a listing of the resource with filtering and search.
     */
    public function index(Request $request)
    {
        if (Auth::user()->isEnum()) {
            abort(403, 'Enum accounts do not have access to view data.');
        }

        $query = SidatData::query()->with(['user', 'updatedBy'])->where('isapproved', true);

        if (!Auth::user()->isAdmin()) {
            $query->where('user_id', Auth::id());
        }

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('river', 'like', "%{$searchTerm}%")
                    ->orWhere('species_name', 'like', "%{$searchTerm}%")
                    ->orWhere('fisher_name', 'like', "%{$searchTerm}%")
                    ->orWhere('country', 'like', "%{$searchTerm}%")
                    ->orWhere('province', 'like', "%{$searchTerm}%")
                    ->orWhere('regency', 'like', "%{$searchTerm}%")
                    ->orWhere('district', 'like', "%{$searchTerm}%")
                    ->orWhere('type_of_fishing_gear', 'like', "%{$searchTerm}%");
            });
        }

        if ($request->filled('start_date')) {
            $query->where('date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->where('date', '<=', $request->end_date);
        }

        $sidatData = $query->latest('date')->paginate(15)->withQueryString();

        return view('sidat.index', compact('sidatData', 'request'));
    }

    /**
     * Handle the export request.
     */
    public function export(Request $request)
    {
        if (Auth::user()->isEnum()) {
            abort(403);
        }
        $fileName = 'sidat_data-' . now()->format('Y-m-d') . '.xlsx';
        return Excel::download(new SidatDataExport($request), $fileName);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->isEnum()) {
            abort(403);
        }
        $rivers = SidatData::distinct()->pluck('river');
        return view('sidat.create', compact('rivers'));
    }

    public function enumCreate()
    {
        $rivers = SidatData::distinct()->pluck('river');
        return view('sidat.create_enum', compact('rivers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
        ]);

        $date = Carbon::parse($validatedData['date']);
        $validatedData['day'] = $date->format('l');
        $validatedData['month'] = $date->format('F');
        $validatedData['user_id'] = Auth::id();
        $validatedData['updated_by'] = Auth::id();

        if (Auth::user()->isEnum()) {
            $validatedData['iscreatedbyenum'] = true;
            $validatedData['isapproved'] = false;
        } else {
            $validatedData['iscreatedbyenum'] = false;
            $validatedData['isapproved'] = true;
        }

        SidatData::create($validatedData);

        if (Auth::user()->isEnum()) {
            return redirect()->route('enum.sidat.create')->with('success', 'Tropical Anguillid Eel Data submitted for approval successfully!');
        }

        return redirect()->route('sidat.index')->with('success', 'Tropical Anguillid Eel Data added successfully!');
    }

    /**
     * Display the specified resource for logged-in users (not used publicly).
     */
    public function show(SidatData $sidat)
    {
        // Redirect to the public view instead
        return redirect()->route('sidat.public.show', $sidat);
    }

    /**
     * Display a public view of a single resource.
     */
    public function showPublic(SidatData $sidat)
    {
        if (!$sidat->isapproved) {
            abort(404, 'Data not found or not approved yet.');
        }
        $sidat->load(['user', 'updatedBy']);
        return view('sidat.show', compact('sidat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SidatData $sidat)
    {
        if (!Auth::user()->isAdmin() && $sidat->user_id !== Auth::id()) {
            abort(403, 'Unauthorized Action');
        }

        $rivers = SidatData::distinct()->pluck('river');
        return view('sidat.edit', compact('sidat', 'rivers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SidatData $sidat)
    {
        if (!Auth::user()->isAdmin() && $sidat->user_id !== Auth::id()) {
            abort(403, 'Unauthorized Action');
        }

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
        ]);

        $date = Carbon::parse($validatedData['date']);
        $validatedData['day'] = $date->format('l');
        $validatedData['month'] = $date->format('F');
        $validatedData['updated_by'] = Auth::id();

        $sidat->update($validatedData);

        return redirect()->route('sidat.index')->with('success', 'Tropical Anguillid Eel Data updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SidatData $sidat)
    {
        if (!Auth::user()->isAdmin() && $sidat->user_id !== Auth::id()) {
            abort(403, 'Unauthorized Action');
        }

        $sidat->delete();

        return redirect()->route('sidat.index')->with('success', 'Tropical Anguillid Eel Data deleted successfully!');
    }
}
