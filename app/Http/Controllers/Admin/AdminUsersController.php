<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminUsersController extends Controller
{
    public function index()
    {
        $users = User::paginate(12);
        return view('admin.users.index',['users'=>$users]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        Session::flash('user-deleted','User with Email: "' .$user->email. '" has been deleted');
        return back();
    }
}
