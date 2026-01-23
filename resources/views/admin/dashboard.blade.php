@extends('layouts.admin')

@section('title', 'Dashboard')

@push('styles')
<style>
    /* Modern Dashboard Styling with BYTEWAVE Colors */
    :root {
        --bytewave-blue: #0773B8;
        --bytewave-blue-dark: #04456E;
        --bytewave-gold: #FBB145;
        --bytewave-light: #E6F3FB;
    }

    .dashboard-header {
        background: linear-gradient(135deg, var(--bytewave-blue) 0%, #055C93 100%);
        color: white;
        padding: 2rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        box-shadow: 0 4px 20px rgba(7, 115, 184, 0.15);
    }

    .dashboard-header h1 {
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
    }

    .dashboard-header .date-info {
        font-size: 0.95rem;
        opacity: 0.9;
        margin-top: 0.5rem;
    }

    .stat-card {
        border: none;
        border-radius: 12px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        background: white;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
    }

    .stat-card.stat-blue::before {
        background: linear-gradient(90deg, var(--bytewave-blue) 0%, #339FDF 100%);
    }

    .stat-card.stat-gold::before {
        background: linear-gradient(90deg, var(--bytewave-gold) 0%, #FCC372 100%);
    }

    .stat-card.stat-teal::before {
        background: linear-gradient(90deg, #06B6D4 0%, #14B8A6 100%);
    }

    .stat-card.stat-purple::before {
        background: linear-gradient(90deg, #A855F7 0%, #EC4899 100%);
    }

    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(7, 115, 184, 0.15);
    }

    .stat-card-body {
        padding: 1.5rem;
    }

    .stat-icon {
        font-size: 2.5rem;
        opacity: 0.15;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #6B7280;
    }

    .stat-value {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--bytewave-blue-dark);
        margin-top: 0.5rem;
    }

    .stat-card.stat-blue .stat-label {
        color: var(--bytewave-blue);
    }

    .stat-card.stat-gold .stat-label {
        color: #B8860B;
    }

    .stat-card.stat-teal .stat-label {
        color: #0D9488;
    }

    .stat-card.stat-purple .stat-label {
        color: #9F1239;
    }

    /* Section Headers */
    .section-header {
        background: white;
        padding: 1.25rem 1.5rem;
        border-bottom: 2px solid var(--bytewave-blue);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .section-header h6 {
        margin: 0;
        font-weight: 700;
        color: var(--bytewave-blue);
        font-size: 1.1rem;
    }

    .section-header-icon {
        font-size: 1.2rem;
        color: var(--bytewave-blue);
    }

    /* Quick Actions */
    .quick-action-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 1.5rem;
        border: 2px solid #E5E7EB;
        border-radius: 12px;
        text-decoration: none;
        color: inherit;
        transition: all 0.3s ease;
        background: white;
        position: relative;
        overflow: hidden;
    }

    .quick-action-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: var(--bytewave-blue);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.3s ease;
    }

    .quick-action-card:hover {
        border-color: var(--bytewave-blue);
        background: var(--bytewave-light);
        transform: translateY(-4px);
        box-shadow: 0 8px 16px rgba(7, 115, 184, 0.1);
    }

    .quick-action-card:hover::before {
        transform: scaleX(1);
    }

    .quick-action-icon {
        font-size: 2rem;
        margin-bottom: 0.75rem;
        color: var(--bytewave-blue);
        transition: color 0.3s ease;
    }

    .quick-action-card:hover .quick-action-icon {
        color: var(--bytewave-gold);
    }

    .quick-action-title {
        font-weight: 600;
        text-align: center;
        font-size: 0.95rem;
        color: var(--bytewave-blue-dark);
    }

    /* Activity List */
    .activity-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .activity-item {
        padding: 1rem 0;
        border-bottom: 1px solid #F3F4F6;
        transition: background-color 0.2s ease;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-item:hover {
        background-color: var(--bytewave-light);
        padding: 1rem;
        margin: 0 -1.5rem;
        padding: 1rem 1.5rem;
    }

    .activity-title {
        font-weight: 600;
        color: var(--bytewave-blue-dark);
        margin-bottom: 0.25rem;
    }

    .activity-description {
        font-size: 0.9rem;
        color: #6B7280;
        margin-bottom: 0.25rem;
    }

    .activity-time {
        font-size: 0.8rem;
        color: #9CA3AF;
    }

    .activity-badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        margin-top: 0.5rem;
    }

    .badge-sent {
        background: linear-gradient(135deg, var(--bytewave-blue-100) 0%, var(--bytewave-blue-50) 100%);
        color: var(--bytewave-blue);
    }

    .badge-pending {
        background: linear-gradient(135deg, #FEF5E7 0%, #FEEBD0 100%);
        color: #B8860B;
    }

    .badge-overdue {
        background: linear-gradient(135deg, #FEE2E2 0%, #FECACA 100%);
        color: #DC2626;
    }

    .badge-draft {
        background: linear-gradient(135deg, #F3E8FF 0%, #EDE9FE 100%);
        color: #7C3AED;
    }

    /* Card Container */
    .dashboard-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        background: white;
        margin-bottom: 1.5rem;
    }

    .dashboard-card-body {
        padding: 1.5rem;
    }
</style>
@endpush

@section('content')
<div class="container-fluid" style="padding: 1.5rem;">
    <!-- Welcome Section -->
    <div class="dashboard-header">
        <h1>Welcome back, {{ Auth::user()->name }}! 👋</h1>
        <div class="date-info">
            <i class="fas fa-calendar-alt" style="margin-right: 0.5rem;"></i>
            {{ now()->format('l, F j, Y') }}
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row">
        <!-- Quotations Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card stat-blue">
                <div class="stat-card-body">
                    <div class="stat-label">
                        <i class="fas fa-file-invoice" style="margin-right: 0.5rem;"></i>Active Quotations
                    </div>
                    <div class="stat-value">{{ App\Models\Quotation::where('status', 'sent')->count() }}</div>
                </div>
            </div>
        </div>

        <!-- Invoices Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card stat-gold">
                <div class="stat-card-body">
                    <div class="stat-label">
                        <i class="fas fa-file-invoice-dollar" style="margin-right: 0.5rem;"></i>Pending Invoices
                    </div>
                    <div class="stat-value">{{ App\Models\Invoice::whereIn('status', ['sent', 'overdue'])->count() }}</div>
                </div>
            </div>
        </div>

        <!-- Services Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card stat-teal">
                <div class="stat-card-body">
                    <div class="stat-label">
                        <i class="fas fa-cogs" style="margin-right: 0.5rem;"></i>Active Services
                    </div>
                    <div class="stat-value">{{ App\Models\ClientService::count() }}</div>
                </div>
            </div>
        </div>

        <!-- Blog Posts Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card stat-purple">
                <div class="stat-card-body">
                    <div class="stat-label">
                        <i class="fas fa-blog" style="margin-right: 0.5rem;"></i>Published Posts
                    </div>
                    <div class="stat-value">{{ App\Models\Post::count() }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Quick Actions -->
        <div class="col-lg-6 mb-4">
            <div class="dashboard-card">
                <div class="section-header">
                    <i class="fas fa-zap section-header-icon"></i>
                    <h6>Quick Actions</h6>
                </div>
                <div class="dashboard-card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('admin.quotations.create') }}" class="quick-action-card">
                                <i class="fas fa-file-invoice quick-action-icon"></i>
                                <h5 class="quick-action-title">New Quotation</h5>
                            </a>
                        </div>
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('admin.invoices.create') }}" class="quick-action-card">
                                <i class="fas fa-file-invoice-dollar quick-action-icon"></i>
                                <h5 class="quick-action-title">New Invoice</h5>
                            </a>
                        </div>
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('admin.client-services.create') }}" class="quick-action-card">
                                <i class="fas fa-cog quick-action-icon"></i>
                                <h5 class="quick-action-title">Add Service</h5>
                            </a>
                        </div>
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('admin.posts.create') }}" class="quick-action-card">
                                <i class="fas fa-pen quick-action-icon"></i>
                                <h5 class="quick-action-title">New Post</h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="col-lg-6 mb-4">
            <div class="dashboard-card">
                <div class="section-header">
                    <i class="fas fa-history section-header-icon"></i>
                    <h6>Recent Activity</h6>
                </div>
                <div class="dashboard-card-body">
                    <ul class="activity-list">
                        @foreach(App\Models\Invoice::latest()->take(3)->get() as $invoice)
                            <li class="activity-item">
                                <div class="activity-title">Invoice #{{ $invoice->invoice_number }}</div>
                                <div class="activity-description">{{ $invoice->client->name ?? 'Unknown Client' }}</div>
                                <div class="activity-time">
                                    <i class="fas fa-clock" style="margin-right: 0.25rem;"></i>{{ $invoice->created_at->diffForHumans() }}
                                </div>
                                <span class="activity-badge badge-{{ $invoice->status }}">{{ ucfirst($invoice->status) }}</span>
                            </li>
                        @endforeach

                        @foreach(App\Models\Quotation::latest()->take(3)->get() as $quotation)
                            <li class="activity-item">
                                <div class="activity-title">Quotation #{{ $quotation->quote_number }}</div>
                                <div class="activity-description">{{ $quotation->client->name ?? 'Unknown Client' }}</div>
                                <div class="activity-time">
                                    <i class="fas fa-clock" style="margin-right: 0.25rem;"></i>{{ $quotation->created_at->diffForHumans() }}
                                </div>
                                <span class="activity-badge badge-{{ $quotation->status }}">{{ ucfirst($quotation->status) }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection