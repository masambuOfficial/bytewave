<?php

namespace App\Mail;

use App\Models\Quotation;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QuotationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Quotation $quotation) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Quotation ' . $this->quotation->quote_number . ' – ' . config('company.name'),
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.quotation',
        );
    }

    public function attachments(): array
    {
        $quotation = $this->quotation;
        $pdf = Pdf::loadView('admin.quotations.print', compact('quotation'));
        $filename = 'quotation-' . str_replace('/', '-', $quotation->quote_number) . '.pdf';

        return [
            Attachment::fromData(fn () => $pdf->output(), $filename)
                ->withMime('application/pdf'),
        ];
    }
}
