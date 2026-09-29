<?php

namespace App\Mail;

use App\Models\Testimonial;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewTestimonialMail extends Mailable
{
    use Queueable, SerializesModels;

    public $testimonial;

    public function __construct(Testimonial $testimonial)
    {
        $this->testimonial = $testimonial;
    }

    public function build()
    {
        return $this->markdown('emails.new-testimonial')
                    ->subject('New testimonial awaiting approval');
    }
}
