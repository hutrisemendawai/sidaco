<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class EnumeratorController extends Controller
{
    public function create()
    {
        return view('admin.enumerators.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $year = date('Y');
        $random = str_pad(mt_rand(1, 999), 3, '0', STR_PAD_LEFT);
        $randomName = 'enum' . $year . $random;

        User::create([
            'first_name' => $randomName,
            'last_name' => '',
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'enum',
        ]);

        return redirect()->route('admin.enumerator.create')->with('success', "Enumerator account ($randomName) created successfully.");
    }
}
