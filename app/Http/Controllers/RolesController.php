<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Laravolt\Avatar\Facade as Avatar;
use RealRashid\SweetAlert\Facades\Alert;

class RolesController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'DESC')->paginate(8);
        $roles = Role::get();

        return view('pages.panel.role.index')->with('users', $users)->with('roles', $roles);
    }

    public function store(Request $request)
    {
        $path = storage_path('app/public/avatars/');
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }

        $jabatan = null;
        if ($request->role == 'director') {
            $jabatan = 'DIREKTUR';
        } elseif ($request->role == 'finance') {
            $jabatan = 'FINANCE';
        } else {
            $jabatan = 'STAFF';
        }

        $user = User::create([
            'nip' => $request->nip,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->addRole($request->role);

        $avatarDirectorName = 'avatar-' . $user->id . '-' . $user['name'] . '.png';
        Avatar::create($user->name)->save($path . $avatarDirectorName);
        Profile::create([
            'user_id' => $user->id,
            'avatar' => 'avatars/' . $avatarDirectorName,
            'jabatan' => $jabatan,
        ]);

        Alert::toast('Add new user role successfully!', 'success', ['icon' => 'success']);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    public function update(Request $request, $id, $locale)
    {
        dd($id);
        $user = User::find($id);
        dd($user);

        if ($request->password != null) {
            $user->update([
                'nip' => $request->nip,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        } else {
            $user->update([
                'nip' => $request->nip,
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }

        // $currentRole = $user->roles->first();
        // $user->detachRole($currentRole->name);

        // $newRole = $request->role;
        // $user->attachRole($newRole);

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
