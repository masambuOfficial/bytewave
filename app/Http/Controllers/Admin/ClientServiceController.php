<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ClientServiceController extends Controller
{
    public function index()
    {
        $q        = request()->string('q')->trim()->toString();
        $currency = request()->string('currency')->trim()->toString();
        $status   = request()->string('status')->trim()->toString();

        $servicesQuery = ClientService::query()->latest();

        if ($q !== '') {
            $servicesQuery->where(function ($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                      ->orWhere('description', 'like', "%{$q}%")
                      ->orWhere('unit', 'like', "%{$q}%");
            });
        }

        if ($currency !== '') {
            $servicesQuery->where('currency', $currency);
        }

        if ($status !== '') {
            $servicesQuery->where('status', $status);
        }

        $services = $servicesQuery->paginate(10)->withQueryString();
        return view('admin.client-services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.client-services.form', [
            'hasStatusColumn'   => true,
            'hasCurrencyColumn' => true,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'rate'        => 'required|numeric|min:0',
            'currency'    => 'nullable|string|in:UGX,USD',
            'unit'        => 'nullable|string|max:50',
            'status'      => 'nullable|string|max:50',
        ]);

        $validated['currency'] = $validated['currency'] ?? 'UGX';
        $validated['status']   = $validated['status'] ?? 'active';

        if (isset($validated['unit'])) {
            $validated['unit'] = $validated['unit'] ? strtolower(trim($validated['unit'])) : null;
        }

        ClientService::create($validated);

        return redirect()->route('admin.client-services.index')
            ->with('success', 'Service created successfully.');
    }

    public function edit(ClientService $clientService)
    {
        return view('admin.client-services.form', [
            'service'           => $clientService,
            'hasStatusColumn'   => true,
            'hasCurrencyColumn' => true,
        ]);
    }

    public function update(Request $request, ClientService $clientService)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'rate'        => 'required|numeric|min:0',
            'currency'    => 'nullable|string|in:UGX,USD',
            'unit'        => 'nullable|string|max:50',
            'status'      => 'nullable|string|max:50',
        ]);

        $validated['currency'] = $validated['currency'] ?? ($clientService->currency ?? 'UGX');
        $validated['status']   = $validated['status'] ?? ($clientService->status ?? 'active');

        if (isset($validated['unit'])) {
            $validated['unit'] = $validated['unit'] ? strtolower(trim($validated['unit'])) : null;
        }

        $clientService->update($validated);

        return redirect()->route('admin.client-services.index')
            ->with('success', 'Service updated successfully.');
    }

    public function quickStore(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'rate'        => 'required|numeric|min:0',
            'currency'    => 'nullable|string|in:UGX,USD',
            'unit'        => 'nullable|string|max:50',
        ]);

        $validated['currency'] = $validated['currency'] ?? 'UGX';
        $validated['status']   = 'active';

        if (isset($validated['unit'])) {
            $validated['unit'] = $validated['unit'] ? strtolower(trim($validated['unit'])) : null;
        }

        $service = ClientService::firstOrCreate(
            ['name' => $validated['name']],
            [
                'description' => $validated['description'] ?? null,
                'rate'        => $validated['rate'],
                'currency'    => $validated['currency'],
                'unit'        => $validated['unit'] ?? null,
                'status'      => 'active',
            ]
        );

        return response()->json([
            'id'       => $service->id,
            'name'     => $service->name,
            'rate'     => $service->rate,
            'currency' => $service->currency ?? 'UGX',
            'unit'     => $service->unit,
        ]);
    }

    public function destroy(ClientService $clientService)
    {
        $clientService->delete();
        return redirect()->route('admin.client-services.index')
            ->with('success', 'Service deleted successfully.');
    }
}
