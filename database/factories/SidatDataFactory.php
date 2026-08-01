<?php

namespace Database\Factories;

use App\Models\SidatData;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SidatDataFactory extends Factory
{
    protected $model = SidatData::class;

    public function definition(): array
    {
        $date = $this->faker->dateTimeBetween('-1 year', 'now');

        return [
            'user_id' => User::factory(),
            'date' => $date->format('Y-m-d'),
            'day' => $date->format('l'),
            'month' => $date->format('F'),
            'country' => $this->faker->randomElement(['Indonesia', 'Philippines', 'Myanmar', 'Vietnam']),
            'province' => $this->faker->word(),
            'regency' => $this->faker->word(),
            'district' => $this->faker->word(),
            'river' => $this->faker->word(),
            'stage' => 'Elver',
            'fisher_name' => $this->faker->name(),
            'number_of_fisher' => 3,
            'type_of_fishing_gear' => 'Net',
            'number_of_fishing_gear' => 2,
            'species_name' => 'Anguilla bicolor',
            'operation_time' => 4.5,
            'total_weight_per_day' => 12.8,
            'price_per_kg' => 200000,
            'iscreatedbyenum' => false,
            'isapproved' => true,
            'updated_by' => function (array $attributes) {
                return $attributes['user_id'];
            },
        ];
    }
}
