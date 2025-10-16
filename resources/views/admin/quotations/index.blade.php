@extends('layouts.admin')

@section('title', 'Quotations')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Quotations</h1>
        <a href="{{ route('admin.quotations.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> New Quotation
        </a>
    </div>

    <div class="card shadow">
        <div class="card-body">
            @if($quotations->isEmpty())
                <div class="text-center p-4">
                    <i class="fas fa-file-invoice fa-3x text-muted mb-3"></i>
                    <p class="text-muted">No quotations found.</p>
                    <a href="{{ route('admin.quotations.create') }}" class="btn btn-primary">
                        Create your first quotation
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Quote #</th>
                                <th>Client</th>
                                <th>Date</th>
                                <th>Valid Until</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quotations as $quotation)
                                <tr>
                                    <td>{{ $quotation->quote_number }}</td>
                                    <td>{{ $quotation->client->name }}</td>
                                    <td>{{ $quotation->date->format('M d, Y') }}</td>
                                    <td>{{ $quotation->valid_until->format('M d, Y') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $quotation->status_color }}">
                                            {{ ucfirst($quotation->status) }}
                                        </span>
                                    </td>
                                    <td>${{ number_format($quotation->total_amount, 2) }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.quotations.edit', $quotation) }}" 
                                               class="btn btn-sm btn-outline-primary" 
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('admin.quotations.print', $quotation) }}" 
                                               class="btn btn-sm btn-outline-info" 
                                               title="Print"
                                               target="_blank">
                                                <i class="fas fa-print"></i>
                                            </a>
                                            <a href="{{ route('admin.quotations.pdf', $quotation) }}" 
                                               class="btn btn-sm btn-outline-secondary" 
                                               title="Download PDF">
                                                <i class="fas fa-file-pdf"></i>
                                            </a>
                                            <form action="{{ route('admin.quotations.destroy', $quotation) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Are you sure you want to delete this quotation?');"
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-outline-danger" 
                                                        title="Delete">
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
                    {{ $quotations->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
