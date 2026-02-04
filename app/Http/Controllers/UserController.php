<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

public function __construct()
{
    $this->middleware('permission:view users')->only('index');
    $this->middleware('permission:edit users')->only(['edit',]);
    // $this->middleware('permission:create users')->only(['create', ]);
    
    // $this->middleware('permission:delete users')->only('destroy');
}
    // List all users
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('users.list', compact('users'));
    }

    // Show create form
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    // Store new user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if ($request->roles) {
            $user->syncRoles($request->roles);
        }

        return redirect()->route('users.index')
            ->with('success', 'User created successfully!');
    }

    // Show single user
    public function show($id)
    {
        $user = User::with('roles', 'permissions')->findOrFail($id);
        return view('users.show', compact('user'));
    }

    // Show edit form
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $userRoles = $user->roles->pluck('id')->toArray();

        return view('users.edit', compact('user', 'roles', 'userRoles'));
    }

    // Update user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->route('users.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        // Update roles
        $user->syncRoles($request->roles ?? []);
    
        return redirect()->route('users.index')
            ->with('success', 'User updated successfully!');
    }

    // Delete user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully!');
    }
}
