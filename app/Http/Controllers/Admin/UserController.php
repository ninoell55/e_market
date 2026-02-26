<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Mengambil list role unik untuk filter tabs
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

        return view('admin.user.index', ['title' => 'Read'], compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create', ['title' => 'Create']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'role' => 'required|in:superadmin,admin,member',
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.user.edit', ['title' => 'Edit'], compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:superadmin,admin,member',
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        Alert::success('Success', 'User deleted successfully!');
        return redirect()->route('admin.user.index');
    }
}
