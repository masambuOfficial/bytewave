@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Invoices</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.invoices.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Create New Invoice
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Invoice #</th>
                                <th>Client</th>
                                <th>Date</th>
                                <th>Due Date</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($invoices as $invoice)
                            <tr>
                                <td>{{ $invoice->invoice_number }}</td>
                                <td>{{ $invoice->client->name }}</td>
                                <td>{{ $invoice->date->format('Y-m-d') }}</td>
                                <td>{{ $invoice->due_date->format('Y-m-d') }}</td>
                                <td>${{ number_format($invoice->total_amount, 2) }}</td>
                                <td>
                                    <span class="badge badge-{{ $invoice->status_color }}">
                                        {{ $invoice->status }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.invoices.show', $invoice->id) }}" class="btn btn-sm btn-info" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.invoices.edit', $invoice->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('admin.invoices.print', $invoice->id) }}" class="btn btn-sm btn-secondary" title="Print" target="_blank">
                                            <i class="fas fa-print"></i>
                                        </a>
                                        <a href="{{ route('admin.invoices.pdf', $invoice->id) }}" class="btn btn-sm btn-dark" title="Download PDF" target="_blank">
                                            <i class="fas fa-file-pdf"></i>
                                        </a>
                                        <form action="{{ route('admin.invoices.destroy', $invoice->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">No invoices found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    @if($invoices->hasPages())
                    <div class="mt-4">
                        {{ $invoices->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
