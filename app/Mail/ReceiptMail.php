<?php

namespace App\Mail;

use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReceiptMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Invoice $invoice) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Payment Receipt – Invoice ' . $this->invoice->invoice_number . ' – ' . config('company.name'),
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.receipt',
        );
    }

    public function attachments(): array
    {
        $invoice = $this->invoice;
        $pdf = Pdf::loadView('admin.invoices.receipt', compact('invoice'));
        $filename = 'receipt-' . str_replace('/', '-', $invoice->invoice_number) . '.pdf';

        return [
            Attachment::fromData(fn () => $pdf->output(), $filename)
                ->withMime('application/pdf'),
        ];
    }
}
