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
        'type',
        'fisherman_name',
        'type_of_fishing_gear',
        'number_of_fishing_gear',
        'species_name',
        'operation_time',
        'total_weight_per_day',
        'price_per_kg',
        'total_weight_per_fisher',
        'estimate_number_by_fisher_per_day',
        'total_weight_elver_kg',
        'price_elver',
        'total_weight_pk_kg',
        'price_pk',
        'total_weight_pb_kg',
        'price_pb',
        'total_weight_fingerling',
        'price_fingerling',
        'amount_individual_elver_size',
        'amount_individual_pk_size',
        'amount_individual_pb_size',
        'amount_individual_fingerling_size',
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
     * Get the user that owns the sidat data.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}