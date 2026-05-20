<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample Administrator
        User::updateOrCreate(
            ['email' => 'admin@sidat.com'],
            [
                'first_name' => 'System',
                'middle_name' => 'Global',
                'last_name' => 'Administrator',
                'birth_date' => '1990-01-01',
                'role' => 'admin',
                'password' => Hash::make('password'),
                'address' => 'Sidat HQ, Jakarta',
                'phone_number' => '081234567890',
            ]
        );

        // Sample Enumerator (enum)
        User::updateOrCreate(
            ['email' => 'enum@sidat.com'],
            [
                'first_name' => 'John',
                'middle_name' => 'Data',
                'last_name' => 'Enumerator',
                'birth_date' => '1995-05-15',
                'role' => 'enum',
                'password' => Hash::make('password'),
                'address' => 'Field Office, Bandung',
                'phone_number' => '081298765432',
            ]
        );

        // Sample Standard User
        User::updateOrCreate(
            ['email' => 'user@sidat.com'],
            [
                'first_name' => 'Jane',
                'middle_name' => 'Common',
                'last_name' => 'Doe',
                'birth_date' => '1998-10-20',
                'role' => 'user',
                'password' => Hash::make('password'),
                'address' => 'Residential Area, Surabaya',
                'phone_number' => '081122334455',
            ]
        );
    }
}
