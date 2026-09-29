@extends('layouts.admin')

@section('title', 'Task Management')

@push('styles')
<style>
    .tasks-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1.5rem;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .tasks-header h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--bytewave-blue-dark);
        margin-bottom: 0.25rem;
    }

    .tasks-header p {
        color: #546270;
        font-size: 0.9rem;
        margin-bottom: 0;
    }

    .btn-add-task {
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

    .btn-add-task:hover {
        background: var(--bytewave-blue-dark);
        color: #fff;
        transform: translateY(-1px);
    }

    .tasks-card {
        background: #fff;
        border: 1px solid #CDE3F1;
        border-radius: 16px;
        overflow: hidden;
    }

    .tasks-table {
        width: 100%;
        margin-bottom: 0;
        min-width: 1100px;
    }

    .tasks-table thead th {
        background: #F3F8FC;
        color: #546270;
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        border-bottom: 1px solid #CDE3F1;
        padding: 0.9rem 1.1rem;
        white-space: nowrap;
    }

    .tasks-table tbody td {
        padding: 0.9rem 1.1rem;
        border-bottom: 1px solid #CDE3F1;
        vertical-align: middle;
        font-size: 0.88rem;
        color: #0B1F33;
    }

    .tasks-table tbody tr:last-child td {
        border-bottom: none;
    }

    .tasks-table tbody tr:hover {
        background: #F3F8FC;
    }

    .status-pill {
        display: inline-flex;
        align-items: center;
        padding: 0.3rem 0.7rem;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-untrackable { background: #FDEDEC; color: #C0392B; }
    .status-submitted { background: #FFF1D1; color: #92600C; }
    .status-completed { background: #E3F5EA; color: #17703F; }
    .status-in-progress { background: var(--bytewave-blue-light); color: var(--bytewave-blue-dark); }

    .priority-pill.bg-danger { background: #FDEDEC !important; color: #C0392B !important; }
    .priority-pill.bg-warning { background: #FFF1D1 !important; color: #92600C !important; }
    .priority-pill.bg-success { background: #E3F5EA !important; color: #17703F !important; }
    .priority-pill {
        display: inline-flex;
        align-items: center;
        padding: 0.3rem 0.7rem;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 700;
        white-space: nowrap;
    }

    .comments-link {
        background: none;
        border: none;
        color: var(--bytewave-blue);
        font-size: 0.82rem;
        font-weight: 600;
        padding: 0;
    }

    .comments-link:hover {
        color: var(--bytewave-blue-dark);
    }

    .task-actions {
        display: flex;
        gap: 0.35rem;
    }

    .task-action-btn {
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

    .task-action-btn.edit {
        background: var(--bytewave-blue-light);
        color: var(--bytewave-blue-dark);
    }

    .task-action-btn.edit:hover {
        background: var(--bytewave-blue);
        color: #fff;
    }

    .task-action-btn.delete {
        background: #FDEDEC;
        color: #C0392B;
    }

    .task-action-btn.delete:hover {
        background: #C0392B;
        color: #fff;
    }

    .tasks-empty {
        text-align: center;
        padding: 4rem 1rem;
        background: #fff;
        border: 1px dashed #CDE3F1;
        border-radius: 16px;
    }

    .tasks-empty i {
        font-size: 2.75rem;
        color: var(--bytewave-blue);
        opacity: 0.35;
        margin-bottom: 1rem;
    }

    .tasks-empty p {
        color: #546270;
        margin-bottom: 1.25rem;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="tasks-header">
        <div>
            <h1>Task Management</h1>
            <p>Track tasks, assignees, priorities and due dates.</p>
        </div>
        <x-admin.button href="{{ route('admin.tasks.create') }}">New Task</x-admin.button>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($tasks->isEmpty())
        <div class="tasks-empty">
            <i class="fas fa-tasks"></i>
            <p>No tasks found.</p>
            <x-admin.button href="{{ route('admin.tasks.create') }}">Create your first task</x-admin.button>
        </div>
    @else
        <div class="tasks-card mb-4">
            <div class="table-responsive">
                <table class="tasks-table">
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
                                    <span class="status-pill status-{{ $task->status }}">
                                        {{ ucfirst($task->status) }}
                                    </span>
                                </td>
                                <td>{{ $task->start_date ? $task->start_date->format('d/m/Y') : '-' }}</td>
                                <td>{{ $task->due_date ? $task->due_date->format('d/m/Y') : '-' }}</td>
                                <td>
                                    <span class="priority-pill bg-{{ $task->getPriorityBadgeClass() }}">
                                        {{ ucfirst($task->priority) }}
                                    </span>
                                </td>
                                <td>
                                    @if($task->comments)
                                        <button type="button"
                                                class="comments-link"
                                                data-bs-toggle="popover"
                                                data-bs-content="{{ $task->comments }}">
                                            View Comments
                                        </button>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <div class="task-actions">
                                        <a href="{{ route('admin.tasks.edit', $task) }}"
                                           class="task-action-btn edit" title="Edit">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <form action="{{ route('admin.tasks.destroy', $task) }}"
                                              method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this task?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="task-action-btn delete" title="Delete">
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
