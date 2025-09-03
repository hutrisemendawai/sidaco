<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat 1 user admin
        User::factory()->admin()->create();

        // Buat user biasa contoh
        //User::factory(10)->create();
    }
}