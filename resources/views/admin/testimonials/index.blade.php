@extends('layouts.admin')

@section('title', 'Testimonials')

@push('styles')
<style>
    .testimonials-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1.5rem;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .testimonials-header h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--bytewave-blue-dark);
        margin-bottom: 0.25rem;
    }

    .testimonials-header p {
        color: #6B7A85;
        font-size: 0.9rem;
        margin-bottom: 0;
    }

    .btn-add-testimonial {
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

    .btn-add-testimonial:hover {
        background: var(--bytewave-blue-dark);
        color: #fff;
        transform: translateY(-1px);
    }

    .status-tabs {
        display: flex;
        gap: 0.4rem;
        background: #F1F4F7;
        padding: 0.35rem;
        border-radius: 12px;
        margin-bottom: 1.5rem;
        width: fit-content;
        flex-wrap: wrap;
    }

    .status-tab {
        padding: 0.5rem 1rem;
        border-radius: 9px;
        font-size: 0.85rem;
        font-weight: 600;
        color: #6B7A85;
        text-decoration: none;
        transition: background 0.2s ease, color 0.2s ease;
        white-space: nowrap;
    }

    .status-tab:hover {
        color: var(--bytewave-blue-dark);
    }

    .status-tab.active {
        background: #fff;
        color: var(--bytewave-blue-dark);
        box-shadow: 0 2px 6px rgba(4, 69, 110, 0.1);
    }

    .testimonials-table-card {
        background: #fff;
        border: 1px solid #EEF1F4;
        border-radius: 16px;
        overflow: hidden;
    }

    .testimonials-table {
        width: 100%;
        margin-bottom: 0;
    }

    .testimonials-table thead th {
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

    .testimonials-table tbody td {
        padding: 0.9rem 1.1rem;
        border-bottom: 1px solid #F4F6F8;
        vertical-align: middle;
        font-size: 0.88rem;
        color: #1F2A33;
    }

    .testimonials-table tbody tr:last-child td {
        border-bottom: none;
    }

    .testimonials-table tbody tr:hover {
        background: #FAFCFE;
    }

    .client-avatar {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        object-fit: cover;
        flex-shrink: 0;
    }

    .client-avatar-fallback {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: var(--bytewave-blue-light);
        color: var(--bytewave-blue-dark);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        flex-shrink: 0;
    }

    .client-name {
        font-weight: 600;
        color: #1F2A33;
    }

    .client-meta {
        color: #8A97A0;
        font-size: 0.78rem;
    }

    .testimonial-excerpt {
        max-width: 280px;
        color: #6B7A85;
        line-height: 1.5;
    }

    .rating-stars {
        color: var(--bytewave-gold);
        font-size: 0.85rem;
        white-space: nowrap;
    }

    .status-pill {
        display: inline-flex;
        align-items: center;
        padding: 0.3rem 0.7rem;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 700;
    }

    .status-pill.approved {
        background: #E9F9EF;
        color: #1E8E4F;
    }

    .status-pill.pending {
        background: rgba(251, 177, 69, 0.15);
        color: #92600C;
    }

    .status-pill.rejected {
        background: #FDEDEC;
        color: #C0392B;
    }

    .featured-star {
        color: var(--bytewave-gold);
    }

    .row-actions {
        display: flex;
        gap: 0.35rem;
        white-space: nowrap;
    }

    .row-action-btn {
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

    .row-action-btn.approve {
        background: #E9F9EF;
        color: #1E8E4F;
    }

    .row-action-btn.approve:hover {
        background: #1E8E4F;
        color: #fff;
    }

    .row-action-btn.reject {
        background: rgba(251, 177, 69, 0.15);
        color: #92600C;
    }

    .row-action-btn.reject:hover {
        background: #92600C;
        color: #fff;
    }

    .row-action-btn.edit {
        background: var(--bytewave-blue-light);
        color: var(--bytewave-blue-dark);
    }

    .row-action-btn.edit:hover {
        background: var(--bytewave-blue);
        color: #fff;
    }

    .row-action-btn.delete {
        background: #FDEDEC;
        color: #C0392B;
    }

    .row-action-btn.delete:hover {
        background: #E74C3C;
        color: #fff;
    }

    .testimonials-empty {
        text-align: center;
        padding: 4rem 1rem;
        background: #fff;
        border: 1px dashed #DCE3E8;
        border-radius: 16px;
    }

    .testimonials-empty i {
        font-size: 2.75rem;
        color: var(--bytewave-blue);
        opacity: 0.35;
        margin-bottom: 1rem;
    }

    .testimonials-empty p {
        color: #6B7A85;
        margin-bottom: 0;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="testimonials-header">
        <div>
            <h1>Testimonials</h1>
            <p>Review and manage client testimonials for your website.</p>
        </div>
        <a href="{{ route('admin.testimonials.create') }}" class="btn-add-testimonial">
            <i class="fas fa-plus"></i> Add New Testimonial
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Filter Tabs -->
    <div class="status-tabs">
        <a class="status-tab {{ request('status') == null ? 'active' : '' }}" href="{{ route('admin.testimonials.index') }}">
            All ({{ \App\Models\Testimonial::count() }})
        </a>
        <a class="status-tab {{ request('status') == 'pending' ? 'active' : '' }}" href="{{ route('admin.testimonials.index', ['status' => 'pending']) }}">
            Pending ({{ \App\Models\Testimonial::where('status', 'pending')->count() }})
        </a>
        <a class="status-tab {{ request('status') == 'approved' ? 'active' : '' }}" href="{{ route('admin.testimonials.index', ['status' => 'approved']) }}">
            Approved ({{ \App\Models\Testimonial::where('status', 'approved')->count() }})
        </a>
        <a class="status-tab {{ request('status') == 'rejected' ? 'active' : '' }}" href="{{ route('admin.testimonials.index', ['status' => 'rejected']) }}">
            Rejected ({{ \App\Models\Testimonial::where('status', 'rejected')->count() }})
        </a>
    </div>

    @if($testimonials->isEmpty())
        <div class="testimonials-empty">
            <i class="fas fa-comments"></i>
            <p>No testimonials found.</p>
        </div>
    @else
        <div class="testimonials-table-card">
            <div class="table-responsive">
                <table class="testimonials-table">
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th>Testimonial</th>
                            <th>Rating</th>
                            <th>Status</th>
                            <th>Featured</th>
                            <th>Order</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($testimonials as $testimonial)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    @if($testimonial->avatar)
                                        <img src="{{ asset('storage/' . $testimonial->avatar) }}" alt="{{ $testimonial->name }}" class="client-avatar">
                                    @else
                                        <div class="client-avatar-fallback">
                                            <span>{{ substr($testimonial->name, 0, 1) }}</span>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="client-name">{{ $testimonial->name }}</div>
                                        <div class="client-meta">{{ $testimonial->title }}{{ $testimonial->company ? ' at ' . $testimonial->company : '' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="testimonial-excerpt">
                                    {{ Str::limit($testimonial->testimonial, 100) }}
                                </div>
                            </td>
                            <td>
                                <div class="rating-stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $testimonial->rating)
                                            <i class="fas fa-star"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                </div>
                            </td>
                            <td>
                                @if($testimonial->status == 'approved')
                                    <span class="status-pill approved">Approved</span>
                                @elseif($testimonial->status == 'pending')
                                    <span class="status-pill pending">Pending</span>
                                @else
                                    <span class="status-pill rejected">Rejected</span>
                                @endif
                            </td>
                            <td>
                                @if($testimonial->is_featured)
                                    <i class="fas fa-star featured-star"></i>
                                @endif
                            </td>
                            <td>{{ $testimonial->order }}</td>
                            <td>{{ $testimonial->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="row-actions">
                                    @if($testimonial->status == 'pending')
                                        <form action="{{ route('admin.testimonials.approve', $testimonial) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="row-action-btn approve" title="Approve">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.testimonials.reject', $testimonial) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="row-action-btn reject" title="Reject">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="row-action-btn edit" title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this testimonial?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="row-action-btn delete" title="Delete">
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
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $testimonials->links() }}
        </div>
    @endif
</div>
@endsection
