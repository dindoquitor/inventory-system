<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('branch')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $branches = Branch::all();
        $roles = Role::all();
        return view('users.create', compact('branches', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'branch_id' => 'nullable|exists:branches,id',
            'role' => 'required|exists:roles,name',
            'position' => 'required|string|max:255',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'branch_id' => $request->branch_id,
            'position' => $request->position,
        ]);

        $user->assignRole($request->role);

        return redirect()->route('users.index')->with('success', 'User created.');
    }
    //for editing user
    public function edit(User $user)
    {
        $branches = Branch::all();
        $roles = Role::all();

        return view('users.edit', compact('user', 'branches', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'branch_id' => 'nullable|exists:branches,id',
            'role' => 'required|exists:roles,name',
            'position' => 'required|string|max:255',
            'password' => 'nullable|confirmed|min:6',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'branch_id' => $request->branch_id,
            'position' => $request->position,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        // Update role only if changed
        if (!$user->hasRole($request->role)) {
            $user->syncRoles([$request->role]);
        }

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }
}
