@extends('layouts.admin')

@section('title', $member->exists ? 'Edit Staff Member' : 'Add Staff Member')

@section('content')
@php $isSelf = $member->exists && $member->id === auth()->id(); @endphp
<div class="mb-4">
    <h1 style="font-size:1.5rem;font-weight:700;color:var(--bytewave-blue-dark);margin-bottom:.25rem;">{{ $member->exists ? 'Edit ' . $member->name : 'Add Staff Member' }}</h1>
    <p style="color:#546270;font-size:.9rem;margin:0;">Staff sign in with their email and the password you set here.</p>
</div>

<div class="card border-0 shadow-sm" style="max-width:640px;">
    <div class="card-body">
        <form method="POST" action="{{ $member->exists ? route('admin.staff.update', $member) : route('admin.staff.store') }}">
            @csrf
            @if($member->exists) @method('PUT') @endif

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $member->name) }}" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $member->email) }}" required>
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select id="role" name="role" class="form-select @error('role') is-invalid @enderror" @if($isSelf) disabled @endif>
                    @foreach($roles as $key => $role)
                        <option value="{{ $key }}" @selected(old('role', $member->role) === $key)>{{ $role['label'] }} – {{ $role['description'] }}</option>
                    @endforeach
                </select>
                @if($isSelf)<input type="hidden" name="role" value="{{ $member->role }}">@endif
                @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            @if($member->exists)
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" value="1" @checked(old('is_active', $member->is_active)) @if($isSelf) disabled @endif>
                    @if($isSelf)<input type="hidden" name="is_active" value="1">@endif
                    <label class="form-check-label" for="is_active">Active (can sign in)</label>
                </div>
            @endif

            <div class="mb-3">
                <label for="password" class="form-label">{{ $member->exists ? 'New password' : 'Password' }}</label>
                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" autocomplete="new-password" @if(! $member->exists) required @endif>
                @if($member->exists)<div class="form-text">Leave blank to keep the current password. Set one here if the person forgot theirs.</div>@endif
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="form-label">Confirm password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" autocomplete="new-password" @if(! $member->exists) required @endif>
            </div>

            <div class="d-flex gap-2">
                <x-admin.button type="submit">{{ $member->exists ? 'Save Changes' : 'Add Staff Member' }}</x-admin.button>
                <x-admin.button href="{{ route('admin.staff.index') }}" variant="secondary">Cancel</x-admin.button>
            </div>
        </form>
    </div>
</div>
@endsection
