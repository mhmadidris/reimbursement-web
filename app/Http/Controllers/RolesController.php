<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class RolesController extends Controller
{
    public function index()
    {
        $users = User::whereHas('roles', function ($query) {
            $query->whereNotIn('name', ['customer']);
        })->paginate(10);
        $roles = Role::whereNotIn('name', ['customer'])->get();

        return view('pages.panel.role.index')->with('users', $users)->with('roles', $roles);
    }

    public function store(Request $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $user->addRole($request->role);

            Alert::toast('Add new user role successfully!', 'success', ['icon' => 'success']);
        } catch (\Exception $e) {
            Alert::toast('Failed to add new user role. Please try again.', 'error', ['icon' => 'error']);
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $currentRole = $user->roles->first();
        $user->detachRole($currentRole->name);

        $newRole = $request->role;
        $user->attachRole($newRole);

        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $user = User::find($request->userId);

        if ($user) {
            try {
                $user->roles()->detach();
                $user->delete();
                Alert::toast('User deleted successfully!', 'success', ['icon' => 'success']);
            } catch (\Exception $e) {
                Alert::toast('Failed to delete user. Please try again.', 'error', ['icon' => 'error']);
            }
        } else {
            Alert::toast('User not found.', 'error', ['icon' => 'error']);
        }

        return redirect()->back();
    }
}