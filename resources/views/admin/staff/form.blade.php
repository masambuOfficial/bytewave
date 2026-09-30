@extends('layouts.admin')

@section('title', $member->exists ? 'Edit Staff Member' : 'Add Staff Member')

@push('styles')
<style>
    .sf-head { margin-bottom: 1.5rem; }
    .sf-head a.back { color: #546270; font-size: .82rem; text-decoration: none; display: inline-flex; align-items: center; gap: .4rem; margin-bottom: .6rem; }
    .sf-head a.back:hover { color: #0773B9; }
    .sf-head h1 { font-size: 1.5rem; font-weight: 700; color: #0B1F33; margin: 0 0 .25rem; }
    .sf-head p { color: #546270; font-size: .9rem; margin: 0; }

    .sf-card { background: #fff; border: 1px solid #CDE3F1; border-radius: 16px; padding: 1.75rem; max-width: 720px; }
    .sf-section { font-size: .75rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; color: #546270; margin: 0 0 1rem; }
    .sf-section { margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #E6F1F8; }
    .sf-card > .sf-section:first-of-type { margin-top: 0; padding-top: 0; border-top: 0; }

    .sf-field { margin-bottom: 1.1rem; }
    .sf-field label { display: block; font-size: .85rem; font-weight: 600; color: #0B1F33; margin-bottom: .4rem; }
    .sf-input { width: 100%; border: 1px solid #CDE3F1; border-radius: 10px; padding: .65rem .9rem; font-size: .92rem; color: #0B1F33; background: #F3F8FC; transition: border-color .15s, background .15s, box-shadow .15s; }
    .sf-input:focus { outline: none; border-color: #0773B9; background: #fff; box-shadow: 0 0 0 3px rgba(7, 115, 185, .15); }
    .sf-input.invalid { border-color: #C0392B; }
    .sf-error { color: #C0392B; font-size: .8rem; margin-top: .35rem; }
    .sf-hint { color: #546270; font-size: .8rem; margin-top: .35rem; }
    .sf-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }

    .role-options { display: grid; gap: .65rem; }
    .role-option { position: relative; display: block; cursor: pointer; }
    .role-option input { position: absolute; opacity: 0; pointer-events: none; }
    .role-option .box { display: block; border: 1px solid #CDE3F1; border-radius: 12px; padding: .85rem 1rem .85rem 2.6rem; background: #fff; transition: border-color .15s, background .15s; position: relative; }
    .role-option .box::before { content: ''; position: absolute; left: 1rem; top: 1.05rem; width: 16px; height: 16px; border-radius: 50%; border: 2px solid #858F99; background: #fff; }
    .role-option:hover .box { background: #F3F8FC; }
    .role-option input:checked + .box { border-color: #0773B9; background: #E6F1F8; }
    .role-option input:checked + .box::before { border-color: #0773B9; background: radial-gradient(circle, #0773B9 0 4px, #fff 4.5px); }
    .role-option input:focus-visible + .box { box-shadow: 0 0 0 3px rgba(7, 115, 185, .25); }
    .role-option input:disabled + .box { opacity: .6; cursor: not-allowed; }
    .role-option .r-name { display: block; font-weight: 700; font-size: .92rem; color: #0B1F33; }
    .role-option .r-desc { display: block; font-size: .8rem; color: #546270; margin-top: .15rem; line-height: 1.4; }

    .switch-row { display: flex; align-items: center; justify-content: space-between; gap: 1rem; border: 1px solid #CDE3F1; border-radius: 12px; padding: .85rem 1rem; }
    .switch-row .s-title { font-weight: 600; font-size: .9rem; color: #0B1F33; }
    .switch-row .s-desc { font-size: .8rem; color: #546270; }
    .switch { position: relative; width: 44px; height: 24px; flex-shrink: 0; }
    .switch input { position: absolute; inset: 0; opacity: 0; cursor: pointer; margin: 0; z-index: 1; }
    .switch .track { position: absolute; inset: 0; border-radius: 999px; background: #CDE3F1; transition: background .2s; }
    .switch .track::after { content: ''; position: absolute; top: 3px; left: 3px; width: 18px; height: 18px; border-radius: 50%; background: #fff; box-shadow: 0 1px 3px rgba(11, 31, 51, .25); transition: transform .2s; }
    .switch input:checked ~ .track { background: #0773B9; }
    .switch input:checked ~ .track::after { transform: translateX(20px); }
    .switch input:focus-visible ~ .track { box-shadow: 0 0 0 3px rgba(7, 115, 185, .25); }
    .switch input:disabled { cursor: not-allowed; }

    .pw-wrap { position: relative; }
    .pw-wrap .sf-input { padding-right: 2.9rem; }
    .pw-eye { position: absolute; top: 0; bottom: 0; right: 0; display: flex; align-items: center; padding: 0 .85rem; background: none; border: 0; color: #546270; cursor: pointer; }
    .pw-eye:hover { color: #0773B9; }

    .sf-danger { margin-top: 1.25rem; border-color: #F3C9C5; }
    .sf-delete { background: #FDEDEC; color: #C0392B; border: 0; border-radius: 10px; padding: .6rem 1.1rem; font-weight: 600; font-size: .85rem; transition: background .2s, color .2s; }
    .sf-delete:hover { background: #C0392B; color: #fff; }

    .sf-actions { display: flex; gap: .75rem; flex-wrap: wrap; margin-top: 2rem; }

    @media (max-width: 640px) { .sf-row { grid-template-columns: 1fr; } .sf-card { padding: 1.25rem; } }
</style>
@endpush

@section('content')
@php $isSelf = $member->exists && $member->id === auth()->id(); @endphp

<div class="sf-head">
    <a href="{{ route('admin.staff.index') }}" class="back"><i class="fas fa-arrow-left"></i> Staff &amp; Roles</a>
    <h1>{{ $member->exists ? $member->name : 'Add Staff Member' }}</h1>
    <p>{{ $member->exists ? 'Change their details, role or password.' : 'They sign in with their email and the password you set here.' }}</p>
</div>

<form method="POST" action="{{ $member->exists ? route('admin.staff.update', $member) : route('admin.staff.store') }}" class="sf-card" autocomplete="off">
    @csrf
    @if($member->exists) @method('PUT') @endif

    <p class="sf-section">Details</p>
    <div class="sf-row">
        <div class="sf-field">
            <label for="name">Full name</label>
            <input type="text" id="name" name="name" class="sf-input @error('name') invalid @enderror" value="{{ old('name', $member->name) }}" required>
            @error('name')<div class="sf-error">{{ $message }}</div>@enderror
        </div>
        <div class="sf-field">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="sf-input @error('email') invalid @enderror" value="{{ old('email', $member->email) }}" required>
            @error('email')<div class="sf-error">{{ $message }}</div>@enderror
        </div>
    </div>

    <p class="sf-section">Role</p>
    <div class="role-options">
        @foreach($roles as $key => $role)
            <label class="role-option">
                <input type="radio" name="role" value="{{ $key }}" @checked(old('role', $member->role) === $key) @if($isSelf) disabled @endif>
                <span class="box">
                    <span class="r-name">{{ $role['label'] }}</span>
                    <span class="r-desc">{{ $role['description'] }}</span>
                </span>
            </label>
        @endforeach
    </div>
    @if($isSelf)
        <input type="hidden" name="role" value="{{ $member->role }}">
        <div class="sf-hint">You cannot change your own role.</div>
    @endif
    @error('role')<div class="sf-error">{{ $message }}</div>@enderror

    @if($member->exists)
        <p class="sf-section">Access</p>
        <div class="switch-row">
            <div>
                <div class="s-title">Can sign in</div>
                <div class="s-desc">{{ $isSelf ? 'You cannot deactivate yourself.' : 'Turn off to lock this person out. Their past work stays on record.' }}</div>
            </div>
            <span class="switch">
                <input type="checkbox" id="is_active" name="is_active" value="1" aria-label="Can sign in" @checked(old('is_active', $member->is_active)) @if($isSelf) disabled @endif>
                <span class="track"></span>
            </span>
            @if($isSelf)<input type="hidden" name="is_active" value="1">@endif
        </div>
    @endif

    <p class="sf-section">{{ $member->exists ? 'Reset password' : 'Password' }}</p>
    <div class="sf-row">
        <div class="sf-field">
            <label for="password">{{ $member->exists ? 'New password' : 'Password' }}</label>
            <div class="pw-wrap">
                <input type="password" id="password" name="password" class="sf-input @error('password') invalid @enderror" autocomplete="new-password" @if(! $member->exists) required @endif>
                <button type="button" class="pw-eye" data-target="password" aria-label="Show password"><i class="fas fa-eye"></i></button>
            </div>
            @error('password')<div class="sf-error">{{ $message }}</div>@else
                <div class="sf-hint">{{ $member->exists ? 'Leave blank to keep the current password.' : 'At least 8 characters.' }}</div>
            @enderror
        </div>
        <div class="sf-field">
            <label for="password_confirmation">Confirm password</label>
            <div class="pw-wrap">
                <input type="password" id="password_confirmation" name="password_confirmation" class="sf-input" autocomplete="new-password" @if(! $member->exists) required @endif>
                <button type="button" class="pw-eye" data-target="password_confirmation" aria-label="Show password"><i class="fas fa-eye"></i></button>
            </div>
        </div>
    </div>

    <div class="sf-actions">
        <x-admin.button type="submit">{{ $member->exists ? 'Save Changes' : 'Add Staff Member' }}</x-admin.button>
        <x-admin.button href="{{ route('admin.staff.index') }}" variant="secondary">Cancel</x-admin.button>
    </div>
</form>

@if($member->exists && ! $isSelf)
    <div class="sf-card sf-danger">
        <p class="sf-section" style="border:0;padding:0;margin:0 0 .75rem;">Delete account</p>
        @if(($linkedRecords ?? 0) > 0)
            <p class="sf-hint" style="margin:0;">{{ $member->name }} appears on {{ $linkedRecords }} {{ Str::plural('record', $linkedRecords) }} (quotations, invoices or payments), so the account cannot be deleted. Turn off <strong>Can sign in</strong> above to lock them out and keep the history.</p>
        @else
            <p class="sf-hint" style="margin:0 0 1rem;">{{ $member->name }} has no records in the system, so this account can be deleted for good. This cannot be undone.</p>
            <form method="POST" action="{{ route('admin.staff.destroy', $member) }}" onsubmit="return confirm('Delete {{ addslashes($member->name) }} permanently?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="sf-delete">Delete {{ $member->name }}</button>
            </form>
        @endif
    </div>
@endif

@push('scripts')
<script>
    document.querySelectorAll('.pw-eye').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var input = document.getElementById(btn.dataset.target);
            var show = input.type === 'password';
            input.type = show ? 'text' : 'password';
            btn.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
            btn.querySelector('i').className = show ? 'fas fa-eye-slash' : 'fas fa-eye';
        });
    });
</script>
@endpush
@endsection
