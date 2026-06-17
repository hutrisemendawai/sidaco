<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Automatically generate bulk enumerator accounts.
     */
    public function storeBulkEnum(Request $request): RedirectResponse
    {
        $request->validate([
            'count' => ['required', 'integer', 'min:1', 'max:50'],
        ]);

        $count = (int) $request->count;
        $year = date('Y');
        $createdAccounts = [];

        for ($i = 0; $i < $count; $i++) {
            // Find a unique code sequence
            do {
                $random = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
                $identifier = 'enum' . $year . $random;
                $email = $identifier . '@seafdec.id';
                $exists = User::where('email', $email)->exists();
            } while ($exists);

            $user = User::create([
                'first_name' => $identifier,
                'middle_name' => null,
                'last_name' => '',
                'birth_date' => now()->format('Y-m-d'),
                'address' => '-',
                'phone_number' => '080000000000', // Pre-input safe dummy phone numbers that meet registration rules
                'email' => $email,
                'password' => Hash::make($identifier),
                'role' => 'enum',
                'country' => 'Indonesia',
                'province' => null,
                'district' => null,
                'sub_district' => null,
                'profile_photo_path' => null,
            ]);

            event(new Registered($user));
            $createdAccounts[] = $identifier;
        }

        return redirect(route('admin.users.index'))->with('success', $count . ' Enumerator accounts successfully auto-generated! Usernames: ' . implode(', ', $createdAccounts) . '. (Passwords are identical to their respective username, emails are username@seafdec.id).');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // This section validates the correct fields: first_name, last_name, etc.
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date'],
            'address' => ['required', 'string'],
            // Indonesian phone number format validation (starts with 08, 10-13 digits)
            'phone_number' => ['required', 'string', 'regex:/^08[0-9]{8,11}$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'country' => ['nullable', 'string', 'max:255'],
            'province' => ['nullable', 'string', 'max:255'],
            'district' => ['nullable', 'string', 'max:255'],
            'sub_district' => ['nullable', 'string', 'max:255'],
            'profile_photo' => ['nullable', 'string'],
        ]);

        $validated = $request->all();
        $profile_photo_path = null;

        if (isset($validated['profile_photo']) && $validated['profile_photo']) {
            $base64Image = $validated['profile_photo'];
            if (preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type)) {
                $imageContent = substr($base64Image, strpos($base64Image, ',') + 1);
                $type = strtolower($type[1]);

                if (in_array($type, ['jpg', 'jpeg', 'png', 'webp'])) {
                    $imageContent = base64_decode($imageContent);
                    $filename = 'profile-photos/' . uniqid() . '_' . \Illuminate\Support\Str::random(10) . '.' . $type;

                    \Illuminate\Support\Facades\Storage::disk('public')->put($filename, $imageContent);
                    $profile_photo_path = $filename;
                }
            }
        }

        // This section creates the user with the correct fields.
        $user = User::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'birth_date' => $request->birth_date,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'country' => $request->country,
            'province' => $request->province,
            'district' => $request->district,
            'sub_district' => $request->sub_district,
            'profile_photo_path' => $profile_photo_path,
        ]);

        event(new Registered($user));

        return redirect(route('admin.users.index'))->with('success', 'User created successfully.');
    }
}
