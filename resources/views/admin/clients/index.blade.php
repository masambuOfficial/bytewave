@extends('layouts.admin')

@push('styles')
<style>
    .clients-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1.5rem;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .clients-header h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--bytewave-blue-dark);
        margin-bottom: 0.25rem;
    }

    .clients-header p {
        color: #546270;
        font-size: 0.9rem;
        margin-bottom: 0;
    }

    .btn-add-client {
        background: var(--bytewave-blue);
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 0.65rem 1.25rem;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: background 0.2s ease, transform 0.2s ease;
        white-space: nowrap;
    }

    .btn-add-client:hover {
        background: var(--bytewave-blue-dark);
        color: #fff;
        transform: translateY(-1px);
    }

    .clients-card {
        background: #fff;
        border: 1px solid #CDE3F1;
        border-radius: 16px;
        overflow: hidden;
    }

    .clients-toolbar {
        padding: 1.1rem 1.35rem;
        border-bottom: 1px solid #CDE3F1;
    }

    .clients-search-input {
        border: 1px solid #CDE3F1;
        border-radius: 10px;
        padding: 0.55rem 0.9rem 0.55rem 2.35rem;
        font-size: 0.88rem;
        width: 100%;
        background: #F3F8FC url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%238A97A0' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Ccircle cx='11' cy='11' r='8'%3E%3C/circle%3E%3Cline x1='21' y1='21' x2='16.65' y2='16.65'%3E%3C/line%3E%3C/svg%3E") no-repeat 0.85rem center;
    }

    .clients-search-input:focus {
        outline: none;
        border-color: var(--bytewave-blue);
        background-color: #fff;
    }

    .btn-filter {
        background: var(--bytewave-blue-light);
        color: var(--bytewave-blue-dark);
        border: none;
        border-radius: 10px;
        padding: 0.55rem 1.1rem;
        font-weight: 600;
        font-size: 0.85rem;
        transition: background 0.2s ease, color 0.2s ease;
    }

    .btn-filter:hover {
        background: var(--bytewave-blue);
        color: #fff;
    }

    .btn-reset {
        background: transparent;
        color: #546270;
        border: 1px solid #CDE3F1;
        border-radius: 10px;
        padding: 0.55rem 1.1rem;
        font-weight: 600;
        font-size: 0.85rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: background 0.2s ease, color 0.2s ease;
    }

    .btn-reset:hover {
        background: #F3F8FC;
        color: #0B1F33;
    }

    .clients-table {
        width: 100%;
        margin-bottom: 0;
    }

    .clients-table thead th {
        background: #F3F8FC;
        color: #546270;
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        border-bottom: 1px solid #CDE3F1;
        padding: 0.9rem 1.1rem;
        white-space: nowrap;
    }

    .clients-table tbody td {
        padding: 0.9rem 1.1rem;
        border-bottom: 1px solid #CDE3F1;
        vertical-align: middle;
        font-size: 0.88rem;
        color: #0B1F33;
    }

    .clients-table tbody tr:last-child td {
        border-bottom: none;
    }

    .clients-table tbody tr:hover {
        background: #F3F8FC;
    }

    .client-name-cell {
        font-weight: 600;
        color: #0B1F33;
    }

    .clients-table td.text-muted-cell {
        color: #546270;
    }

    .count-pill {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 1.75rem;
        padding: 0.15rem 0.5rem;
        border-radius: 999px;
        background: var(--bytewave-blue-light);
        color: var(--bytewave-blue-dark);
        font-weight: 700;
        font-size: 0.78rem;
    }

    .client-actions {
        display: flex;
        gap: 0.35rem;
        justify-content: flex-end;
    }

    .client-action-btn {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        border-radius: 8px;
        font-size: 0.8rem;
        transition: background 0.2s ease, color 0.2s ease;
        flex-shrink: 0;
    }

    .client-action-btn.edit {
        background: var(--bytewave-blue-light);
        color: var(--bytewave-blue-dark);
    }

    .client-action-btn.edit:hover {
        background: var(--bytewave-blue);
        color: #fff;
    }

    .client-action-btn.delete {
        background: #FDEDEC;
        color: #C0392B;
    }

    .client-action-btn.delete:hover {
        background: #C0392B;
        color: #fff;
    }

    .clients-empty-row {
        text-align: center;
        color: #546270;
        padding: 3rem 1rem !important;
    }

    @media (max-width: 768px) {
        .client-actions {
            justify-content: flex-start;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="clients-header">
        <div>
            <h1>Clients</h1>
            <p>Manage your clients and view linked quotations/invoices.</p>
        </div>
        <x-admin.button href="{{ route('admin.clients.create') }}">Add Client</x-admin.button>
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

    <div class="clients-card">
        <div class="clients-toolbar">
            <form method="GET" action="{{ route('admin.clients.index') }}" class="row g-2 align-items-center">
                <div class="col-12 col-md-6">
                    <label class="form-label mb-1 visually-hidden" for="q">Search</label>
                    <input type="text" id="q" name="q" value="{{ request('q') }}" class="clients-search-input" placeholder="Search by name, email, phone, address">
                </div>
                <div class="col-12 col-md-auto d-flex gap-2">
                    <x-admin.button type="submit" size="sm">Filter</x-admin.button>
                    <x-admin.button href="{{ route('admin.clients.index') }}" variant="secondary" size="sm">Reset</x-admin.button>
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table class="clients-table">
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
                            <td class="client-name-cell">{{ $client->name }}</td>
                            <td class="text-muted-cell">{{ $client->email }}</td>
                            <td class="text-muted-cell">{{ $client->phone }}</td>
                            <td class="text-muted-cell">{{ $client->address }}</td>
                            <td><span class="count-pill">{{ $client->quotations->count() }}</span></td>
                            <td><span class="count-pill">{{ $client->invoices->count() }}</span></td>
                            <td>
                                <div class="client-actions">
                                    <a href="{{ route('admin.clients.edit', $client) }}"
                                       class="client-action-btn edit" title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <form action="{{ route('admin.clients.destroy', $client) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this client?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="client-action-btn delete" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="clients-empty-row">No clients found</td>
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
@endsection
