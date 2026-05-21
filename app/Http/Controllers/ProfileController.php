<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validated = $request->validated();

        if (isset($validated['profile_photo'])) {
            $base64Image = $validated['profile_photo'];
            if (preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type)) {
                $imageContent = substr($base64Image, strpos($base64Image, ',') + 1);
                $type = strtolower($type[1]); // jpg, png, etc

                if (in_array($type, ['jpg', 'jpeg', 'png', 'webp'])) {
                    $imageContent = base64_decode($imageContent);
                    $filename = 'profile-photos/' . $user->id . '_' . Str::random(10) . '.' . $type;

                    if ($user->profile_photo_path) {
                        Storage::disk('public')->delete($user->profile_photo_path);
                    }

                    Storage::disk('public')->put($filename, $imageContent);
                    $validated['profile_photo_path'] = $filename;
                }
            }
            unset($validated['profile_photo']);
        }

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
