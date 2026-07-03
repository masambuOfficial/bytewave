<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Validator;
use App\Models\Portfolio;
use App\Models\Blog;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $latestPortfolios = Portfolio::latest()->take(6)->get();
        
        // Get latest published articles for the homepage "Latest News & Articles" grid
        $recentArticles = Blog::published()
            ->with(['author', 'category'])
            ->latest()
            ->take(3)
            ->get();

        // Get approved testimonials
        $testimonials = Testimonial::approved()
            ->ordered()
            ->take(5)
            ->get();

        return view('home', compact('latestPortfolios', 'recentArticles', 'testimonials'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function sendContact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Send email
            Mail::to(config('mail.from.address'))->send(new ContactFormMail($request->all()));

            // Optional: Store in database
            // Contact::create($request->all());

            return redirect()->back()
                ->with('success', 'Thank you for your message! We will get back to you soon.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Sorry, there was an error sending your message. Please try again later.')
                ->withInput();
        }
    }
}
