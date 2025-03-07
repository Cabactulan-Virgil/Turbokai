<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function index()
{
    // Fetch clients from the database
    $clients = Client::all();
    //dd($clients);
    
    // Pass the $clients variable to the view
    return view('clients', compact('clients'));
}
    public function store(Request $request)
    {
        // Save the data to the database
        client::create($request->all());

        // Redirect or respond with success
        return redirect()->back()->with('success', 'Client added successfully!');
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);
        // dd($client);
        // Return client data as JSON
        return response()->json($client);
    }

    public function update(Request $request, $id)
{
    // Find the client by ID
    $client = Client::findOrFail($id);

    // Update the client details directly
    $client->update([
        'clientNo' => $request->input('client_no'),
        'clientName' => $request->input('client_name'), // Corrected key casing
        'placeOfDelivery' => $request->input('place_of_delivery'),
        'contact' => $request->input('contact'),
    ]);

    // Redirect to the client index route with a success message
    return redirect()->route('client-index')->with('success', 'Client updated successfully!');
}


    public function destroy($id)
    {
        // Find the client by its ID
        $client = Client::findOrFail($id);

        // Delete the client
        $client->delete();

        // Redirect back with a success message
        return redirect()->route('client-index')->with('success', 'Client deleted successfully');
    }

    public function show($clientId)
    {
        // Fetch client data and delivery history
        $client = Client::findOrFail($clientId);
        $deliveries = Deleviries::where('client_id', $clientId)->get();

        return view('delivery.client-view', compact('client', 'deliveries'));
    }

    public function getClientDeliveries($clientId)
{
    // Fetch deliveries for the specific client
    $deliveries = \App\Models\Delivery::where('client_id', $clientId)->get();

    // Return the data as JSON (for an AJAX request)
    return response()->json($deliveries);
}


}