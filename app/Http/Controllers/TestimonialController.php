<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
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
            return redirect()->back()->with('success', 'Thank you for your submission!');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
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

        Testimonial::create($validated);

        return redirect()->back()->with('success', 'Thank you for your testimonial! It will be reviewed by our team shortly.');
    }
}
