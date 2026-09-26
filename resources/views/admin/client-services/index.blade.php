@extends('layouts.admin')

@section('title', 'Client Services')

@push('styles')
<style>
    .client-services-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1.5rem;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .client-services-header h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--bytewave-blue-dark);
        margin-bottom: 0.25rem;
    }

    .client-services-header p {
        color: #6B7A85;
        font-size: 0.9rem;
        margin-bottom: 0;
    }

    .btn-add-client-service {
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

    .btn-add-client-service:hover {
        background: var(--bytewave-blue-dark);
        color: #fff;
        transform: translateY(-1px);
    }

    .client-services-card {
        background: #fff;
        border: 1px solid #EEF1F4;
        border-radius: 16px;
        overflow: hidden;
    }

    .client-services-toolbar {
        padding: 1.1rem 1.35rem;
        border-bottom: 1px solid #F1F3F5;
    }

    .cs-input, .cs-select {
        border: 1px solid #E2E8EE;
        border-radius: 10px;
        padding: 0.55rem 0.9rem;
        font-size: 0.85rem;
        width: 100%;
        background: #FAFBFC;
    }

    .cs-input {
        padding-left: 2.35rem;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%238A97A0' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Ccircle cx='11' cy='11' r='8'%3E%3C/circle%3E%3Cline x1='21' y1='21' x2='16.65' y2='16.65'%3E%3C/line%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: 0.85rem center;
    }

    .cs-input:focus, .cs-select:focus {
        outline: none;
        border-color: var(--bytewave-blue);
        background-color: #fff;
    }

    .cs-label {
        font-size: 0.78rem;
        font-weight: 600;
        color: #8A97A0;
        margin-bottom: 0.3rem;
        display: block;
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
        color: #8A97A0;
        border: 1px solid #E2E8EE;
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
        background: #F1F4F7;
        color: #1F2A33;
    }

    .client-services-table {
        width: 100%;
        margin-bottom: 0;
    }

    .client-services-table thead th {
        background: #FAFBFC;
        color: #8A97A0;
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        border-bottom: 1px solid #EEF1F4;
        padding: 0.9rem 1.1rem;
        white-space: nowrap;
    }

    .client-services-table tbody td {
        padding: 0.9rem 1.1rem;
        border-bottom: 1px solid #F4F6F8;
        vertical-align: middle;
        font-size: 0.88rem;
        color: #1F2A33;
    }

    .client-services-table tbody tr:last-child td {
        border-bottom: none;
    }

    .client-services-table tbody tr:hover {
        background: #FAFCFE;
    }

    .currency-pill {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.65rem;
        border-radius: 999px;
        background: #F1F4F7;
        color: #4B5A63;
        font-weight: 700;
        font-size: 0.75rem;
    }

    .rate-value {
        font-weight: 700;
        color: var(--bytewave-blue-dark);
    }

    .cs-actions {
        display: flex;
        gap: 0.35rem;
        justify-content: flex-end;
    }

    .cs-action-btn {
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

    .cs-action-btn.edit {
        background: var(--bytewave-blue-light);
        color: var(--bytewave-blue-dark);
    }

    .cs-action-btn.edit:hover {
        background: var(--bytewave-blue);
        color: #fff;
    }

    .cs-action-btn.delete {
        background: #FDEDEC;
        color: #C0392B;
    }

    .cs-action-btn.delete:hover {
        background: #E74C3C;
        color: #fff;
    }

    .client-services-empty-row {
        text-align: center;
        color: #8A97A0;
        padding: 3rem 1rem !important;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="client-services-header">
        <div>
            <h1>Client Services</h1>
            <p>Manage service templates and suggested rates.</p>
        </div>
        <a href="{{ route('admin.client-services.create') }}" class="btn-add-client-service">
            <i class="fas fa-plus"></i> Add Service
        </a>
    </div>

    <div class="client-services-card">
        <div class="client-services-toolbar">
            <form method="GET" action="{{ route('admin.client-services.index') }}" class="row g-2 align-items-end">
                <div class="col-12 col-md-5">
                    <label class="cs-label" for="q">Search</label>
                    <input type="text" id="q" name="q" value="{{ request('q') }}" class="cs-input" placeholder="Name, description, unit">
                </div>
                <div class="col-6 col-md-3">
                    <label class="cs-label" for="currency">Currency</label>
                    <select class="cs-select" id="currency" name="currency">
                        <option value="">All</option>
                        <option value="UGX" {{ request('currency') === 'UGX' ? 'selected' : '' }}>UGX</option>
                        <option value="USD" {{ request('currency') === 'USD' ? 'selected' : '' }}>USD</option>
                    </select>
                </div>
                <div class="col-6 col-md-2">
                    <label class="cs-label" for="status">Status</label>
                    <select class="cs-select" id="status" name="status">
                        <option value="">All</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="col-12 col-md-2 d-flex gap-2">
                    <button type="submit" class="btn-filter">Filter</button>
                    <a href="{{ route('admin.client-services.index') }}" class="btn-reset">Reset</a>
                </div>
            </form>
        </div>

        @if($services->isEmpty())
            <div class="text-center p-4">
                <p class="text-muted mb-0">No client services found.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="client-services-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th style="width: 140px;">Currency</th>
                            <th style="width: 160px;">Suggested Rate</th>
                            <th>Unit</th>
                            <th class="text-end" style="width: 140px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($services as $service)
                            @php
                                $svcCurrency = $service->currency ?? 'UGX';
                                $rateDisplay = $svcCurrency === 'UGX'
                                    ? 'UGX ' . number_format((float) $service->rate, 0)
                                    : '$' . number_format((float) $service->rate, 2);
                            @endphp
                            <tr>
                                <td class="fw-semibold">{{ $service->name }}</td>
                                <td>{{ Str::limit($service->description, 100) }}</td>
                                <td>
                                    <span class="currency-pill">{{ $svcCurrency }}</span>
                                </td>
                                <td class="rate-value">{{ $rateDisplay }}</td>
                                <td>{{ ucfirst($service->unit) }}</td>
                                <td class="text-end">
                                    <div class="cs-actions">
                                        <a href="{{ route('admin.client-services.edit', $service) }}"
                                           class="cs-action-btn edit" title="Edit">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <form action="{{ route('admin.client-services.destroy', $service) }}"
                                              method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this service?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="cs-action-btn delete" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center p-3 border-top">
                {{ $services->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
