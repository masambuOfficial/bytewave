@extends('layouts.admin')

@section('title', 'Client Services')

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
    .bw-table tbody td {
        padding: 0.85rem 0.9rem;
        vertical-align: middle;
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
        padding: 0.85rem 0.9rem;
        white-space: nowrap;
    }
    .bw-actions {
        display: flex;
        gap: 0.5rem;
        justify-content: flex-end;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
            <h1 class="bw-title">Client Services</h1>
            <div class="bw-subtitle">Manage service templates and suggested rates.</div>
        </div>
        <a href="{{ route('admin.client-services.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Service
        </a>
    </div>

    <div class="card shadow-sm bw-card">
        <div class="card-header bw-card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="fw-semibold">All Services</div>
            </div>
        </div>
        <div class="px-3 pt-3 pb-3">
            <form method="GET" action="{{ route('admin.client-services.index') }}" class="row g-2 align-items-end">
                <div class="col-12 col-md-5">
                    <label class="form-label mb-1 visually-hidden" for="q">Search</label>
                    <input type="text" id="q" name="q" value="{{ request('q') }}" class="form-control" placeholder="Name, description, unit">
                </div>
                <div class="col-6 col-md-3">
                    <label class="form-label mb-1" for="currency">Currency</label>
                    <select class="form-select" id="currency" name="currency">
                        <option value="">All</option>
                        <option value="UGX" {{ request('currency') === 'UGX' ? 'selected' : '' }}>UGX</option>
                        <option value="USD" {{ request('currency') === 'USD' ? 'selected' : '' }}>USD</option>
                    </select>
                </div>
                <div class="col-6 col-md-2">
                    <label class="form-label mb-1" for="status">Status</label>
                    <select class="form-select" id="status" name="status">
                        <option value="">All</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="col-12 col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('admin.client-services.index') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>
        </div>
        <div class="card-body p-0">
            @if($services->isEmpty())
                <div class="text-center p-4">
                    <p class="text-muted">No client services found.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover mb-0 bw-table">
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
                                    <td>{{ $service->name }}</td>
                                    <td>{{ Str::limit($service->description, 100) }}</td>
                                    <td>
                                        <span class="badge text-bg-light">{{ $svcCurrency }}</span>
                                    </td>
                                    <td class="fw-semibold">{{ $rateDisplay }}</td>
                                    <td>{{ ucfirst($service->unit) }}</td>
                                    <td class="text-end">
                                        <div class="bw-actions">
                                            <a href="{{ route('admin.client-services.edit', $service) }}" 
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.client-services.destroy', $service) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Are you sure you want to delete this service?');"
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
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
</div>
@endsection
