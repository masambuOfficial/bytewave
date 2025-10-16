<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'task_id',
        'description',
        'assignee',
        'status',
        'start_date',
        'due_date',
        'priority',
        'comments'
    ];

    protected $casts = [
        'start_date' => 'date',
        'due_date' => 'date'
    ];

    public function getStatusColorClass()
    {
        return match($this->status) {
            'untrackable' => 'danger',
            'submitted' => 'warning',
            'completed' => 'success',
            default => 'info'
        };
    }

    public function getPriorityBadgeClass()
    {
        return match($this->priority) {
            'high' => 'danger',
            'medium' => 'warning',
            'low' => 'success'
        };
    }
}
