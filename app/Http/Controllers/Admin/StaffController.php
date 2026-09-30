<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

/**
 * Staff accounts and their roles (Owner only). Staff are never deleted, only deactivated,
 * so invoices and quotations keep pointing at the person who issued them.
 */
class StaffController extends Controller
{
    public function index()
    {
        $staff = User::where('is_admin', true)->orderByDesc('is_active')->orderBy('name')->get();
        $roles = config('roles.roles');

        return view('admin.staff.index', compact('staff', 'roles'));
    }

    public function create()
    {
        return view('admin.staff.form', [
            'member' => new User(['role' => 'sales', 'is_active' => true]),
            'roles'  => config('roles.roles'),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'role'     => ['required', Rule::in(array_keys(config('roles.roles')))],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        User::create([
            'name'      => $data['name'],
            'email'     => $data['email'],
            'role'      => $data['role'],
            'password'  => Hash::make($data['password']),
            'is_admin'  => true,
            'is_active' => true,
        ]);

        return redirect()->route('admin.staff.index')
            ->with('success', $data['name'] . ' was added as ' . config("roles.roles.{$data['role']}.label") . '.');
    }

    public function edit(User $staff)
    {
        return view('admin.staff.form', ['member' => $staff, 'roles' => config('roles.roles')]);
    }

    public function update(Request $request, User $staff)
    {
        $data = $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($staff->id)],
            'role'      => ['required', Rule::in(array_keys(config('roles.roles')))],
            'is_active' => ['nullable', 'boolean'],
            'password'  => ['nullable', 'confirmed', Password::min(8)],
        ]);

        $isActive = $request->boolean('is_active');
        $isSelf   = $staff->id === $request->user()->id;

        // Nobody can demote or deactivate themselves, and the last active owner must stay.
        if ($isSelf && ($data['role'] !== 'owner' || ! $isActive)) {
            return back()->withInput()->with('error', 'You cannot change your own role or deactivate yourself.');
        }
        if ($staff->isOwner() && ($data['role'] !== 'owner' || ! $isActive)
            && User::where('role', 'owner')->where('is_active', true)->where('id', '!=', $staff->id)->doesntExist()) {
            return back()->withInput()->with('error', 'There must always be at least one active Owner.');
        }

        $staff->fill([
            'name'      => $data['name'],
            'email'     => $data['email'],
            'role'      => $data['role'],
            'is_active' => $isActive,
        ]);
        if (! empty($data['password'])) {
            $staff->password = Hash::make($data['password']);
        }
        $staff->save();

        return redirect()->route('admin.staff.index')->with('success', $staff->name . ' was updated.');
    }
}
