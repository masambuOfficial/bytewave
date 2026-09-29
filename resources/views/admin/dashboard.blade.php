@extends('layouts.admin')

@section('title', 'Dashboard')

@push('styles')
<style>
    .dash-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1.75rem;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .dash-header h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--bytewave-blue-dark);
        margin-bottom: 0.25rem;
    }

    .dash-header p {
        color: #546270;
        font-size: 0.9rem;
        margin-bottom: 0;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    /* Stat Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.25rem;
        margin-bottom: 1.75rem;
    }

    .stat-card {
        background: #fff;
        border: 1px solid #CDE3F1;
        border-radius: 16px;
        padding: 1.25rem 1.35rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        text-decoration: none;
        transition: box-shadow 0.25s ease, transform 0.25s ease, border-color 0.25s ease;
    }

    .stat-card:hover {
        box-shadow: 0 12px 28px rgba(11, 31, 51, 0.1);
        transform: translateY(-3px);
        border-color: var(--bytewave-blue-light);
    }

    .stat-icon-box {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.15rem;
        flex-shrink: 0;
    }

    .stat-icon-box.blue { background: var(--bytewave-blue-light); color: var(--bytewave-blue-dark); }
    .stat-icon-box.green { background: #E3F5EA; color: #17703F; }
    .stat-icon-box.purple { background: #E6F1F8; color: #0773B9; }

    .stat-label {
        font-size: 0.78rem;
        font-weight: 600;
        color: #546270;
        margin-bottom: 0.2rem;
    }

    .stat-value {
        font-size: 1.4rem;
        font-weight: 700;
        color: #0B1F33;
    }

    /* Section Cards */
    .dash-card {
        background: #fff;
        border: 1px solid #CDE3F1;
        border-radius: 16px;
        overflow: hidden;
        height: 100%;
    }

    .dash-card-header {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        padding: 1.1rem 1.35rem;
        border-bottom: 1px solid #CDE3F1;
    }

    .dash-card-header i {
        color: var(--bytewave-blue);
        font-size: 1rem;
    }

    .dash-card-header h6 {
        margin: 0;
        font-weight: 700;
        font-size: 0.95rem;
        color: #0B1F33;
    }

    .dash-card-body {
        padding: 1.35rem;
    }

    /* Quick Actions */
    .quick-actions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: 0.9rem;
    }

    .quick-action-card {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.9rem 1rem;
        border: 1px solid #CDE3F1;
        border-radius: 12px;
        text-decoration: none;
        transition: border-color 0.2s ease, background 0.2s ease;
    }

    .quick-action-card:hover {
        border-color: var(--bytewave-blue);
        background: var(--bytewave-blue-light);
    }

    .quick-action-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: var(--bytewave-blue-light);
        color: var(--bytewave-blue-dark);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.95rem;
        flex-shrink: 0;
    }

    .quick-action-title {
        font-weight: 600;
        font-size: 0.85rem;
        color: #0B1F33;
        margin: 0;
    }

    /* Activity List */
    .activity-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .activity-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 0.75rem;
        padding: 0.85rem 0;
        border-bottom: 1px solid #CDE3F1;
    }

    .activity-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .activity-item:first-child {
        padding-top: 0;
    }

    .activity-title {
        font-weight: 600;
        color: #0B1F33;
        font-size: 0.88rem;
        margin-bottom: 0.15rem;
    }

    .activity-description {
        font-size: 0.8rem;
        color: #546270;
    }

    .activity-time {
        font-size: 0.75rem;
        color: #546270;
        white-space: nowrap;
    }

    .status-pill {
        display: inline-flex;
        align-items: center;
        padding: 0.3rem 0.7rem;
        border-radius: 999px;
        font-size: 0.72rem;
        font-weight: 700;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .status-pill.bg-secondary { background: #F3F8FC !important; color: #546270 !important; }
    .status-pill.bg-info { background: var(--bytewave-blue-light) !important; color: var(--bytewave-blue-dark) !important; }
    .status-pill.bg-primary { background: var(--bytewave-blue-light) !important; color: var(--bytewave-blue-dark) !important; }
    .status-pill.bg-success { background: #E3F5EA !important; color: #17703F !important; }
    .status-pill.bg-danger { background: #FDEDEC !important; color: #C0392B !important; }
    .status-pill.bg-dark { background: #E6F1F8 !important; color: #0B1F33 !important; }

    .activity-empty {
        color: #546270;
        font-size: 0.85rem;
        text-align: center;
        padding: 1.5rem 0;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="dash-header">
        <div>
            <h1>Welcome back, {{ Auth::user()->name }}</h1>
            <p><i class="fas fa-calendar-alt"></i> {{ now()->format('l, F j, Y') }}</p>
        </div>
    </div>

    @php
        $activity = App\Models\Invoice::with('client')->latest()->take(3)->get()
            ->map(fn ($invoice) => [
                'title' => 'Invoice #' . $invoice->invoice_number,
                'client' => $invoice->client->name ?? 'Unknown Client',
                'time' => $invoice->created_at,
                'status' => ucwords(str_replace('_', ' ', $invoice->status)),
                'color' => $invoice->status_color,
            ])
            ->concat(
                App\Models\Quotation::with('client')->latest()->take(3)->get()
                    ->map(fn ($quotation) => [
                        'title' => 'Quotation #' . $quotation->quote_number,
                        'client' => $quotation->client->name ?? 'Unknown Client',
                        'time' => $quotation->created_at,
                        'status' => ucfirst($quotation->status),
                        'color' => $quotation->status_color,
                    ])
            )
            ->sortByDesc('time')
            ->take(5);
    @endphp

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <a href="{{ route('admin.quotations.index', ['status' => 'sent']) }}" class="stat-card">
            <div class="stat-icon-box blue"><i class="fas fa-file-invoice"></i></div>
            <div>
                <div class="stat-label">Active Quotations</div>
                <div class="stat-value">{{ App\Models\Quotation::where('status', 'sent')->count() }}</div>
            </div>
        </a>

        <a href="{{ route('admin.invoices.index', ['status' => 'issued']) }}" class="stat-card">
            <div class="stat-icon-box blue"><i class="fas fa-file-invoice-dollar"></i></div>
            <div>
                <div class="stat-label">Pending Invoices</div>
                <div class="stat-value">{{ App\Models\Invoice::whereIn('status', ['issued', 'partially_paid', 'overdue'])->count() }}</div>
            </div>
        </a>

        <a href="{{ route('admin.client-services.index', ['status' => 'active']) }}" class="stat-card">
            <div class="stat-icon-box green"><i class="fas fa-cogs"></i></div>
            <div>
                <div class="stat-label">Active Services</div>
                <div class="stat-value">{{ App\Models\ClientService::where('status', 'active')->count() }}</div>
            </div>
        </a>

        <a href="{{ route('admin.posts.index', ['status' => 'published']) }}" class="stat-card">
            <div class="stat-icon-box purple"><i class="fas fa-blog"></i></div>
            <div>
                <div class="stat-label">Published Posts</div>
                <div class="stat-value">{{ App\Models\Post::published()->count() }}</div>
            </div>
        </a>
    </div>

    <div class="row">
        <!-- Quick Actions -->
        <div class="col-lg-6 mb-4">
            <div class="dash-card">
                <div class="dash-card-header">
                    <i class="fas fa-bolt"></i>
                    <h6>Quick Actions</h6>
                </div>
                <div class="dash-card-body">
                    <div class="quick-actions-grid">
                        <a href="{{ route('admin.quotations.create') }}" class="quick-action-card">
                            <div class="quick-action-icon"><i class="fas fa-file-invoice"></i></div>
                            <p class="quick-action-title">New Quotation</p>
                        </a>
                        <a href="{{ route('admin.invoices.create') }}" class="quick-action-card">
                            <div class="quick-action-icon"><i class="fas fa-file-invoice-dollar"></i></div>
                            <p class="quick-action-title">New Invoice</p>
                        </a>
                        <a href="{{ route('admin.client-services.create') }}" class="quick-action-card">
                            <div class="quick-action-icon"><i class="fas fa-cog"></i></div>
                            <p class="quick-action-title">Add Service</p>
                        </a>
                        <a href="{{ route('admin.posts.create') }}" class="quick-action-card">
                            <div class="quick-action-icon"><i class="fas fa-pen"></i></div>
                            <p class="quick-action-title">New Post</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="col-lg-6 mb-4">
            <div class="dash-card">
                <div class="dash-card-header">
                    <i class="fas fa-history"></i>
                    <h6>Recent Activity</h6>
                </div>
                <div class="dash-card-body">
                    @if($activity->isEmpty())
                        <div class="activity-empty">No recent activity yet.</div>
                    @else
                        <ul class="activity-list">
                            @foreach($activity as $item)
                                <li class="activity-item">
                                    <div>
                                        <div class="activity-title">{{ $item['title'] }}</div>
                                        <div class="activity-description">{{ $item['client'] }}</div>
                                        <div class="activity-time"><i class="fas fa-clock"></i> {{ $item['time']->diffForHumans() }}</div>
                                    </div>
                                    <span class="status-pill bg-{{ $item['color'] }}">{{ $item['status'] }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
