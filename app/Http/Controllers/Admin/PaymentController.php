<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function store(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'amount'    => 'required|numeric|min:0.01',
            'paid_at'   => 'required|date',
            'method'    => 'required|string|max:100',
            'reference' => 'nullable|string|max:255',
            'notes'     => 'nullable|string',
        ]);

        $invoice->payments()->create([
            'amount'              => $validated['amount'],
            'currency'            => $invoice->currency ?? 'UGX',
            'paid_at'             => $validated['paid_at'],
            'method'              => $validated['method'],
            'reference'           => $validated['reference'] ?? null,
            'notes'               => $validated['notes'] ?? null,
            'received_by_user_id' => Auth::id(),
        ]);

        $invoice->syncStatusFromPayments();

        return redirect()->route('admin.invoices.show', $invoice)
            ->with('success', 'Payment recorded successfully.');
    }

    public function destroy(Invoice $invoice, Payment $payment)
    {
        if ($payment->invoice_id !== $invoice->id) {
            abort(404);
        }

        $payment->delete();
        $invoice->syncStatusFromPayments();

        return redirect()->route('admin.invoices.show', $invoice)
            ->with('success', 'Payment removed.');
    }
}
