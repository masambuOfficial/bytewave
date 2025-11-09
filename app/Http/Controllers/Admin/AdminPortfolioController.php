<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // <-- Import the Log facade
use Illuminate\Support\Facades\Storage;

class AdminPortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.portfolios.index', compact('portfolios'));
    }

    public function create()
    {
        $categories = Portfolio::distinct()->pluck('category')->filter();
        return view('admin.portfolios.form', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'work_done' => 'nullable|string',
            'client' => 'nullable|string|max:255',
            'completion_date' => 'nullable|date',
            'category' => 'nullable|string|max:255',
            'technologies' => 'nullable|array',
            'technologies.*' => 'string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'project_url' => 'nullable|url|max:255'
        ]);

        if ($request->hasFile('image_url')) {
            $file = $request->file('image_url');
            $extension = $file->getClientOriginalExtension();
            $slug = \Illuminate\Support\Str::slug($validated['title']);
            $filename = $slug . '.' . $extension;
            
            // Store with descriptive filename
            $path = $file->storeAs('portfolios', $filename, 'public');
            $validated['image_url'] = $path;
        }

        if (isset($validated['technologies'])) {
            $validated['technologies'] = array_filter($validated['technologies']);
        }

        Portfolio::create($validated);

        return redirect()->route('admin.portfolios.index')
            ->with('success', 'Portfolio item created successfully');
    }

    public function edit(Portfolio $portfolio)
    {
        $categories = Portfolio::distinct()->pluck('category')->filter();
        return view('admin.portfolios.form', compact('portfolio', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     * THIS METHOD HAS BEEN MODIFIED WITH DETAILED LOGGING.
     */
    public function update(Request $request, Portfolio $portfolio)
    {
        // --- LOGGING START ---
        Log::info("--------------------------------------------------");
        Log::info("[Portfolio Update] Starting update process for Portfolio ID: {$portfolio->id}");
        Log::info("[Portfolio Update] Request Data:", $request->except(['_token', '_method'])); // Log all text fields
        // --- LOGGING END ---

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'work_done' => 'nullable|string',
            'client' => 'nullable|string|max:255',
            'completion_date' => 'nullable|date',
            'category' => 'nullable|string|max:255',
            'technologies' => 'nullable|array',
            'technologies.*' => 'string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'project_url' => 'nullable|url|max:255'
        ]);

        // Handle image upload with detailed logging
        if ($request->hasFile('image_url')) {
            // --- LOGGING START ---
            Log::info("[Portfolio Update] New image file was found in the request ('image_url').");
            $file = $request->file('image_url');
            Log::info("[Portfolio Update] File details: name='{$file->getClientOriginalName()}', size='{$file->getSize()}', mime='{$file->getClientMimeType()}'");
            // --- LOGGING END ---

            // Delete old image if it exists
            $oldImagePath = $portfolio->getRawOriginal('image_url');
            if ($portfolio->hasImage() && $oldImagePath) {
                Log::info("[Portfolio Update] An old image exists at path: '{$oldImagePath}'");
                if (Storage::disk('public')->exists($oldImagePath)) {
                    Log::info("[Portfolio Update] Old image file confirmed to exist on disk. Attempting deletion.");
                    $deleted = Storage::disk('public')->delete($oldImagePath);
                    if ($deleted) {
                        Log::info("[Portfolio Update] Old image successfully deleted.");
                    } else {
                        Log::warning("[Portfolio Update] FAILED to delete old image file from disk.");
                    }
                } else {
                    Log::warning("[Portfolio Update] Old image path recorded in DB, but file NOT FOUND on disk at: '{$oldImagePath}'");
                }
            } else {
                 Log::info("[Portfolio Update] No old image to delete.");
            }
            
            // Store the new image with descriptive filename
            Log::info("[Portfolio Update] Storing new image in 'portfolios' directory.");
            $extension = $file->getClientOriginalExtension();
            $slug = \Illuminate\Support\Str::slug($validated['title']);
            $filename = $slug . '.' . $extension;
            $path = $file->storeAs('portfolios', $filename, 'public');
            $validated['image_url'] = $path;
            Log::info("[Portfolio Update] New image successfully stored. New path is: '{$path}'");
        } else {
            // --- LOGGING START ---
            Log::info("[Portfolio Update] No new image file was uploaded (request->hasFile('image_url') returned false).");
            // --- LOGGING END ---
        }

        // Convert technologies array to JSON
        if (isset($validated['technologies'])) {
            $validated['technologies'] = array_filter($validated['technologies']);
        }

        // --- LOGGING START ---
        Log::info("[Portfolio Update] Final data being passed to portfolio->update():", $validated);
        // --- LOGGING END ---

        $portfolio->update($validated);

        // --- LOGGING START ---
        Log::info("[Portfolio Update] Portfolio model updated successfully in the database.");
        Log::info("--------------------------------------------------");
        // --- LOGGING END ---

        return redirect()->route('admin.portfolios.index')
            ->with('success', 'Portfolio item updated successfully');
    }

    public function destroy(Portfolio $portfolio)
    {
        // Delete associated image if it exists
        if ($portfolio->hasImage()) {
            Storage::disk('public')->delete($portfolio->getRawOriginal('image_url'));
        }
        
        $portfolio->delete();
        
        return redirect()->route('admin.portfolios.index')
            ->with('success', 'Portfolio item deleted successfully');
    }
}