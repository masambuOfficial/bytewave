<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Client;
use App\Models\ClientService;
use App\Models\Quotation;
use Illuminate\Http\Request;
use PDF;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('client')->latest()->paginate(10);
        return view('admin.invoices.index', compact('invoices'));
    }

    public function create()
    {
        $clients = Client::all();
        $services = ClientService::all();
        $quotations = Quotation::where('status', 'accepted')->get();
        return view('admin.invoices.form', compact('clients', 'services', 'quotations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'quotation_id' => 'nullable|exists:quotations,id',
            'date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:date',
            'status' => 'required|in:draft,sent,paid,overdue,cancelled',
            'tax_rate' => 'nullable|numeric|min:0|max:100',
            'notes' => 'nullable|string',
            'payment_details' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.service_id' => 'required|exists:client_services,id',
            'items.*.quantity' => 'required|numeric|min:1',
            'items.*.rate' => 'required|numeric|min:0'
        ]);

        // Calculate subtotal and tax
        $subtotal = collect($validated['items'])->sum(function ($item) {
            return $item['quantity'] * $item['rate'];
        });
        
        $tax_rate = $validated['tax_rate'] ?? 0;
        $tax_amount = $subtotal * ($tax_rate / 100);
        $total_amount = $subtotal + $tax_amount;

        $invoice = Invoice::create([
            'client_id' => $validated['client_id'],
            'quotation_id' => $validated['quotation_id'],
            'date' => $validated['date'],
            'due_date' => $validated['due_date'],
            'status' => $validated['status'],
            'tax_rate' => $tax_rate,
            'tax_amount' => $tax_amount,
            'subtotal' => $subtotal,
            'total_amount' => $total_amount,
            'notes' => $validated['notes'],
            'payment_details' => $validated['payment_details'],
            'invoice_number' => 'INV-' . date('Ymd') . '-' . str_pad(Invoice::count() + 1, 4, '0', STR_PAD_LEFT)
        ]);

        foreach ($validated['items'] as $item) {
            $invoice->items()->create($item);
        }

        return redirect()->route('admin.invoices.index')
            ->with('success', 'Invoice created successfully.');
    }

    public function edit(Invoice $invoice)
    {
        $clients = Client::all();
        $services = ClientService::all();
        $quotations = Quotation::where('status', 'accepted')->get();
        return view('admin.invoices.form', compact('invoice', 'clients', 'services', 'quotations'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'quotation_id' => 'nullable|exists:quotations,id',
            'date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:date',
            'status' => 'required|in:draft,sent,paid,overdue,cancelled',
            'tax_rate' => 'nullable|numeric|min:0|max:100',
            'notes' => 'nullable|string',
            'payment_details' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.service_id' => 'required|exists:client_services,id',
            'items.*.quantity' => 'required|numeric|min:1',
            'items.*.rate' => 'required|numeric|min:0'
        ]);

        // Calculate subtotal and tax
        $subtotal = collect($validated['items'])->sum(function ($item) {
            return $item['quantity'] * $item['rate'];
        });
        
        $tax_rate = $validated['tax_rate'] ?? 0;
        $tax_amount = $subtotal * ($tax_rate / 100);
        $total_amount = $subtotal + $tax_amount;

        $invoice->update([
            'client_id' => $validated['client_id'],
            'quotation_id' => $validated['quotation_id'],
            'date' => $validated['date'],
            'due_date' => $validated['due_date'],
            'status' => $validated['status'],
            'tax_rate' => $tax_rate,
            'tax_amount' => $tax_amount,
            'subtotal' => $subtotal,
            'total_amount' => $total_amount,
            'notes' => $validated['notes'],
            'payment_details' => $validated['payment_details']
        ]);

        // Delete existing items and create new ones
        $invoice->items()->delete();
        foreach ($validated['items'] as $item) {
            $invoice->items()->create($item);
        }

        return redirect()->route('admin.invoices.index')
            ->with('success', 'Invoice updated successfully.');
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->items()->delete();
        $invoice->delete();
        return redirect()->route('admin.invoices.index')
            ->with('success', 'Invoice deleted successfully.');
    }

    public function print(Invoice $invoice)
    {
        return view('admin.invoices.print', compact('invoice'));
    }

    public function pdf(Invoice $invoice)
    {
        $pdf = PDF::loadView('admin.invoices.print', compact('invoice'));
        return $pdf->download('invoice-' . $invoice->invoice_number . '.pdf');
    }
}
