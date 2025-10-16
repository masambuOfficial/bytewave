@extends('layouts.admin')

@section('title', 'Client Services')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Client Services</h1>
        <a href="{{ route('admin.client-services.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Service
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            @if($services->isEmpty())
                <div class="text-center p-4">
                    <p class="text-muted">No client services found.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Rate</th>
                                <th>Unit</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($services as $service)
                                <tr>
                                    <td>{{ $service->name }}</td>
                                    <td>{{ Str::limit($service->description, 100) }}</td>
                                    <td>${{ number_format($service->rate, 2) }}</td>
                                    <td>{{ ucfirst($service->unit) }}</td>
                                    <td>
                                        <div class="btn-group">
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

                <div class="d-flex justify-content-center mt-4">
                    {{ $services->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
