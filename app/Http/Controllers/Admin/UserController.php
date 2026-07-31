<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of all users for the admin.
     */
    public function index(Request $request)
    {
        $users = User::query()
            ->where('id', '!=', Auth::id());

        if ($request->filled('q')) {
            $search = trim((string) $request->string('q'));
            $users->where(function ($query) use ($search) {
                $query->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhereRaw("CONCAT(first_name, ' ', COALESCE(last_name, '')) like ?", ["%{$search}%"])
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $users->paginate(5)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Update the role of a specific user.
     */
    public function updateRole(Request $request, User $user)
    {
        // Prevent an admin from changing their own role on this form
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.users.index')->with('error', 'You cannot change your own role.');
        }

        // Validate the incoming request
        $validated = $request->validate([
            'role' => ['required', Rule::in(['admin', 'user', 'enum'])],
        ]);

        // Update the user's role
        $user->role = $validated['role'];
        $user->save();

        return redirect()->route('admin.users.index')->with('success', "{$user->first_name}'s role has been updated.");
    }

    /**
     * Update a specific user's password.
     */
    public function updatePassword(Request $request, User $user)
    {
        if ($user->id === Auth::id()) {
            return redirect()->route('admin.users.index')->with('error', 'Use profile settings to change your own password.');
        }

        $validated = $request->validateWithBag('adminUpdatePassword', [
            'target_user_id' => ['nullable', 'integer'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.users.index')->with('success', "{$user->first_name}'s password has been updated.");
    }
}
