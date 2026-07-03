<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quotation;
use App\Models\Invoice;
use App\Models\Client;
use App\Models\ClientService;
use App\Models\WorkOrder;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\NumberSequenceService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\QuotationMail;

class QuotationController extends Controller
{
    public function index()
    {
        $quotations = Quotation::with(['client', 'invoice'])->latest()->paginate(10);
        return view('admin.quotations.index', compact('quotations'));
    }

    public function create()
    {
        $clients = Client::all();
        $services = ClientService::all();
        return view('admin.quotations.form', compact('clients', 'services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'date' => 'required|date',
            'valid_until' => 'required|date|after_or_equal:date',
            'status' => 'required|in:draft,sent,accepted,rejected',
            'currency' => 'nullable|string|in:UGX,USD',
            'subject' => 'nullable|string|max:255',
            'attn_name' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'tax_rate' => 'nullable|numeric|min:0|max:100',
            'items' => 'required|array|min:1',
            'items.*.service_id' => 'nullable|exists:client_services,id',
            'items.*.description' => 'nullable|string',
            'items.*.unit' => 'nullable|string|max:50',
            'items.*.save_as_service' => 'nullable|boolean',
            'items.*.quantity' => 'required|numeric|min:1',
            'items.*.rate' => 'required|numeric|min:0'
        ]);

        $currency = $validated['currency'] ?? 'UGX';

        $serviceIds = collect($validated['items'])->pluck('service_id')->filter()->values()->all();

        $servicesById = ClientService::whereIn('id', $serviceIds)
            ->get()
            ->keyBy('id');

        $subtotal = collect($validated['items'])->sum(function ($item) {
            return ((float) $item['quantity']) * ((float) $item['rate']);
        });

        $taxRate  = (float) ($validated['tax_rate'] ?? 0);
        $taxTotal = round($subtotal * ($taxRate / 100), 2);

        $sequenceService = app(NumberSequenceService::class);
        $seq = $sequenceService->next('quotation');
        $quoteNumber = $sequenceService->format('quotation', $seq);

        $quotation = Quotation::create([
            'client_id' => $validated['client_id'],
            'date' => $validated['date'],
            'valid_until' => $validated['valid_until'],
            'status' => $validated['status'],
            'currency' => $currency,
            'subject' => $validated['subject'] ?? null,
            'attn_name' => $validated['attn_name'] ?? null,
            'notes' => $validated['notes'],
            'subtotal' => $subtotal,
            'tax_rate' => $taxRate,
            'tax_total' => $taxTotal,
            'total_amount' => $subtotal + $taxTotal,
            'prepared_by_user_id' => Auth::id(),
            'quote_number' => $quoteNumber,
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

            if (empty($item['service_id']) && !empty($item['save_as_service'])) {
                $service = ClientService::firstOrCreate(
                    ['name' => $description],
                    [
                        'description' => null,
                        'rate' => $item['rate'],
                        'unit' => $item['unit'] ?? null,
                    ]
                );
                $item['service_id'] = $service->id;
                $servicesById->put($service->id, $service);
            }

            $lineTotal = ((float) $item['quantity']) * ((float) $item['rate']);

            $quotation->items()->create([
                'service_id' => $item['service_id'] ?? null,
                'position' => $index + 1,
                'description' => $description,
                'quantity' => $item['quantity'],
                'unit' => $item['unit'] ?? ($service?->unit),
                'rate' => $item['rate'],
                'line_total' => $lineTotal,
            ]);
        }

        if ($quotation->status === 'accepted') {
            $this->acceptQuotation($quotation);
        }

        return redirect()->route('admin.quotations.index')
            ->with('success', 'Quotation created successfully.');
    }

    public function edit(Quotation $quotation)
    {
        $clients = Client::all();
        $services = ClientService::all();
        return view('admin.quotations.form', compact('quotation', 'clients', 'services'));
    }

    public function update(Request $request, Quotation $quotation)
    {
        if ($quotation->status === 'accepted') {
            return redirect()->back()->with('error', 'Accepted quotations are locked and cannot be edited.');
        }

        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'date' => 'required|date',
            'valid_until' => 'required|date|after_or_equal:date',
            'status' => 'required|in:draft,sent,accepted,rejected',
            'currency' => 'nullable|string|in:UGX,USD',
            'subject' => 'nullable|string|max:255',
            'attn_name' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'tax_rate' => 'nullable|numeric|min:0|max:100',
            'items' => 'required|array|min:1',
            'items.*.service_id' => 'nullable|exists:client_services,id',
            'items.*.description' => 'nullable|string',
            'items.*.unit' => 'nullable|string|max:50',
            'items.*.save_as_service' => 'nullable|boolean',
            'items.*.quantity' => 'required|numeric|min:1',
            'items.*.rate' => 'required|numeric|min:0'
        ]);

        $currency = $validated['currency'] ?? ($quotation->currency ?? 'UGX');

        $serviceIds = collect($validated['items'])->pluck('service_id')->filter()->values()->all();

        $servicesById = ClientService::whereIn('id', $serviceIds)
            ->get()
            ->keyBy('id');

        $subtotal = collect($validated['items'])->sum(function ($item) {
            return ((float) $item['quantity']) * ((float) $item['rate']);
        });

        $taxRate  = (float) ($validated['tax_rate'] ?? 0);
        $taxTotal = round($subtotal * ($taxRate / 100), 2);

        $quotation->update([
            'client_id' => $validated['client_id'],
            'date' => $validated['date'],
            'valid_until' => $validated['valid_until'],
            'status' => $validated['status'],
            'currency' => $currency,
            'subject' => $validated['subject'] ?? null,
            'attn_name' => $validated['attn_name'] ?? null,
            'notes' => $validated['notes'],
            'subtotal' => $subtotal,
            'tax_rate' => $taxRate,
            'tax_total' => $taxTotal,
            'total_amount' => $subtotal + $taxTotal,
        ]);

        // Delete existing items and create new ones
        $quotation->items()->delete();
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

            $quotation->items()->create([
                'service_id' => $item['service_id'] ?? null,
                'position' => $index + 1,
                'description' => $description,
                'quantity' => $item['quantity'],
                'unit' => $item['unit'] ?? ($service?->unit),
                'rate' => $item['rate'],
                'line_total' => $lineTotal,
            ]);
        }

        if ($quotation->status === 'accepted') {
            $this->acceptQuotation($quotation);
        }

        return redirect()->route('admin.quotations.index')
            ->with('success', 'Quotation updated successfully.');
    }

    public function sendEmail(Request $request, Quotation $quotation)
    {
        $quotation->load(['client', 'items']);

        if (empty($quotation->client->email)) {
            return redirect()->back()
                ->with('error', 'This client has no email address on record. Please update the client profile first.');
        }

        $cc  = $this->parseEmails($request->input('cc', ''));
        $bcc = $this->parseEmails($request->input('bcc', ''));

        try {
            $mailer = Mail::to($quotation->client->email, $quotation->client->name);
            if ($cc)  $mailer = $mailer->cc($cc);
            if ($bcc) $mailer = $mailer->bcc($bcc);
            $mailer->send(new QuotationMail($quotation));

            if ($quotation->status === 'draft') {
                $quotation->update(['status' => 'sent']);
            }

            return redirect()->back()
                ->with('success', 'Quotation ' . $quotation->quote_number . ' sent to ' . $quotation->client->email . ($cc ? ' (+' . count($cc) . ' CC)' : '') . '.');
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

    public function destroy(Quotation $quotation)
    {
        $quotation->items()->delete();
        $quotation->delete();
        return redirect()->route('admin.quotations.index')
            ->with('success', 'Quotation deleted successfully.');
    }

    public function print(Quotation $quotation)
    {
        $quotation->load(['client', 'items']);
        return view('admin.quotations.print', compact('quotation'));
    }

    public function pdf(Quotation $quotation)
    {
        $quotation->load(['client', 'items']);
        $pdf = Pdf::loadView('admin.quotations.print', compact('quotation'));
        $filename = 'quotation-' . str_replace('/', '-', $quotation->quote_number) . '.pdf';
        return $pdf->download($filename);
    }

    public function items(Quotation $quotation)
    {
        return response()->json($quotation->items);
    }

    public function convertToInvoice(Quotation $quotation)
    {
        if ($quotation->invoice) {
            return redirect()->route('admin.invoices.show', $quotation->invoice)
                ->with('info', 'An invoice already exists for this quotation.');
        }

        if ($quotation->status !== 'accepted' || !$quotation->accepted_at) {
            $quotation->status = 'accepted';
            $quotation->save();
            $this->acceptQuotation($quotation);
            $quotation->refresh();
        }

        $sequenceService = app(NumberSequenceService::class);
        $seq = $sequenceService->next('invoice');
        $invoiceNumber = $sequenceService->format('invoice', $seq);

        $invoice = Invoice::create([
            'invoice_number'      => $invoiceNumber,
            'client_id'           => $quotation->client_id,
            'quotation_id'        => $quotation->id,
            'work_order_id'       => $quotation->workOrder?->id,
            'date'                => now()->toDateString(),
            'due_date'            => now()->addDays(30)->toDateString(),
            'status'              => 'issued',
            'currency'            => $quotation->currency ?? 'UGX',
            'tax_rate'            => $quotation->tax_rate ?? 0,
            'tax_amount'          => $quotation->tax_total ?? 0,
            'subtotal'            => $quotation->subtotal,
            'total_amount'        => $quotation->total_amount,
            'notes'               => $quotation->notes,
            'payment_details'     => null,
            'issued_at'           => now(),
            'issued_by_user_id'   => Auth::id(),
        ]);

        foreach ($quotation->items as $item) {
            $invoice->items()->create([
                'service_id'  => $item->service_id,
                'position'    => $item->position,
                'description' => $item->description,
                'quantity'    => $item->quantity,
                'unit'        => $item->unit,
                'rate'        => $item->rate,
                'line_total'  => $item->line_total,
            ]);
        }

        return redirect()->route('admin.invoices.show', $invoice)
            ->with('success', 'Invoice ' . $invoiceNumber . ' created from quotation successfully.');
    }

    private function acceptQuotation(Quotation $quotation): void
    {
        if ($quotation->accepted_at) {
            return;
        }

        $quotation->accepted_at = now();
        $quotation->accepted_by_user_id = Auth::id();
        $quotation->save();

        if ($quotation->workOrder) {
            return;
        }

        $sequenceService = app(NumberSequenceService::class);
        $seq = $sequenceService->next('work_order');
        $woNumber = $sequenceService->format('work_order', $seq);

        WorkOrder::create([
            'work_order_number' => $woNumber,
            'client_id' => $quotation->client_id,
            'quotation_id' => $quotation->id,
            'title' => $quotation->subject,
            'status' => 'pending',
            'created_by_user_id' => Auth::id(),
        ]);
    }
}
