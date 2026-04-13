<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $roles = User::distinct()->pluck('role');

        $users = User::query()
            ->when(
                $request->search,
                fn($query) => $query->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%')
            )
            ->when($request->role, fn($query, $role) => $query->where('role', $role))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.user.index', ['title' => 'Users List'], compact('users', 'roles'));
    }

    public function create()
    {
        return view('admin.user.create', ['title' => 'Add New User']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'role' => 'required|in:admin,courier,member',
            'password' => 'required|string|min:8|confirmed'
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'email_verified_at' => now(),
            'role' => $validated['role'],
            'password' => $validated['password'],
            'remember_token' => Str::random(10)
        ]);

        Alert::success('Success', 'Users created successfully!');
        return redirect()->route('admin.user.index');
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', ['title' => 'Edit User Data'], compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,courier,member',
            'password' => 'nullable|string|min:8|confirmed'
        ]);

        if ($user->email !== $validated['email']) $user->email_verified_at = now();

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];

        if ($request->filled('password')) $user->password = $validated['password'];

        $user->save();

        Alert::success('Success', 'User updated successfully!');
        return redirect()->route('admin.user.index');
    }

    public function destroy(User $user)
    {
        $user->delete();

        Alert::success('Success', 'User deleted successfully!');
        return redirect()->route('admin.user.index');
    }
}
