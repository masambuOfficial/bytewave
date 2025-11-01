<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    /**
     * Subscribe to newsletter
     */
    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:newsletter_subscribers,email',
            'name' => 'nullable|string|max:255'
        ]);

        $subscriber = NewsletterSubscriber::create($validated);

        // In production, send verification email here
        // For now, auto-verify
        $subscriber->verified_at = now();
        $subscriber->save();

        return back()->with('success', 'Successfully subscribed to our newsletter!');
    }

    /**
     * Unsubscribe from newsletter
     */
    public function unsubscribe($token)
    {
        $subscriber = NewsletterSubscriber::where('verification_token', $token)->firstOrFail();
        $subscriber->is_active = false;
        $subscriber->save();

        return view('newsletter.unsubscribed');
    }
}
