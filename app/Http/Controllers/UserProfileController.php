<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class UserProfileController extends Controller
{
    public function show(User $user)
    {
        $roles = Role::all();
        return view('admin.users.show-profile',['user'=>$user,'roles'=>$roles]);
    }

    public function update(User $user)
    {

        $data = \request()->validate([
            'username' => ['required','min:3','string','max:255','alpha_dash'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email',],
            'avatar' => ['file'],
//            'password' => ['min:6','max:255','confirmed'],
        ]);

        if (\request('avatar'))
        {
            $data['avatar'] = \request('avatar')->store('images');
        }

        $user->update($data);

        Session::flash('profile-updated','Profile has been updated successfully');
        return back();
    }

    public function attachRole(User $user)
    {
        $user->roles()->attach(\request('user_role'));

        return back();
    }
    public function detachRole(User $user)
    {
        $user->roles()->detach(\request('user_role'));

        return back();
    }
}
