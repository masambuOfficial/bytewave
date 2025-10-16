<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::orderBy('name')->paginate(10);
        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.clients.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients',
            'phone' => 'required|string|max:20',
            'address' => 'required|string'
        ]);

        Client::create($validated);

        return redirect()->route('admin.clients.index')
            ->with('success', 'Client created successfully');
    }

    public function edit(Client $client)
    {
        return view('admin.clients.form', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email,' . $client->id,
            'phone' => 'required|string|max:20',
            'address' => 'required|string'
        ]);

        $client->update($validated);

        return redirect()->route('admin.clients.index')
            ->with('success', 'Client updated successfully');
    }

    public function destroy(Client $client)
    {
        if ($client->quotations()->exists() || $client->invoices()->exists()) {
            return redirect()->route('admin.clients.index')
                ->with('error', 'Cannot delete client with associated quotations or invoices');
        }

        $client->delete();
        return redirect()->route('admin.clients.index')
            ->with('success', 'Client deleted successfully');
    }
}
