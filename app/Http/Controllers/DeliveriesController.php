<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Truck;
use App\Models\Client;
use App\Models\Deleviries;

class DeliveriesController extends Controller
{
    // Display deliveries
    public function index(Request $request)
    {
        // Fetch deliveries based on the status filter if provided
        $status = $request->query('status', 'pending'); // Default to 'pending'
        $deliveries = Deleviries::where('status', $status)->get();

        // Fetch distinct drivers, client names, and delivery places
        $drivers = Truck::distinct()->pluck('driverName')->values();
        $clientNames = Client::distinct()->pluck('clientName')->values();
        $placesOfDelivery = Client::distinct()->pluck('placeOfDelivery')->values();
        //$licensePlate = Truck::distinct()->pluck('licensePlate')->values();
        $licensePlates = Truck::distinct()->pluck('licensePlate')->values();
        $trucks = Truck::latest()->get();

    // Debug the $licensePlate variable
    //dd($licensePlate);
        return view('delivery', compact('deliveries', 'drivers','licensePlates', 'clientNames', 'placesOfDelivery', 'status', 'trucks'));
    }

    // Store delivery record
    public function store(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'doNo' => 'required|string|max:255',
            'dimension' => 'required|string',
            'pulloutDate' => 'required|date',
            'vanNo' => 'required|string|max:255',
            'client' => 'required|string',
            'driver' => 'required|string',
            'licensePlate' => 'required|string|max:255',
            'cargoDetails' => 'nullable|string',
            'location' => 'required|string',
            'returnDate' => 'nullable|date',
            'status' => 'required|string|in:pending,onTheWay,delivered',
            'truckingFee' => 'required|numeric',
            'truck_id' => 'required|numeric',
        ]);
        //dd($validatedData);
        // Create the delivery record
        Deleviries::create(attributes: $validatedData);

        // Redirect to the deliveries page with the appropriate status tab active
        return redirect()->route('delivery-index', ['status' => $request->input('status')])
                         ->with('success', 'Delivery added successfully!');
    }

    public function updateStatus(Request $request)
    {
        // Find the delivery by ID
        $delivery = Deleviries::findOrFail($request->deliveryId);

        // Update the status
        $delivery->status = $request->status;
        $delivery->save();

        // Redirect back to the delivery page with the updated status
        return redirect()->route('delivery-index', ['status' => $request->status])->with('success', 'Status updated successfully!');
    }

    public function edit($id)
    {
        // Find the delivery by ID
        $delivery = Deleviries::findOrFail($id);

        // Return the delivery data as JSON
        return response()->json([
            'id' => $delivery->id,
            'doNo' => $delivery->doNo,
            'dimension' => $delivery->dimension,
            'pulloutDate' => $delivery->pulloutDate,
            'vanNo' => $delivery->vanNo,
            'client' => $delivery->client,
            'driver' => $delivery->driver,
            'licensePlate'=> $delivery->licensePlate,
            'cargoDetails' => $delivery->cargoDetails,
            'location' => $delivery->location,
            'returnDate' => $delivery->returnDate,
            'status' => $delivery->status,
            'truckingFee' => $delivery->truckingFee,
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'doNo' => 'required|string|max:255',
            'dimension' => 'required|string',
            'pulloutDate' => 'required|date',
            'vanNo' => 'required|string|max:255',
            'client' => 'required|string|max:255',
            'driver' => 'required|string|max:255',
            'licensePlate' => 'required|string|max:255',
            'cargoDetails' => 'nullable|string|max:255',
            'location' => 'required|string|max:255',
            'returnDate' => 'nullable|date',
            'status' => 'required|string',
            'truckingFee' => 'required|numeric',
        ]);

        // Find the delivery and update it
        $delivery = Deleviries::findOrFail($id);
        $delivery->update($validated);

        // Redirect or return response
        return redirect()->route('delivery-index')->with('success', 'Delivery updated successfully');
    }

    public function destroy($id)
    {
        // Find the delivery by ID
        $delivery = Deleviries::findOrFail($id);

        // Delete the delivery
        $delivery->delete();

        // Redirect back with a success message
        return redirect()->route('delivery-index')->with('success', 'Delivery deleted successfully!');
    }
    public function show1($truckId)
    {
        // Fetch truck data and delivery history
        $truck = Truck::find($truckId);  // Assuming you have a Truck model
        $deliveries = Delivery::where('truck_id', $truckId)->get();  // Get deliveries for the truck

        // Return the view with the truck and deliveries data
        return view('delivery.view', compact('truck', 'deliveries'));
    }

    public function show($clientId)
{
    // Fetch client data and delivery history
    $client = Client::findOrFail($clientId);  // Assuming you have a Client model
    $deliveries =Delivery::where('client_id', $clientId)->get();  // Get deliveries for the client

    // Return the view with the client and deliveries data
    return view('delivery.view', compact('client', 'deliveries'));
}

}

