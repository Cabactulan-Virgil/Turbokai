<?php

namespace App\Http\Controllers;

use App\Models\Truck;
//use App\Models\Driver;
use App\Models\Client;
use App\Models\Deleviries;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get the counts for each entity
        $totalTrucks = Truck::count();
        $totalClients = Client::count();
        $totalDeliveries = Deleviries::count();
        $driverStatuses = Truck::select('driverName', 'status')
                           ->distinct()
                           ->get(); // Ensure you're selecting the right columns for the driver

    // You can also check for active statuses like 'In Trip' or 'In Delivery'
    $totalDrivers = Truck::distinct('driverName')->count('driverName'); 

    return view('dashboard', compact('totalTrucks', 'totalClients', 'totalDeliveries', 'totalDrivers', 'driverStatuses'));
    }
}


