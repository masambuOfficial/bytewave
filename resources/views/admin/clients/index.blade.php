@extends('layouts.admin')

@push('styles')
<style>
    .bw-card {
        border: 1px solid rgba(0, 0, 0, 0.06);
        border-radius: 12px;
    }
    .bw-card-header {
        background: #fff;
        border-bottom: 1px solid rgba(0, 0, 0, 0.06);
    }
    .bw-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0;
    }
    .bw-subtitle {
        font-size: 0.9rem;
        color: #6c757d;
        margin-top: 0.25rem;
    }
    .bw-table thead th {
        font-size: 0.8rem;
        letter-spacing: 0.02em;
        color: #6c757d;
        text-transform: uppercase;
        background: #f8fafc;
        border-bottom: 1px solid rgba(0, 0, 0, 0.06);
        white-space: nowrap;
        padding: 0.85rem 0.9rem;
    }
    .bw-table tbody td {
        padding: 0.85rem 0.9rem;
        vertical-align: middle;
    }
    .bw-actions {
        display: flex;
        gap: 0.5rem;
        justify-content: flex-end;
    }

    .bw-table {
        min-width: 980px;
    }

    @media (max-width: 768px) {
        .bw-actions {
            justify-content: flex-start;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
            <h1 class="bw-title mt-4">Clients</h1>
            <div class="bw-subtitle">Manage your clients and view linked quotations/invoices.</div>
        </div>
        <a href="{{ route('admin.clients.create') }}" class="btn btn-primary mt-4">
            <i class="fas fa-plus"></i> Add Client
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card mb-4 shadow-sm bw-card">
        <div class="card-header bw-card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="fw-semibold">Client List</div>
            </div>
        </div>
        <div class="px-3 pt-3 pb-3">
            <form method="GET" action="{{ route('admin.clients.index') }}" class="row g-2 align-items-end">
                <div class="col-12 col-md-6">
                    <label class="form-label mb-1 visually-hidden" for="q">Search</label>
                    <input type="text" id="q" name="q" value="{{ request('q') }}" class="form-control" placeholder="Name, email, phone, address">
                </div>
                <div class="col-12 col-md-6 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('admin.clients.index') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 bw-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Quotations</th>
                            <th>Invoices</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($clients as $client)
                            <tr>
                                <td>{{ $client->name }}</td>
                                <td>{{ $client->email }}</td>
                                <td>{{ $client->phone }}</td>
                                <td>{{ $client->address }}</td>
                                <td>{{ $client->quotations->count() }}</td>
                                <td>{{ $client->invoices->count() }}</td>
                                <td class="text-end">
                                    <div class="bw-actions">
                                        <a href="{{ route('admin.clients.edit', $client) }}" 
                                           class="btn btn-sm btn-outline-primary" aria-label="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.clients.destroy', $client) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this client?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" aria-label="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No clients found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end p-3 border-top">
                {{ $clients->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
