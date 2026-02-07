<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\PortfolioMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // <-- Import the Log facade
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
            'primary_media_type' => 'nullable|in:image,video,embed',
            'primary_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'primary_video' => 'nullable|file|mimes:mp4,webm,mov|max:51200',
            'primary_embed' => 'nullable|string',
            'gallery_uploads' => 'nullable|array',
            'gallery_uploads.*' => 'file|mimes:jpeg,png,jpg,gif,mp4,webm,mov|max:51200',
            'gallery_embeds' => 'nullable|string',
            'project_url' => 'nullable|url|max:255'
        ]);

        $primaryType = $validated['primary_media_type'] ?? null;
        if (!$primaryType) {
            $primaryType = 'image';
        }

        $validated['primary_media_type'] = $primaryType;
        $validated['primary_media_path'] = null;
        $validated['primary_media_embed'] = null;

        if ($primaryType === 'image' && $request->hasFile('primary_image')) {
            $file = $request->file('primary_image');
            $extension = $file->getClientOriginalExtension();
            $slug = Str::slug($validated['title']);
            $filename = $slug . '-' . time() . '.' . $extension;
            $path = $file->storeAs('portfolios', $filename, 'public');
            $validated['primary_media_path'] = $path;
        }

        if ($primaryType === 'video' && $request->hasFile('primary_video')) {
            $file = $request->file('primary_video');
            $extension = $file->getClientOriginalExtension();
            $slug = Str::slug($validated['title']);
            $filename = $slug . '-' . time() . '.' . $extension;
            $path = $file->storeAs('portfolios', $filename, 'public');
            $validated['primary_media_path'] = $path;
        }

        if ($primaryType === 'embed') {
            $validated['primary_media_embed'] = $validated['primary_embed'] ?? null;
        }

        if ($request->hasFile('image_url') && empty($validated['primary_media_path']) && empty($validated['primary_media_embed'])) {
            $file = $request->file('image_url');
            $extension = $file->getClientOriginalExtension();
            $slug = Str::slug($validated['title']);
            $filename = $slug . '-' . time() . '.' . $extension;
            $path = $file->storeAs('portfolios', $filename, 'public');
            $validated['image_url'] = $path;
        }

        if (isset($validated['technologies'])) {
            $validated['technologies'] = array_filter($validated['technologies']);
        }

        $portfolio = Portfolio::create($validated);

        if ($request->hasFile('gallery_uploads')) {
            foreach ($request->file('gallery_uploads', []) as $upload) {
                if (!$upload) {
                    continue;
                }
                $ext = $upload->getClientOriginalExtension();
                $slug = Str::slug($portfolio->title);
                $filename = $slug . '-gallery-' . time() . '-' . Str::random(6) . '.' . $ext;
                $path = $upload->storeAs('portfolios', $filename, 'public');
                $type = Str::startsWith($upload->getClientMimeType(), 'video/') ? 'video' : 'image';

                PortfolioMedia::create([
                    'portfolio_id' => $portfolio->id,
                    'media_type' => $type,
                    'media_path' => $path,
                ]);
            }
        }

        $galleryEmbedsRaw = $validated['gallery_embeds'] ?? null;
        if ($galleryEmbedsRaw) {
            $lines = preg_split('/\r\n|\r|\n/', $galleryEmbedsRaw);
            foreach ($lines as $line) {
                $line = trim($line);
                if ($line === '') {
                    continue;
                }
                PortfolioMedia::create([
                    'portfolio_id' => $portfolio->id,
                    'media_type' => 'embed',
                    'media_embed' => $line,
                ]);
            }
        }

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
            'primary_media_type' => 'nullable|in:image,video,embed',
            'primary_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'primary_video' => 'nullable|file|mimes:mp4,webm,mov|max:51200',
            'primary_embed' => 'nullable|string',
            'gallery_uploads' => 'nullable|array',
            'gallery_uploads.*' => 'file|mimes:jpeg,png,jpg,gif,mp4,webm,mov|max:51200',
            'gallery_embeds' => 'nullable|string',
            'project_url' => 'nullable|url|max:255'
        ]);

        $primaryType = $validated['primary_media_type'] ?? ($portfolio->getRawOriginal('primary_media_type') ?: 'image');
        $validated['primary_media_type'] = $primaryType;

        if ($primaryType === 'image' && $request->hasFile('primary_image')) {
            $oldPath = $portfolio->getRawOriginal('primary_media_path');
            if ($oldPath && Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
            $file = $request->file('primary_image');
            $extension = $file->getClientOriginalExtension();
            $slug = Str::slug($validated['title']);
            $filename = $slug . '-' . time() . '.' . $extension;
            $path = $file->storeAs('portfolios', $filename, 'public');
            $validated['primary_media_path'] = $path;
            $validated['primary_media_embed'] = null;
        }

        if ($primaryType === 'video' && $request->hasFile('primary_video')) {
            $oldPath = $portfolio->getRawOriginal('primary_media_path');
            if ($oldPath && Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
            $file = $request->file('primary_video');
            $extension = $file->getClientOriginalExtension();
            $slug = Str::slug($validated['title']);
            $filename = $slug . '-' . time() . '.' . $extension;
            $path = $file->storeAs('portfolios', $filename, 'public');
            $validated['primary_media_path'] = $path;
            $validated['primary_media_embed'] = null;
        }

        if ($primaryType === 'embed') {
            $oldPath = $portfolio->getRawOriginal('primary_media_path');
            if ($oldPath && Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
            $validated['primary_media_path'] = null;
            $validated['primary_media_embed'] = $validated['primary_embed'] ?? null;
        }

        if ($request->hasFile('image_url') && !$request->hasFile('primary_image') && !$request->hasFile('primary_video') && $primaryType !== 'embed') {
            Log::info("[Portfolio Update] New image file was found in the request ('image_url').");
            $file = $request->file('image_url');
            Log::info("[Portfolio Update] File details: name='{$file->getClientOriginalName()}', size='{$file->getSize()}', mime='{$file->getClientMimeType()}'");

            $oldImagePath = $portfolio->getRawOriginal('image_url');
            if ($portfolio->hasImage() && $oldImagePath && Storage::disk('public')->exists($oldImagePath)) {
                Storage::disk('public')->delete($oldImagePath);
            }

            $extension = $file->getClientOriginalExtension();
            $slug = Str::slug($validated['title']);
            $filename = $slug . '-' . time() . '.' . $extension;
            $path = $file->storeAs('portfolios', $filename, 'public');
            $validated['image_url'] = $path;
        }

        if (isset($validated['technologies'])) {
            $validated['technologies'] = array_filter($validated['technologies']);
        }

        Log::info("[Portfolio Update] Final data being passed to portfolio->update():", $validated);

        $portfolio->update($validated);

        if ($request->hasFile('gallery_uploads')) {
            foreach ($request->file('gallery_uploads', []) as $upload) {
                if (!$upload) {
                    continue;
                }
                $ext = $upload->getClientOriginalExtension();
                $slug = Str::slug($portfolio->title);
                $filename = $slug . '-gallery-' . time() . '-' . Str::random(6) . '.' . $ext;
                $path = $upload->storeAs('portfolios', $filename, 'public');
                $type = Str::startsWith($upload->getClientMimeType(), 'video/') ? 'video' : 'image';

                PortfolioMedia::create([
                    'portfolio_id' => $portfolio->id,
                    'media_type' => $type,
                    'media_path' => $path,
                ]);
            }
        }

        $galleryEmbedsRaw = $validated['gallery_embeds'] ?? null;
        if ($galleryEmbedsRaw) {
            $lines = preg_split('/\r\n|\r|\n/', $galleryEmbedsRaw);
            foreach ($lines as $line) {
                $line = trim($line);
                if ($line === '') {
                    continue;
                }
                PortfolioMedia::create([
                    'portfolio_id' => $portfolio->id,
                    'media_type' => 'embed',
                    'media_embed' => $line,
                ]);
            }
        }

        Log::info("[Portfolio Update] Portfolio model updated successfully in the database.");
        Log::info("--------------------------------------------------");

        return redirect()->route('admin.portfolios.index')
            ->with('success', 'Portfolio item updated successfully');
    }

    public function destroy(Portfolio $portfolio)
    {
        if ($portfolio->hasImage()) {
            Storage::disk('public')->delete($portfolio->getRawOriginal('image_url'));
        }

        $primaryPath = $portfolio->getRawOriginal('primary_media_path');
        if ($primaryPath && Storage::disk('public')->exists($primaryPath)) {
            Storage::disk('public')->delete($primaryPath);
        }

        $portfolio->loadMissing('media');
        foreach ($portfolio->media as $media) {
            if ($media->media_path && Storage::disk('public')->exists($media->media_path)) {
                Storage::disk('public')->delete($media->media_path);
            }
        }

        $portfolio->delete();

        return redirect()->route('admin.portfolios.index')
            ->with('success', 'Portfolio item deleted successfully');
    }
}