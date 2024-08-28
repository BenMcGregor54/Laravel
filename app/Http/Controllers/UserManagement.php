<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class UserManagement extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request, $id): View
    {
        $user = User::findOrFail($id); // Fetch the user by ID
        return view('adminview.pages.editUser', [
            'user' => $user,
        ]);
    }

    /**
     * Display the list of users.
     */
    public function userManagement()
    {
        $users = User::all();
        return view('adminview.pages.userManagement', ['users' => $users]);
    }

    /**
     * Display the form for editing a specific user by ID.
     */
    public function singleUserManagement($id)
    {
        $user = User::findOrFail($id);
        return view('adminview.pages.editUser', ['user' => $user]);
    }

    /**
     * Update the specified user's profile.
     */
    public function updateUser(ProfileUpdateRequest $request, $id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $user->fill($request->validated());

        $user->save();

        return Redirect::route('user.management')->with('status', 'profile-updated');
    }
    public function destroy(Request $request): RedirectResponse
    {

        $user = $request->user();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();



        return Redirect::to('dashboard');
    }
}
