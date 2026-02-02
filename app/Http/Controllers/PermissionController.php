<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;


class PermissionController extends Controller
{

public function index()
{
    $permissions = Permission::orderBy('created_at', 'ASC')->paginate(25);

    return view('permissions.list', compact('permissions'));
}


    // নতুন permission form
    public function create()
    {
        return view('permissions.create');
    }

    // permission save
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|min:3|unique:permissions,name'
    ]);

    if ($validator->fails()) {
        return redirect()
            ->route('permissions.create')
            ->withInput()
            ->withErrors($validator);
    }

    Permission::create([
        'name' => $request->name
    ]);

    return redirect()->route('permissions.index')->with('success', 'Permission created successfully');
}

    // edit form
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('permissions.edit', compact('permission'));
    }

    // update permission
    public function update(Request $request, $id)
{
    $permission = Permission::findOrFail($id);

    $request->validate([
        'name' => 'required|unique:permissions,name,' . $id
    ]);

    $permission->update([
        'name' => $request->name
    ]);

    return redirect()->route('permissions.index')->with('success', 'Permission updated successfully');
}


    // delete permission
    public function destroy($id)
    {
        Permission::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Permission deleted successfully');
    }
}
