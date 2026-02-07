<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'currency' => 'nullable|string|in:USD,UGX',
            'billing_cycle' => 'required|string|in:one_time,monthly,annual',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string|in:Hardware,Software,Networking,Security,Other',
            'image' => 'nullable|image|max:2048'
        ]);

        if (empty($validated['currency'])) {
            $validated['currency'] = 'USD';
        }

        // Generate slug from name
        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $slug = Str::slug($validated['name']);
            $filename = $slug . '.' . $extension;
            $path = $file->storeAs('products', $filename, 'public');
            $validated['image_url'] = $path;
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully');
    }

    public function edit(Product $product)
    {
        return view('admin.products.form', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'currency' => 'nullable|string|in:USD,UGX',
            'billing_cycle' => 'required|string|in:one_time,monthly,annual',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string|in:Hardware,Software,Networking,Security,Other',
            'image' => 'nullable|image|max:2048'
        ]);

        if (empty($validated['currency'])) {
            $validated['currency'] = $product->currency ?? 'USD';
        }

        // Generate slug from name
        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $slug = Str::slug($validated['name']);
            $filename = $slug . '.' . $extension;
            $path = $file->storeAs('products', $filename, 'public');
            $validated['image_url'] = $path;
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully');
    }
}
