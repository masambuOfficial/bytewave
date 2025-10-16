@extends('layouts.admin')

@section('title', 'Task Management')

@push('styles')
<style>
    .task-card {
        transition: transform 0.2s;
    }
    .task-card:hover {
        transform: translateY(-5px);
    }
    .status-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.875rem;
    }
    .priority-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.875rem;
    }
    .action-buttons {
        transition: opacity 0.2s;
        opacity: 0;
    }
    .task-card:hover .action-buttons {
        opacity: 1;
    }
    .status-untrackable { background-color: #dc3545 !important; color: white; }
    .status-submitted { background-color: #fd7e14 !important; color: white; }
    .status-completed { background-color: #198754 !important; color: white; }
    .status-in-progress { background-color: #0dcaf0 !important; color: white; }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Task Management</h1>
        <a href="{{ route('admin.tasks.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> New Task
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($tasks->isEmpty())
        <div class="text-center py-5">
            <i class="fas fa-tasks fa-4x text-muted mb-3"></i>
            <p class="text-muted">No tasks found.</p>
            <a href="{{ route('admin.tasks.create') }}" class="btn btn-primary">
                Create your first task
            </a>
        </div>
    @else
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Task ID</th>
                                <th>Description</th>
                                <th>Assignee</th>
                                <th>Status</th>
                                <th>Start Date</th>
                                <th>Due Date</th>
                                <th>Priority</th>
                                <th>Comments</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <td>{{ $task->task_id }}</td>
                                    <td>{{ $task->description }}</td>
                                    <td>{{ $task->assignee }}</td>
                                    <td>
                                        <span class="badge status-{{ $task->status }}">
                                            {{ ucfirst($task->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $task->start_date ? $task->start_date->format('d/m/Y') : '-' }}</td>
                                    <td>{{ $task->due_date ? $task->due_date->format('d/m/Y') : '-' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $task->getPriorityBadgeClass() }}">
                                            {{ ucfirst($task->priority) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($task->comments)
                                            <button type="button" 
                                                    class="btn btn-sm btn-link" 
                                                    data-bs-toggle="popover" 
                                                    data-bs-content="{{ $task->comments }}">
                                                View Comments
                                            </button>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.tasks.edit', $task) }}" 
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.tasks.destroy', $task) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this task?');">
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
            </div>
        </div>

        <div class="d-flex justify-content-center">
            {{ $tasks->links() }}
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    const popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl, {
            trigger: 'click',
            placement: 'top'
        });
    });

    // Hide popovers when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.hasAttribute('data-bs-toggle')) {
            popoverList.forEach(popover => {
                popover.hide();
            });
        }
    });
});
</script>
@endpush
