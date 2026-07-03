<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientLogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientLogoController extends Controller
{
    /**
     * Display a listing of client logos
     */
    public function index()
    {
        $logos = ClientLogo::ordered()->get();
        return view('admin.client-logos.index', compact('logos'));
    }

    /**
     * Show the form for creating a new logo
     */
    public function create()
    {
        return view('admin.client-logos.create');
    }

    /**
     * Store a newly created logo
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'url' => 'nullable|url|max:255',
            'is_active' => 'boolean',
            'order' => 'nullable|integer'
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('client-logos', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        ClientLogo::create($validated);

        return redirect()->route('admin.client-logos.index')
            ->with('success', 'Client logo added successfully.');
    }

    /**
     * Show the form for editing the specified logo
     */
    public function edit(ClientLogo $clientLogo)
    {
        return view('admin.client-logos.edit', compact('clientLogo'));
    }

    /**
     * Update the specified logo
     */
    public function update(Request $request, ClientLogo $clientLogo)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'url' => 'nullable|url|max:255',
            'is_active' => 'boolean',
            'order' => 'nullable|integer'
        ]);

        if ($request->hasFile('logo')) {
            // Delete old logo
            if ($clientLogo->logo) {
                Storage::disk('public')->delete($clientLogo->logo);
            }
            $validated['logo'] = $request->file('logo')->store('client-logos', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? $clientLogo->order;

        $clientLogo->update($validated);

        return redirect()->route('admin.client-logos.index')
            ->with('success', 'Client logo updated successfully.');
    }

    /**
     * Remove the specified logo
     */
    public function destroy(ClientLogo $clientLogo)
    {
        // Delete logo file
        if ($clientLogo->logo) {
            Storage::disk('public')->delete($clientLogo->logo);
        }

        $clientLogo->delete();

        return redirect()->route('admin.client-logos.index')
            ->with('success', 'Client logo deleted successfully.');
    }
}
