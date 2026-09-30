@extends('layouts.admin')

@section('title', 'Staff')

@push('styles')
<style>
    .staff-head { display: flex; justify-content: space-between; align-items: flex-start; gap: 1rem; flex-wrap: wrap; margin-bottom: 1.5rem; }
    .staff-head h1 { font-size: 1.5rem; font-weight: 700; color: #0B1F33; margin: 0 0 .25rem; }
    .staff-head p { color: #546270; font-size: .9rem; margin: 0; }

    .staff-card { background: #fff; border: 1px solid #CDE3F1; border-radius: 16px; overflow: hidden; margin-bottom: 2rem; }
    .staff-table { width: 100%; margin: 0; border-collapse: collapse; }
    .staff-table thead th { background: #F3F8FC; color: #546270; font-size: .72rem; font-weight: 700; text-transform: uppercase; letter-spacing: .04em; padding: .85rem 1.25rem; border-bottom: 1px solid #CDE3F1; white-space: nowrap; }
    .staff-table tbody td { padding: 1rem 1.25rem; border-bottom: 1px solid #E6F1F8; vertical-align: middle; font-size: .88rem; color: #0B1F33; }
    .staff-table tbody tr:last-child td { border-bottom: 0; }
    .staff-table tbody tr:hover { background: #F3F8FC; }
    .staff-table tbody tr.is-off td { color: #546270; }

    .person { display: flex; align-items: center; gap: .85rem; min-width: 0; }
    .avatar { width: 40px; height: 40px; border-radius: 50%; background: #E6F1F8; color: #0773B9; font-weight: 700; font-size: .9rem; display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .person-name { font-weight: 600; line-height: 1.2; }
    .person-email { color: #546270; font-size: .82rem; overflow: hidden; text-overflow: ellipsis; }
    .you-tag { font-size: .7rem; font-weight: 600; color: #546270; border: 1px solid #CDE3F1; border-radius: 999px; padding: .05rem .5rem; margin-left: .4rem; vertical-align: middle; }

    .role-pill { display: inline-flex; align-items: center; padding: .25rem .7rem; border-radius: 999px; font-size: .75rem; font-weight: 700; background: #E6F1F8; color: #0B1F33; }
    .role-pill.owner { background: #0773B9; color: #fff; }

    .state { display: inline-flex; align-items: center; gap: .45rem; font-size: .82rem; font-weight: 600; }
    .state::before { content: ''; width: 8px; height: 8px; border-radius: 50%; background: #17703F; }
    .state.off { color: #546270; }
    .state.off::before { background: #858F99; }

    .edit-btn { width: 34px; height: 34px; display: inline-flex; align-items: center; justify-content: center; border-radius: 9px; background: #E6F1F8; color: #0B1F33; border: 0; transition: background .2s, color .2s; }
    .edit-btn:hover { background: #0773B9; color: #fff; }

    .section-label { font-size: .75rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; color: #546270; margin: 0 0 .75rem; }
    .roles-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(205px, 1fr)); gap: 1rem; }
    .role-card { background: #fff; border: 1px solid #CDE3F1; border-radius: 14px; padding: 1.1rem 1.2rem; }
    .role-card h3 { font-size: .95rem; font-weight: 700; color: #0B1F33; margin: 0 0 .35rem; }
    .role-card p { color: #546270; font-size: .82rem; line-height: 1.45; margin: 0 0 .8rem; }
    .chips { display: flex; flex-wrap: wrap; gap: .35rem; }
    .chip { font-size: .7rem; font-weight: 600; color: #0B1F33; background: #F3F8FC; border: 1px solid #CDE3F1; border-radius: 999px; padding: .15rem .55rem; }

    @media (max-width: 720px) {
        .staff-table thead { display: none; }
        .staff-table, .staff-table tbody, .staff-table tr, .staff-table td { display: block; width: 100%; }
        .staff-table tbody tr { padding: .9rem 1.1rem; border-bottom: 1px solid #E6F1F8; }
        .staff-table tbody td { border: 0; padding: .3rem 0; }
    }
</style>
@endpush


@section('content')
@php
    $moduleNames = [
        'clients' => 'Clients', 'client-services' => 'Client services', 'tasks' => 'Tasks', 'quotations' => 'Quotations',
        'invoices' => 'Invoices & payments', 'products' => 'Products', 'services' => 'Services', 'posts' => 'Blog',
        'portfolios' => 'Portfolio', 'testimonials' => 'Testimonials', 'client-logos' => 'Client logos',
    ];
@endphp
<div class="staff-head">
    <div>
        <h1>Staff &amp; Roles</h1>
        <p>Who can sign in, and what each person can see and do.</p>
    </div>
    <x-admin.button href="{{ route('admin.staff.create') }}">Add Staff Member</x-admin.button>
</div>

<div class="staff-card">
    <div class="table-responsive">
        <table class="staff-table">
            <thead>
                <tr><th>Person</th><th>Role</th><th>Status</th><th style="text-align:right;">Edit</th></tr>
            </thead>
            <tbody>
                @foreach($staff as $member)
                    <tr class="{{ $member->is_active ? '' : 'is-off' }}">
                        <td>
                            <div class="person">
                                <span class="avatar">{{ strtoupper(mb_substr($member->name, 0, 1)) }}</span>
                                <div style="min-width:0;">
                                    <div class="person-name">{{ $member->name }}@if($member->id === auth()->id())<span class="you-tag">You</span>@endif</div>
                                    <div class="person-email">{{ $member->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td><span class="role-pill {{ $member->role }}">{{ $member->roleLabel() }}</span></td>
                        <td><span class="state {{ $member->is_active ? '' : 'off' }}">{{ $member->is_active ? 'Active' : 'Deactivated' }}</span></td>
                        <td style="text-align:right;">
                            <a href="{{ route('admin.staff.edit', $member) }}" class="edit-btn" title="Edit {{ $member->name }}" aria-label="Edit {{ $member->name }}"><i class="fas fa-pen"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<p class="section-label">What each role can open</p>
<div class="roles-grid">
    @foreach($roles as $key => $role)
        <div class="role-card">
            <h3>{{ $role['label'] }}</h3>
            <p>{{ $role['description'] }}</p>
            <div class="chips">
                @if(in_array('*', $role['modules'], true))
                    <span class="chip">Everything</span>
                    <span class="chip">Staff &amp; Roles</span>
                @else
                    @foreach($role['modules'] as $module)
                        <span class="chip">{{ $moduleNames[$module] ?? ucfirst($module) }}</span>
                    @endforeach
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
