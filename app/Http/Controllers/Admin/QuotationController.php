<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quotation;
use App\Models\Client;
use App\Models\ClientService;
use Illuminate\Http\Request;
use PDF;

class QuotationController extends Controller
{
    public function index()
    {
        $quotations = Quotation::with('client')->latest()->paginate(10);
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
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.service_id' => 'required|exists:client_services,id',
            'items.*.quantity' => 'required|numeric|min:1',
            'items.*.rate' => 'required|numeric|min:0'
        ]);

        $quotation = Quotation::create([
            'client_id' => $validated['client_id'],
            'date' => $validated['date'],
            'valid_until' => $validated['valid_until'],
            'status' => $validated['status'],
            'notes' => $validated['notes'],
            'quote_number' => 'Q-' . date('Ymd') . '-' . str_pad(Quotation::count() + 1, 4, '0', STR_PAD_LEFT)
        ]);

        foreach ($validated['items'] as $item) {
            $quotation->items()->create($item);
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
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'date' => 'required|date',
            'valid_until' => 'required|date|after_or_equal:date',
            'status' => 'required|in:draft,sent,accepted,rejected',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.service_id' => 'required|exists:client_services,id',
            'items.*.quantity' => 'required|numeric|min:1',
            'items.*.rate' => 'required|numeric|min:0'
        ]);

        $quotation->update([
            'client_id' => $validated['client_id'],
            'date' => $validated['date'],
            'valid_until' => $validated['valid_until'],
            'status' => $validated['status'],
            'notes' => $validated['notes']
        ]);

        // Delete existing items and create new ones
        $quotation->items()->delete();
        foreach ($validated['items'] as $item) {
            $quotation->items()->create($item);
        }

        return redirect()->route('admin.quotations.index')
            ->with('success', 'Quotation updated successfully.');
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
        return view('admin.quotations.print', compact('quotation'));
    }

    public function pdf(Quotation $quotation)
    {
        $pdf = PDF::loadView('admin.quotations.print', compact('quotation'));
        return $pdf->download('quotation-' . $quotation->quote_number . '.pdf');
    }

    public function items(Quotation $quotation)
    {
        return response()->json($quotation->items);
    }
}
