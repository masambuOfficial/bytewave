<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Client;
use App\Models\ClientService;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\NumberSequenceService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;
use App\Mail\ReceiptMail;

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
        $quotations = Quotation::whereIn('status', ['sent', 'accepted'])->with('client')->get();
        return view('admin.invoices.form', compact('clients', 'services', 'quotations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'quotation_id' => 'nullable|exists:quotations,id',
            'date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:date',
            'status' => 'required|in:draft,issued,partially_paid,paid,overdue,void',
            'currency' => 'nullable|string|in:UGX,USD',
            'tax_rate' => 'nullable|numeric|min:0|max:100',
            'notes' => 'nullable|string',
            'payment_details' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.service_id' => 'nullable|exists:client_services,id',
            'items.*.description' => 'nullable|string',
            'items.*.unit' => 'nullable|string|max:50',
            'items.*.quantity' => 'required|numeric|min:1',
            'items.*.rate' => 'required|numeric|min:0'
        ]);

        $currency = $validated['currency'] ?? 'UGX';

        $serviceIds = collect($validated['items'])->pluck('service_id')->filter()->values()->all();

        $servicesById = ClientService::whereIn('id', $serviceIds)
            ->get()
            ->keyBy('id');

        // Calculate subtotal and tax
        $subtotal = collect($validated['items'])->sum(function ($item) {
            return $item['quantity'] * $item['rate'];
        });
        
        $tax_rate = $validated['tax_rate'] ?? 0;
        $tax_amount = $subtotal * ($tax_rate / 100);
        $total_amount = $subtotal + $tax_amount;

        $sequenceService = app(NumberSequenceService::class);
        $seq = $sequenceService->next('invoice');
        $invoiceNumber = $sequenceService->format('invoice', $seq);

        $quotation = null;
        if (!empty($validated['quotation_id'])) {
            $quotation = Quotation::with('workOrder')->find($validated['quotation_id']);
        }

        $issuedAt = null;
        $issuedBy = null;
        if ($validated['status'] === 'issued') {
            $issuedAt = now();
            $issuedBy = Auth::id();
        }

        $invoice = Invoice::create([
            'client_id' => $validated['client_id'],
            'quotation_id' => $validated['quotation_id'],
            'work_order_id' => $quotation?->workOrder?->id,
            'date' => $validated['date'],
            'due_date' => $validated['due_date'],
            'status' => $validated['status'],
            'currency' => $currency,
            'tax_rate' => $tax_rate,
            'tax_amount' => $tax_amount,
            'subtotal' => $subtotal,
            'total_amount' => $total_amount,
            'notes' => $validated['notes'],
            'payment_details' => $validated['payment_details'],
            'issued_at' => $issuedAt,
            'issued_by_user_id' => $issuedBy,
            'invoice_number' => $invoiceNumber,
        ]);

        foreach ($validated['items'] as $index => $item) {
            $service = null;
            if (!empty($item['service_id'])) {
                $service = $servicesById->get($item['service_id']);
            }

            $description = $item['description'] ?? null;
            if (!$description && $service) {
                $description = $service->name;
            }

            if (!$description) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Each item must have either a service selected or a description.');
            }

            $lineTotal = ((float) $item['quantity']) * ((float) $item['rate']);

            $invoice->items()->create([
                'service_id' => $item['service_id'] ?? null,
                'position' => $index + 1,
                'description' => $description,
                'quantity' => $item['quantity'],
                'unit' => $item['unit'] ?? ($service?->unit),
                'rate' => $item['rate'],
                'line_total' => $lineTotal,
            ]);
        }

        return redirect()->route('admin.invoices.index')
            ->with('success', 'Invoice created successfully.');
    }

    public function edit(Invoice $invoice)
    {
        $clients = Client::all();
        $services = ClientService::all();
        $quotations = Quotation::whereIn('status', ['sent', 'accepted'])->with('client')->get();
        return view('admin.invoices.form', compact('invoice', 'clients', 'services', 'quotations'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'quotation_id' => 'nullable|exists:quotations,id',
            'date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:date',
            'status' => 'required|in:draft,issued,partially_paid,paid,overdue,void',
            'currency' => 'nullable|string|in:UGX,USD',
            'tax_rate' => 'nullable|numeric|min:0|max:100',
            'notes' => 'nullable|string',
            'payment_details' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.service_id' => 'nullable|exists:client_services,id',
            'items.*.description' => 'nullable|string',
            'items.*.unit' => 'nullable|string|max:50',
            'items.*.quantity' => 'required|numeric|min:1',
            'items.*.rate' => 'required|numeric|min:0'
        ]);

        $currency = $validated['currency'] ?? ($invoice->currency ?? 'UGX');

        $serviceIds = collect($validated['items'])->pluck('service_id')->filter()->values()->all();

        $servicesById = ClientService::whereIn('id', $serviceIds)
            ->get()
            ->keyBy('id');

        // Calculate subtotal and tax
        $subtotal = collect($validated['items'])->sum(function ($item) {
            return $item['quantity'] * $item['rate'];
        });
        
        $tax_rate = $validated['tax_rate'] ?? 0;
        $tax_amount = $subtotal * ($tax_rate / 100);
        $total_amount = $subtotal + $tax_amount;

        $quotation = null;
        if (!empty($validated['quotation_id'])) {
            $quotation = Quotation::with('workOrder')->find($validated['quotation_id']);
        }

        $issuedAt = $invoice->issued_at;
        $issuedBy = $invoice->issued_by_user_id;
        if ($validated['status'] === 'issued' && !$invoice->issued_at) {
            $issuedAt = now();
            $issuedBy = Auth::id();
        }

        $invoice->update([
            'client_id' => $validated['client_id'],
            'quotation_id' => $validated['quotation_id'],
            'work_order_id' => $quotation?->workOrder?->id,
            'date' => $validated['date'],
            'due_date' => $validated['due_date'],
            'status' => $validated['status'],
            'currency' => $currency,
            'tax_rate' => $tax_rate,
            'tax_amount' => $tax_amount,
            'subtotal' => $subtotal,
            'total_amount' => $total_amount,
            'notes' => $validated['notes'],
            'payment_details' => $validated['payment_details'],
            'issued_at' => $issuedAt,
            'issued_by_user_id' => $issuedBy,
        ]);

        // Delete existing items and create new ones
        $invoice->items()->delete();
        foreach ($validated['items'] as $index => $item) {
            $service = null;
            if (!empty($item['service_id'])) {
                $service = $servicesById->get($item['service_id']);
            }

            $description = $item['description'] ?? null;
            if (!$description && $service) {
                $description = $service->name;
            }

            if (!$description) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Each item must have either a service selected or a description.');
            }

            $lineTotal = ((float) $item['quantity']) * ((float) $item['rate']);

            $invoice->items()->create([
                'service_id' => $item['service_id'] ?? null,
                'position' => $index + 1,
                'description' => $description,
                'quantity' => $item['quantity'],
                'unit' => $item['unit'] ?? ($service?->unit),
                'rate' => $item['rate'],
                'line_total' => $lineTotal,
            ]);
        }

        return redirect()->route('admin.invoices.index')
            ->with('success', 'Invoice updated successfully.');
    }

    public function show(Invoice $invoice)
    {
        $invoice->load(['client', 'items', 'payments', 'quotation']);
        return view('admin.invoices.show', compact('invoice'));
    }

    public function sendEmail(Request $request, Invoice $invoice)
    {
        $invoice->load(['client', 'items', 'quotation']);

        if (empty($invoice->client->email)) {
            return redirect()->back()
                ->with('error', 'This client has no email address on record. Please update the client profile first.');
        }

        $cc  = $this->parseEmails($request->input('cc', ''));
        $bcc = $this->parseEmails($request->input('bcc', ''));

        try {
            $mailer = Mail::to($invoice->client->email, $invoice->client->name);
            if ($cc)  $mailer = $mailer->cc($cc);
            if ($bcc) $mailer = $mailer->bcc($bcc);
            $mailer->send(new InvoiceMail($invoice));

            if ($invoice->status === 'draft') {
                $invoice->update([
                    'status' => 'issued',
                    'issued_at' => now(),
                    'issued_by_user_id' => auth()->id(),
                ]);
            }

            return redirect()->back()
                ->with('success', 'Invoice ' . $invoice->invoice_number . ' sent to ' . $invoice->client->email . ($cc ? ' (+' . count($cc) . ' CC)' : '') . '.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to send email: ' . $e->getMessage());
        }
    }

    public function sendReceipt(Request $request, Invoice $invoice)
    {
        $invoice->load(['client', 'items', 'payments', 'quotation']);

        if (empty($invoice->client->email)) {
            return redirect()->back()
                ->with('error', 'This client has no email address on record. Please update the client profile first.');
        }

        if ($invoice->payments->isEmpty()) {
            return redirect()->back()
                ->with('error', 'No payments recorded for this invoice. Record a payment first before sending a receipt.');
        }

        $cc  = $this->parseEmails($request->input('cc', ''));
        $bcc = $this->parseEmails($request->input('bcc', ''));

        try {
            $mailer = Mail::to($invoice->client->email, $invoice->client->name);
            if ($cc)  $mailer = $mailer->cc($cc);
            if ($bcc) $mailer = $mailer->bcc($bcc);
            $mailer->send(new ReceiptMail($invoice));

            return redirect()->back()
                ->with('success', 'Receipt for invoice ' . $invoice->invoice_number . ' sent to ' . $invoice->client->email . ($cc ? ' (+' . count($cc) . ' CC)' : '') . '.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to send email: ' . $e->getMessage());
        }
    }

    private function parseEmails(?string $input): array
    {
        if (!$input) return [];
        return array_values(array_filter(
            array_map('trim', explode(',', $input)),
            fn($e) => filter_var($e, FILTER_VALIDATE_EMAIL)
        ));
    }

    public function destroy(Invoice $invoice)
    {
        if ($invoice->payments()->exists()) {
            return redirect()->back()
                ->with('error', 'Cannot delete an invoice that has recorded payments.');
        }
        $invoice->items()->delete();
        $invoice->delete();
        return redirect()->route('admin.invoices.index')
            ->with('success', 'Invoice deleted successfully.');
    }

    public function print(Invoice $invoice)
    {
        $invoice->load(['client', 'items', 'quotation']);
        return view('admin.invoices.print', compact('invoice'));
    }

    public function pdf(Invoice $invoice)
    {
        $invoice->load(['client', 'items', 'quotation']);
        $pdf = Pdf::loadView('admin.invoices.print', compact('invoice'));
        $filename = 'invoice-' . str_replace('/', '-', $invoice->invoice_number) . '.pdf';
        return $pdf->download($filename);
    }

    public function receipt(Invoice $invoice)
    {
        $invoice->load(['client', 'items', 'payments']);
        return view('admin.invoices.receipt', compact('invoice'));
    }

    public function receiptPdf(Invoice $invoice)
    {
        $invoice->load(['client', 'items', 'payments']);
        $pdf = Pdf::loadView('admin.invoices.receipt', compact('invoice'));
        $filename = 'receipt-' . str_replace('/', '-', $invoice->invoice_number) . '.pdf';
        return $pdf->download($filename);
    }
}
