<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Truck;
use App\Models\Deleviries;

class TruckController extends Controller
{
    public function index()
    {
        $trucks = Truck::with('deliveries')->latest()->get();
        // dd($trucks);
        return view('truckNdriver', compact('trucks'));
    }

    public function store(Request $request)
    {
        // Save the data to the database
        Truck::create($request->all());

        // Redirect or respond with success
        return redirect()->back()->with('success', 'Truck added successfully!');
    }

    public function edit($id)
    {
        $truck = Truck::findOrFail($id);
        // dd($truck);
        // Return truck data as JSON
        return response()->json($truck);
    }

    public function update(Request $request, $id)
    {
        // Find the truck by ID
        $truck = Truck::findOrFail($id);

        // Update the truck without validation
        $truck->update([
            'truckNo' => $request->input('truck_no'),
            'model' => $request->input('truck_model'),
            'licensePlate' => $request->input('plate_no'),
            'expireDate' => $request->input('expire_date'),
            'renewalDate' => $request->input('renewal_date'),
            'driverName' => $request->input('driver_name'),
            'status' => $request->input('status'),

        ]);

        // Redirect or return a response
        return redirect()->route('truck-index')->with('success', 'Truck updated successfully!');
    }

    public function destroy($id)
    {
        // Find the truck by its ID
        $truck = Truck::findOrFail($id);

        // Delete the truck
        $truck->delete();

        // Redirect back with a success message
        return redirect()->route('truck-index')->with('success', 'Truck deleted successfully');
    }

    public function show($id)
    {
        // Fetch truck by ID
        $truck = Truck::find($id);

        if (!$truck) {
            return response()->json(['error' => 'Truck not found'], 404);
        }

        // Fetch related deliveries
        $deliveries = Deliveries::where('truckNo', $id)->get();
        

        // Return truck details and deliveries as JSON
        return response()->json([
            'truck' => $truck,
            'deliveries' => $deliveries
        ]);
    }

    

    

}
