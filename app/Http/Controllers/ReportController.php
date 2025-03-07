<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Deleviries;

class ReportController extends Controller
{
    public function report(Request $request)
    {
        // Retrieve all deliveries
        $deliveries = Deleviries::all();
    
        // Check if the request is for grouped deliveries or all deliveries
        $type = $request->query('type', 'all'); // Default to 'all' if no query parameter is passed
    
        if ($type == 'grouped') {
            // Group deliveries by client
            $groupedDeliveries = $deliveries->groupBy('client');
            // Get distinct trucks and drivers
            $trucks = Deleviries::distinct()->pluck('vanNo');
            $drivers = Deleviries::distinct()->pluck('driver');
    
            // Pass the grouped deliveries, trucks, and drivers to the view
            return view('reports', compact('groupedDeliveries', 'trucks', 'drivers'));
        }
    
        // Default case: show all deliveries (not grouped)
        return view('reports', compact('deliveries'));
    }
}


