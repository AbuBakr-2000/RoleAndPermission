<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.permissions.index', ['permissions' => $permissions]);
    }

    public function store(Permission $permission)
    {
        request()->validate([
            'name' => ['required', 'min:3'],
        ]);
        Permission::create([
            'name' => Str::ucfirst(\request('name')),
            'slug' => Str::of(Str::lower(request('name')))->slug('-'),
        ]);

        return back();
    }

    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', ['permission' => $permission]);
    }

    public function update(Permission $permission)
    {
        request()->validate([
            'name' => ['required', 'min:3'],
        ]);
        $permission->name = Str::ucfirst(request('name'));
        $permission->slug = Str::of(Str::lower(request('name')))->slug('-');

        if ($permission->isDirty('name')) {
            Session::flash('permission-updated', 'Permission "' . $permission->name . '" has been updated');

            $permission->save();
        } else {
            Session::flash('permission-updated', 'Nothing has been updated');
        }

        return redirect()->route('permissions.index');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        Session::flash('permission-deleted', 'Permission "' . $permission->name . '" has been deleted');

        return back();
    }
}

