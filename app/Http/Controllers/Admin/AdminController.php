<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Invoice;
use App\Models\Quotation;
use App\Models\ClientService;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'tasks' => [
                'total' => Task::count(),
                'pending' => Task::where('status', 'submitted')->count(),
                'in_progress' => Task::where('status', 'in-progress')->count(),
                'completed' => Task::where('status', 'completed')->count(),
            ],
            'invoices' => [
                'total' => Invoice::count(),
                'paid' => Invoice::where('status', 'paid')->count(),
                'pending' => Invoice::where('status', 'pending')->count(),
                'overdue' => Invoice::where('status', 'overdue')->count(),
            ],
            'quotations' => [
                'total' => Quotation::count(),
                'pending' => Quotation::where('status', 'pending')->count(),
                'accepted' => Quotation::where('status', 'accepted')->count(),
                'rejected' => Quotation::where('status', 'rejected')->count(),
            ],
            'services' => [
                'total' => ClientService::count(),
                'active' => ClientService::where('status', 'active')->count(),
            ]
        ];

        $recentTasks = Task::orderBy('created_at', 'desc')->take(5)->get();
        $recentInvoices = Invoice::orderBy('created_at', 'desc')->take(5)->get();
        $recentQuotations = Quotation::orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentTasks', 'recentInvoices', 'recentQuotations'));
    }
}
