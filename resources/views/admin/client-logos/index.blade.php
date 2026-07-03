@extends('layouts.admin')

@section('title', 'Client Logos')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Client Logos</h1>
        <a href="{{ route('admin.client-logos.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Logo
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

    @if($logos->isEmpty())
        <div class="text-center py-5">
            <i class="fas fa-image fa-4x text-muted mb-3"></i>
            <p class="text-muted">No client logos found.</p>
            <a href="{{ route('admin.client-logos.create') }}" class="btn btn-primary">
                Add your first logo
            </a>
        </div>
    @else
        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th width="80">Logo</th>
                                <th>Client Name</th>
                                <th>Website</th>
                                <th>Order</th>
                                <th>Status</th>
                                <th>Date Added</th>
                                <th width="150">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($logos as $logo)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $logo->logo) }}" alt="{{ $logo->name }}" class="img-thumbnail" style="max-width: 60px; max-height: 60px; object-fit: contain;">
                                </td>
                                <td class="align-middle">
                                    <strong>{{ $logo->name }}</strong>
                                </td>
                                <td class="align-middle">
                                    @if($logo->url)
                                        <a href="{{ $logo->url }}" target="_blank" class="text-primary">
                                            <i class="fas fa-external-link-alt"></i> Visit
                                        </a>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    <span class="badge badge-secondary">{{ $logo->order }}</span>
                                </td>
                                <td class="align-middle">
                                    @if($logo->is_active)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td class="align-middle">{{ $logo->created_at->format('M d, Y') }}</td>
                                <td class="align-middle">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.client-logos.edit', $logo) }}" class="btn btn-sm btn-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.client-logos.destroy', $logo) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this logo?');">
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
        </div>

        <div class="mt-3">
            <p class="text-muted small">
                <i class="fas fa-info-circle"></i> Logos are displayed in order (lower numbers appear first). Drag and drop functionality coming soon.
            </p>
        </div>
    @endif
</div>
@endsection
