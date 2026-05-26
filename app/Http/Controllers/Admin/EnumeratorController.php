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
        if ($request->has('multiple') && $request->multiple == 'on') {
            $request->validate([
                'count' => ['required', 'integer', 'min:2', 'max:30'],
            ]);

            $count = $request->count;
            $usernames = [];

            for ($i = 0; $i < $count; $i++) {
                $user = $this->createEnumerator();
                $usernames[] = $user['username'];
            }

            return redirect()->route('admin.enumerator.create')->with('success', $count . " Enumerator accounts created successfully. Usernames: " . implode(', ', $usernames) . ". (Password is same as username)");
        }

        // Single account logic
        $firstName = $request->first_name;
        $middleName = $request->middle_name;
        $lastName = $request->last_name;

        $user = $this->createEnumerator($firstName, $middleName, $lastName);

        return redirect()->route('admin.enumerator.create')->with('success', "Enumerator account created successfully. Username/Password: " . $user['username']);
    }

    private function createEnumerator($firstName = null, $middleName = null, $lastName = null)
    {
        $year = date('Y');

        // Loop until we find a unique username/email
        do {
            $random = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
            $username = 'enum' . $year . $random;
            $email = $username . '@seafdec.id';

            $exists = User::where('email', $email)->exists();
        } while ($exists);

        // Create the user
        $user = User::create([
            'first_name' => $firstName ?? $username,
            'middle_name' => $middleName,
            'last_name' => $lastName ?? '',
            'email' => $email,
            'password' => Hash::make($username),
            'role' => 'enum',
            'birth_date' => now(), // Required field in migration
            'address' => '-',      // Required field in migration
            'phone_number' => '-', // Required field in migration
        ]);

        return ['user' => $user, 'username' => $username];
    }
}
