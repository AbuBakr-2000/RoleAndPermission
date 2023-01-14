<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', ['roles' => $roles]);
    }

    public function store()
    {
        request()->validate([
            'name' => ['required', 'min:3', 'max:20'],
        ]);
        Role::create([
            'name' => Str::ucfirst(\request('name')),
            'slug' => Str::of(Str::lower(request('name')))->slug('-'),
        ]);

        return back();
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit', [
            'role' => $role,
            'permissions'=>$permissions
        ]);
    }

    public function update(Role $role)
    {
        request()->validate([
            'name' => ['required', 'min:3', 'max:20'],
        ]);
        $role->name = Str::ucfirst(request('name'));
        $role->slug = Str::of(Str::lower(request('name')))->slug('-');

        if ($role->isDirty('name')) {
            Session::flash('role-updated', 'Role "' . $role->name . '" has been updated');

            $role->save();
        }
        else{
            Session::flash('role-updated', 'Nothing has been updated');
        }

        return redirect()->route('roles.index');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        Session::flash('role-deleted', 'Role "' . $role->name . '" has been deleted');
        return back();
    }

    public function attachPermission(Role $role)
    {
        $role->permissions()->attach(request('role_permission'));

        return back();
    }
    public function detachPermission(Role $role)
    {
        $role->permissions()->detach(request('role_permission'));

        return back();
    }
}
