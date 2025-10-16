@extends('layouts.admin')

@section('title', 'Dashboard')

@push('styles')
<style>
    .stat-card {
        transition: transform 0.2s;
    }
    .stat-card:hover {
        transform: translateY(-5px);
    }
    .quick-action {
        transition: all 0.2s;
    }
    .quick-action:hover {
        background-color: #f8f9fa;
        transform: scale(1.02);
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <!-- Welcome Section -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Welcome back, {{ Auth::user()->name }}!</h1>
        <div>
            <span class="text-muted">{{ now()->format('l, F j, Y') }}</span>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row">
        <!-- Quotations Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2 stat-card">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Active Quotations</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ App\Models\Quotation::where('status', 'sent')->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-invoice fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Invoices Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2 stat-card">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pending Invoices</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ App\Models\Invoice::whereIn('status', ['sent', 'overdue'])->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Services Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2 stat-card">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Active Services</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ App\Models\ClientService::count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-cogs fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Blog Posts Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2 stat-card">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Published Posts</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ App\Models\Post::count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-blog fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Quick Actions -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('admin.quotations.create') }}" class="card quick-action text-decoration-none">
                                <div class="card-body text-center">
                                    <i class="fas fa-file-invoice fa-2x mb-2 text-primary"></i>
                                    <h5 class="card-title mb-0">New Quotation</h5>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('admin.invoices.create') }}" class="card quick-action text-decoration-none">
                                <div class="card-body text-center">
                                    <i class="fas fa-file-invoice-dollar fa-2x mb-2 text-success"></i>
                                    <h5 class="card-title mb-0">New Invoice</h5>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('admin.client-services.create') }}" class="card quick-action text-decoration-none">
                                <div class="card-body text-center">
                                    <i class="fas fa-cog fa-2x mb-2 text-info"></i>
                                    <h5 class="card-title mb-0">Add Service</h5>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('admin.posts.create') }}" class="card quick-action text-decoration-none">
                                <div class="card-body text-center">
                                    <i class="fas fa-pen fa-2x mb-2 text-warning"></i>
                                    <h5 class="card-title mb-0">New Post</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Activity</h6>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        @foreach(App\Models\Invoice::latest()->take(3)->get() as $invoice)
                            <div class="list-group-item px-0">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">New Invoice #{{ $invoice->invoice_number }}</h6>
                                    <small class="text-muted">{{ $invoice->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="mb-1">Invoice for {{ $invoice->client->name ?? 'Unknown Client' }}</p>
                                <small class="text-muted">Status: <span class="badge bg-{{ $invoice->status_color }}">{{ ucfirst($invoice->status) }}</span></small>
                            </div>
                        @endforeach

                        @foreach(App\Models\Quotation::latest()->take(3)->get() as $quotation)
                            <div class="list-group-item px-0">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">New Quotation #{{ $quotation->quote_number }}</h6>
                                    <small class="text-muted">{{ $quotation->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="mb-1">Quotation for {{ $quotation->client->name ?? 'Unknown Client' }}</p>
                                <small class="text-muted">Status: <span class="badge bg-{{ $quotation->status_color }}">{{ ucfirst($quotation->status) }}</span></small>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection