<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of all users for the admin.
     */
    public function index()
    {
        // Get all users except for the currently logged-in admin
        $users = User::where('id', '!=', Auth::id())->get();

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
            'role' => ['required', Rule::in(['admin', 'user'])],
        ]);

        // Update the user's role
        $user->role = $validated['role'];
        $user->save();

        return redirect()->route('admin.users.index')->with('success', "{$user->first_name}'s role has been updated.");
    }
}
