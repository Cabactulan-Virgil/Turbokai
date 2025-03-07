<?php

namespace App\Http\Controllers;
use App\Models\Deleviries;
use App\Models\Truck;


class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }
    public function index()
    {
        return view('admin'); // resources/views/dashboard.blade.php
    }

    public function dashboard()
{
    return view('dashboard');
}
    public function truckNdriver()
    {
        $deliveries = Deleviries::all(); 
        // dd($deliveries);// Ensure you are using the correct model name

        // Group deliveries by client
        $groupedDeliveriesByClient = $deliveries->groupBy('client');
       //dd($groupedDeliveriesByClient);
       
        $groupedDeliveriesByLicensePlate = $deliveries->groupBy('licensePlate');
       
        // Return the view with the grouped deliveries
        return view('truckNdriver', compact('deliveries', 'groupedDeliveriesByLicensePlate'));
    }
    public function delivery()
    {
        return view('delivery');
    }

    public function clients()
    {
        return view('clients'); 
    }
    // public function reports()
    // {
    //     $deleviries  = Deleviries::all();
    //     dd('', $deleviries);
    //     return view("reports",compact("deleviries"));
        

    //     // return view('reports');
    // }

    public function report()
    {
        // Retrieve all deliveries
        $deliveries = Deleviries::all(); 
        // dd($deliveries);// Ensure you are using the correct model name

        // Group deliveries by client
        $groupedDeliveriesByClient = $deliveries->groupBy('client');
       //dd($groupedDeliveriesByClient);
       
        $groupedDeliveriesByLicensePlate = $deliveries->groupBy('licensePlate');
       
        // Return the view with the grouped deliveries
        return view('reports', compact('deliveries','groupedDeliveriesByClient', 'groupedDeliveriesByLicensePlate'));
    }
}

    
