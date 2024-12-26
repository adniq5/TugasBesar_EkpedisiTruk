<?php

namespace App\Http\Controllers;

use App\Models\Programmer; 
use App\Models\BookingTransaction;
use App\Models\Customer; // Jika ada model Customer
use App\Models\Order; // Jika ada model Order
use App\Models\Truck; // Jika ada model Truck
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $programmers = Programmer::all();
        $bookings = BookingTransaction::all(); // Ambil data booking
        $customers = Customer::all(); // Ambil data customer
        $orders = Order::all(); // Ambil data order
        $trucks = Truck::all(); // Ambil data truck

        return view('frontend.index', compact('programmers', 'bookings', 'customers', 'orders', 'trucks'));
    }
}
