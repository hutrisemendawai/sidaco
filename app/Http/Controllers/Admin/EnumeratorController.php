<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EnumeratorController extends Controller
{
    public function create()
    {
        return view('admin.enumerators.create');
    }

    public function store(Request $request)
    {
        $year = date('Y');

        // Loop until we find a unique username/email
        do {
            $random = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
            $username = 'enum' . $year . $random;
            $email = $username . '@seafdec.id';

            $exists = User::where('email', $email)->exists();
        } while ($exists);

        // Create the user with all required fields from the migration
        $user = User::create([
            'first_name' => $username,
            'middle_name' => null,
            'last_name' => '',
            'email' => $email,
            'password' => Hash::make($username),
            'role' => 'enum',
            'birth_date' => now(), // Required field in migration
            'address' => '-',      // Required field in migration
            'phone_number' => '-', // Required field in migration
        ]);

        return redirect()->route('admin.enumerator.create')->with('success', "Enumerator account created successfully. Username/Password: $username");
    }
}
