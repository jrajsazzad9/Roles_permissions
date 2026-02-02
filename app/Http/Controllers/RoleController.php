<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    // List all roles
    public function index()
    {
        $roles = Role::orderBy('created_at', 'DESC')->paginate(25);
        return view('roles.list', compact('roles'));
    }

    // Show create role form
   public function create()
{
    $permissions = Permission::all(); // get all permissions
    return view('roles.create', compact('permissions'));
}

    // Store new role
    
// This method will insert a permission in DB public 
public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|min:3|unique:roles,name'
    ]);

    if ($validator->fails()) {
        return redirect()
            ->route('roles.create')
            ->withInput()
            ->withErrors($validator);
    }

    // Create role
    $role = Role::create([
        'name' => $request->name
    ]);

    // Assign permissions if selected
    if (!empty($request->permission)) {
        foreach ($request->permission as $name) {
            $role->givePermissionTo($name);
        }
    }

    return redirect()
        ->route('roles.index')
        ->with('success', 'Role added successfully.');
}
public function edit($id)
{
    $role = \Spatie\Permission\Models\Role::findOrFail($id);
    $permissions = \Spatie\Permission\Models\Permission::all();
    $rolePermissions = $role->permissions->pluck('name')->toArray();

    return view('roles.edit', compact(
        'role',
        'permissions',
        'rolePermissions'
    ));
}

    // Update role
    public function update(Request $request, $id)
{
    $role = Role::findOrFail($id);

    // Validate role name
    $request->validate([
        'name' => 'required|unique:roles,name,' . $id
    ]);

    // Update role name
    $role->update(['name' => $request->name]);

    // Update permissions
    if ($request->permission) {
        $role->syncPermissions($request->permission); // sync selected permissions
    } else {
        $role->syncPermissions([]); // no permission selected → remove all
    }

    return redirect()->route('roles.index')->with('success', 'Role updated successfully');
}

    // Delete role
    public function destroy($id)
    {
        Role::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Role deleted successfully');
    }
}
