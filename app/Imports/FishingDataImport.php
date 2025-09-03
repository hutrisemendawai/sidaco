<?php

namespace App\Imports;

use App\Models\SidatData;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FishingDataImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Pastikan header di CSV sesuai dengan key di bawah ini
        $date = Carbon::parse($row['date']);

        return new SidatData([
            'user_id'               => 1, // default 1
            'date'                  => $date->format('Y-m-d') ?? '1945-01-01',
            'day'                   => $date->format('l'),  // Monday, Tuesday
            'month'                 => $date->format('F'),  // January, February
            'country'               => $row['country'] ?? 'NA',
            'province'              => $row['province'] ?? 'NA',
            'regency'               => $row['regency'] ?? 'NA',
            'district'              => $row['district'] ?? 'NA',
            'river'                 => $row['river'] ?? 'NA',
            'stage'                 => $row['stage'] ?? 'NA',
            'fisher_name'           => $row['fisher_name'] ?? 'NA',
            'number_of_fisher'      => $row['number_of_fisher'] ?? 0,
            'type_of_fishing_gear'  => $row['type_of_fishing_gear'] ?? 'NA',
            'number_of_fishing_gear' => $row['number_of_fishing_gear'] ?? 0,
            'species_name'          => $row['species_name'] ?? 'NA',
            'operation_time'        => $row['operation_time'] ?? 0,
            'total_weight_per_day'  => $row['total_weight_per_day'] ?? 0,
            'price_per_kg'          => $row['price_per_kg'] ?? 0,
            'created_at'            => now(),
            'updated_at'            => now(),
        ]);
    }
}