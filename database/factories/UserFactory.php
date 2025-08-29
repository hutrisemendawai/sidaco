<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'middle_name' => $this->faker->optional()->firstName(),
            'last_name' => $this->faker->lastName(),
            'birth_date' => $this->faker->date(),
            'email' => $this->faker->unique()->safeEmail(),
            'role' => 'user',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // default password
            'address' => $this->faker->address(),
            'phone_number' => $this->faker->phoneNumber(),
            'remember_token' => Str::random(10),
        ];
    }

    public function admin(): Factory
    {
        return $this->state(fn(array $attributes) => [
            'first_name' => 'Admin',
            'last_name' => 'Super',
            'birth_date' => '1990-01-01',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('password'), // password admin
        ]);
    }
}