<?php

namespace App\Exports;

use App\Models\SidatData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SidatDataExport implements FromQuery, WithHeadings, WithMapping
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function query()
    {
        $query = SidatData::query()->with('user');

        if (!Auth::user()->isAdmin()) {
            $query->where('user_id', Auth::id());
        }

        if ($this->request->filled('search')) {
            $searchTerm = $this->request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('river', 'like', "%{$searchTerm}%")
                    ->orWhere('species_name', 'like', "%{$searchTerm}%")
                    ->orWhere('fisher_name', 'like', "%{$searchTerm}%");
            });
        }

        if ($this->request->filled('start_date')) {
            $query->where('date', '>=', $this->request->start_date);
        }
        if ($this->request->filled('end_date')) {
            $query->where('date', '<=', $this->request->end_date);
        }

        return $query->latest('date');
    }


    public function headings(): array
    {
        return [
            'ID',
            'User',
            'Date',
            'Day',
            'Month',
            'Country',
            'Province',
            'District',
            'River',
            'Stage',
            'Type',
            'Fisherman Name',
            'Type of Fishing Gear',
            'Number of Fishing Gear',
            'Species Name',
            'Operation Time (hours/day)',
            'Total Weight (Kg/day)',
            'Price (per kg)',
            'Total Weight (per Fisher)',
            'Estimate Number by Fisher (per Day)',
            'Total Weight Elver (kg)',
            'Price Elver',
            'Total Weight PK (kg)',
            'Price PK',
            'Total Weight PB (kg)',
            'Price PB',
            'Total Weight Fingerling',
            'Price Fingerling',
            'Amount Individual Elver Size',
            'Amount Individual PK Size',
            'Amount Individual PB Size',
            'Amount Individual Fingerling Size',
            'Created At',
        ];
    }


    public function map($data): array
    {
        return [
            $data->id,
            $data->user->first_name . ' ' . $data->user->last_name,
            $data->date->format('Y-m-d'),
            $data->day,
            $data->month,
            $data->country,
            $data->province,
            $data->district,
            $data->river,
            $data->stage,
            $data->type,
            $data->fisher_name,
            $data->type_of_fishing_gear,
            $data->number_of_fishing_gear,
            $data->species_name,
            $data->operation_time,
            $data->total_weight_per_day,
            $data->price_per_kg,
            $data->total_weight_per_fisher,
            $data->estimate_number_by_fisher_per_day,
            $data->total_weight_elver_kg,
            $data->price_elver,
            $data->total_weight_pk_kg,
            $data->price_pk,
            $data->total_weight_pb_kg,
            $data->price_pb,
            $data->total_weight_fingerling,
            $data->price_fingerling,
            $data->amount_individual_elver_size,
            $data->amount_individual_pk_size,
            $data->amount_individual_pb_size,
            $data->amount_individual_fingerling_size,
            optional($data->created_at)->format('Y-m-d H:i:s'),
        ];
    }
}
