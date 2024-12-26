<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Truck;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with(['customer', 'truck'])->get(); // Mengambil semua pesanan dengan relasi customer dan truck
        return view('orders.index', compact('orders')); // Mengirim data ke tampilan
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all(); // Mengambil semua pelanggan
        $trucks = Truck::all(); // Mengambil semua truk
        return view('orders.create', compact('customers', 'trucks')); // Menampilkan formulir untuk menambah pesanan
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id', // Validasi ID pelanggan
            'truck_id' => 'required|exists:trucks,id', // Validasi ID truk
            'order_date' => 'required|date', // Validasi tanggal pesanan
            'notes' => 'nullable|string', // Validasi catatan
            'price' => 'required|numeric', // Validasi harga
        ]);

        // Membuat pesanan baru
        Order::create($request->all());

        return redirect()->route('orders.index')->with('success', 'Order created successfully.'); // Redirect dengan pesan sukses
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $customers = Customer::all(); // Mengambil semua pelanggan
        $trucks = Truck::all(); // Mengambil semua truk
        return view('orders.edit', compact('order', 'customers', 'trucks')); // Menampilkan formulir untuk mengedit pesanan
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id', // Validasi ID pelanggan
            'truck_id' => 'required|exists:trucks,id', // Validasi ID truk
            'order_date' => 'required|date', // Validasi tanggal pesanan
            'notes' => 'nullable|string', // Validasi catatan
            'price' => 'required|numeric', // Validasi harga
        ]);

        // Memperbarui pesanan
        $order->update($request->all());

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.'); // Redirect dengan pesan sukses
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete(); // Menghapus pesanan dari database
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.'); // Redirect dengan pesan sukses
    }
}
