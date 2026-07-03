@extends('layouts.admin')

@section('title', 'Testimonials')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Testimonials</h1>
        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Testimonial
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <!-- Filter Tabs -->
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link {{ request('status') == null ? 'active' : '' }}" href="{{ route('admin.testimonials.index') }}">
                All ({{ \App\Models\Testimonial::count() }})
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('status') == 'pending' ? 'active' : '' }}" href="{{ route('admin.testimonials.index', ['status' => 'pending']) }}">
                Pending ({{ \App\Models\Testimonial::where('status', 'pending')->count() }})
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('status') == 'approved' ? 'active' : '' }}" href="{{ route('admin.testimonials.index', ['status' => 'approved']) }}">
                Approved ({{ \App\Models\Testimonial::where('status', 'approved')->count() }})
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('status') == 'rejected' ? 'active' : '' }}" href="{{ route('admin.testimonials.index', ['status' => 'rejected']) }}">
                Rejected ({{ \App\Models\Testimonial::where('status', 'rejected')->count() }})
            </a>
        </li>
    </ul>

    @if($testimonials->isEmpty())
        <div class="text-center py-5">
            <i class="fas fa-comments fa-4x text-muted mb-3"></i>
            <p class="text-muted">No testimonials found.</p>
        </div>
    @else
        <div class="card shadow">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
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
                                <div class="d-flex align-items-center">
                                    @if($testimonial->avatar)
                                        <img src="{{ asset('storage/' . $testimonial->avatar) }}" alt="{{ $testimonial->name }}" class="rounded-circle mr-2" width="40" height="40">
                                    @else
                                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-center mr-2" style="width: 40px; height: 40px;">
                                            <span>{{ substr($testimonial->name, 0, 1) }}</span>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="font-weight-bold">{{ $testimonial->name }}</div>
                                        <small class="text-muted">{{ $testimonial->title }}{{ $testimonial->company ? ' at ' . $testimonial->company : '' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div style="max-width: 300px;">
                                    {{ Str::limit($testimonial->testimonial, 100) }}
                                </div>
                            </td>
                            <td>
                                <div class="text-warning">
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
                                    <span class="badge badge-success">Approved</span>
                                @elseif($testimonial->status == 'pending')
                                    <span class="badge badge-warning">Pending</span>
                                @else
                                    <span class="badge badge-danger">Rejected</span>
                                @endif
                            </td>
                            <td>
                                @if($testimonial->is_featured)
                                    <i class="fas fa-star text-warning"></i>
                                @endif
                            </td>
                            <td>{{ $testimonial->order }}</td>
                            <td>{{ $testimonial->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    @if($testimonial->status == 'pending')
                                        <form action="{{ route('admin.testimonials.approve', $testimonial) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-success" title="Approve">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.testimonials.reject', $testimonial) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-warning" title="Reject">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="btn btn-sm btn-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this testimonial?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete">
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

        <div class="mt-4">
            {{ $testimonials->links() }}
        </div>
    @endif
</div>
@endsection
