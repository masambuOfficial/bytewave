@extends('layouts.admin')

@section('title', 'Staff')

@section('content')
<div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
    <div>
        <h1 style="font-size:1.5rem;font-weight:700;color:var(--bytewave-blue-dark);margin-bottom:.25rem;">Staff &amp; Roles</h1>
        <p style="color:#546270;font-size:.9rem;margin:0;">Who can sign in, and what each person can see and do.</p>
    </div>
    <x-admin.button href="{{ route('admin.staff.create') }}">Add Staff Member</x-admin.button>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr><th>Name</th><th>Email</th><th>Role</th><th>Status</th><th class="text-end">Actions</th></tr>
            </thead>
            <tbody>
                @foreach($staff as $member)
                    <tr>
                        <td><strong>{{ $member->name }}</strong>@if($member->id === auth()->id()) <span class="text-muted">(you)</span>@endif</td>
                        <td>{{ $member->email }}</td>
                        <td>{{ $member->roleLabel() }}</td>
                        <td>
                            @if($member->is_active)
                                <span class="status-pill bg-success">Active</span>
                            @else
                                <span class="status-pill bg-secondary">Deactivated</span>
                            @endif
                        </td>
                        <td class="text-end"><a href="{{ route('admin.staff.edit', $member) }}" class="btn btn-sm btn-outline-primary">Edit</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <h6 class="mb-3">What each role can do</h6>
        <div class="table-responsive">
            <table class="table mb-0">
                <tbody>
                    @foreach($roles as $key => $role)
                        <tr><td style="width:140px;"><strong>{{ $role['label'] }}</strong></td><td>{{ $role['description'] }}</td></tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
