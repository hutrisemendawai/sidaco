<?php
// app/Models/SidatData.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SidatData extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sidat_data';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'date',
        'day',
        'month',
        'country',
        'province',
        'district',
        'river',
        'stage',
        'fisher_name',
        'type_of_fishing_gear',
        'number_of_fishing_gear',
        'species_name',
        'operation_time',
        'total_weight_per_day',
        'price_per_kg',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'date',
    ];

    /**
     * Get the user that owns the Tropical Anguillid Eel Data.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}