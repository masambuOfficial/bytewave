@extends('layouts.admin')

@section('title', isset($task) ? 'Edit Task' : 'Create Task')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        {{ isset($task) ? 'Edit Task' : 'Create New Task' }}
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ isset($task) ? route('admin.tasks.update', $task) : route('admin.tasks.store') }}" 
                          method="POST">
                        @csrf
                        @if(isset($task))
                            @method('PUT')
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <!-- Task ID -->
                                <div class="mb-3">
                                    <label for="task_id" class="form-label">Task ID</label>
                                    <input type="text" 
                                           class="form-control @error('task_id') is-invalid @enderror" 
                                           id="task_id" 
                                           name="task_id" 
                                           value="{{ old('task_id', $task->task_id ?? '') }}"
                                           placeholder="e.g., 001"
                                           required>
                                    @error('task_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Description -->
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                              id="description" 
                                              name="description" 
                                              rows="3"
                                              required>{{ old('description', $task->description ?? '') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Assignee -->
                                <div class="mb-3">
                                    <label for="assignee" class="form-label">Assignee</label>
                                    <input type="text" 
                                           class="form-control @error('assignee') is-invalid @enderror" 
                                           id="assignee" 
                                           name="assignee" 
                                           value="{{ old('assignee', $task->assignee ?? '') }}"
                                           required>
                                    @error('assignee')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Status -->
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" 
                                            id="status" 
                                            name="status" 
                                            required>
                                        @foreach(['untrackable' => 'Untrackable', 
                                                'submitted' => 'Submitted - Awaiting Approval', 
                                                'in-progress' => 'In Progress',
                                                'completed' => 'Completed'] as $value => $label)
                                            <option value="{{ $value }}" 
                                                {{ old('status', $task->status ?? '') == $value ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <!-- Start Date -->
                                <div class="mb-3">
                                    <label for="start_date" class="form-label">Start Date</label>
                                    <input type="date" 
                                           class="form-control @error('start_date') is-invalid @enderror" 
                                           id="start_date" 
                                           name="start_date" 
                                           value="{{ old('start_date', isset($task->start_date) ? $task->start_date->format('Y-m-d') : '') }}">
                                    @error('start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Due Date -->
                                <div class="mb-3">
                                    <label for="due_date" class="form-label">Due Date</label>
                                    <input type="date" 
                                           class="form-control @error('due_date') is-invalid @enderror" 
                                           id="due_date" 
                                           name="due_date" 
                                           value="{{ old('due_date', isset($task->due_date) ? $task->due_date->format('Y-m-d') : '') }}">
                                    @error('due_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Priority -->
                                <div class="mb-3">
                                    <label for="priority" class="form-label">Priority</label>
                                    <select class="form-select @error('priority') is-invalid @enderror" 
                                            id="priority" 
                                            name="priority" 
                                            required>
                                        @foreach(['low' => 'Low', 'medium' => 'Medium', 'high' => 'High'] as $value => $label)
                                            <option value="{{ $value }}" 
                                                {{ old('priority', $task->priority ?? '') == $value ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('priority')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Comments -->
                                <div class="mb-3">
                                    <label for="comments" class="form-label">Comments/Updates</label>
                                    <textarea class="form-control @error('comments') is-invalid @enderror" 
                                              id="comments" 
                                              name="comments" 
                                              rows="4">{{ old('comments', $task->comments ?? '') }}</textarea>
                                    @error('comments')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.tasks.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to List
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> {{ isset($task) ? 'Update' : 'Create' }} Task
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-generate Task ID if creating new task
    if (!document.getElementById('task_id').value) {
        fetch('{{ route('admin.tasks.index') }}')
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const tasks = doc.querySelectorAll('td:first-child');
                let maxId = 0;
                
                tasks.forEach(task => {
                    const id = parseInt(task.textContent.replace(/\D/g, ''));
                    if (id > maxId) maxId = id;
                });
                
                const newId = String(maxId + 1).padStart(3, '0');
                document.getElementById('task_id').value = newId;
            });
    }

    // Date validation
    const startDate = document.getElementById('start_date');
    const dueDate = document.getElementById('due_date');

    dueDate.addEventListener('change', function() {
        if (startDate.value && this.value < startDate.value) {
            alert('Due date cannot be earlier than start date');
            this.value = startDate.value;
        }
    });

    startDate.addEventListener('change', function() {
        if (dueDate.value && dueDate.value < this.value) {
            dueDate.value = this.value;
        }
    });
});
</script>
@endpush
