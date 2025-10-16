<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientService;
use Illuminate\Http\Request;

class ClientServiceController extends Controller
{
    public function index()
    {
        $services = ClientService::latest()->paginate(10);
        return view('admin.client-services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.client-services.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'rate' => 'required|numeric|min:0',
            'unit' => 'required|string|in:hour,project,month,unit'
        ]);

        ClientService::create($validated);

        return redirect()->route('admin.client-services.index')
            ->with('success', 'Service created successfully.');
    }

    public function edit(ClientService $clientService)
    {
        return view('admin.client-services.form', ['service' => $clientService]);
    }

    public function update(Request $request, ClientService $clientService)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'rate' => 'required|numeric|min:0',
            'unit' => 'required|string|in:hour,project,month,unit'
        ]);

        $clientService->update($validated);

        return redirect()->route('admin.client-services.index')
            ->with('success', 'Service updated successfully.');
    }

    public function destroy(ClientService $clientService)
    {
        $clientService->delete();
        return redirect()->route('admin.client-services.index')
            ->with('success', 'Service deleted successfully.');
    }
}
