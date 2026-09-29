<?php

namespace App\Http\Controllers;

use App\Mail\NewTestimonialMail;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    /**
     * Show the testimonial submission form
     */
    public function create()
    {
        return view('testimonials.create');
    }

    /**
     * Store a new testimonial submission
     */
    public function store(Request $request)
    {
        // Honeypot check for spam prevention
        if ($request->filled('website')) {
            return redirect()->route('testimonials.create')->with('success', true);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'testimonial' => 'required|string|min:10|max:1000',
            'rating' => 'required|integer|min:1|max:5',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('testimonials', 'public');
        }

        // Add IP address for security
        $validated['ip_address'] = $request->ip();
        $validated['status'] = 'pending';

        $testimonial = Testimonial::create($validated);

        // Notify admin; a mail failure must never break the submission
        try {
            Mail::to(config('mail.from.address'))->send(new NewTestimonialMail($testimonial));
        } catch (\Throwable $e) {
            Log::error('Testimonial notification email failed: ' . $e->getMessage());
        }

        return redirect()->route('testimonials.create')->with('success', true);
    }
}
