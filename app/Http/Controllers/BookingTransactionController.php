<?php

namespace App\Http\Controllers;

use App\Models\BookingTransaction;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookingTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = BookingTransaction::with(['customer', 'order'])->get(); // Mengambil semua transaksi dengan relasi customer dan order
        return view('booking_transactions.index', compact('transactions')); // Mengirim data ke tampilan
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all(); // Mengambil semua pelanggan
        $orders = Order::all(); // Mengambil semua pesanan
        return view('booking_transactions.create', compact('customers', 'orders')); // Menampilkan formulir untuk menambah transaksi
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id', // Validasi ID pelanggan
            'order_id' => 'required|exists:orders,id', // Validasi ID pesanan
            'quantity' => 'required|integer', // Validasi jumlah
            'total_amount' => 'required|numeric', // Validasi total jumlah
            'is_paid' => 'boolean', // Validasi status pembayaran
            'proof' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi bukti pembayaran
        ]);

        $transaction = new BookingTransaction($request->all()); // Membuat instance baru dari BookingTransaction

        if ($request->hasFile('proof')) {
            $path = $request->file('proof')->store('proofs', 'public'); // Menyimpan bukti pembayaran
            $transaction->proof = $path; // Menyimpan path bukti ke model
        }

        $transaction->save(); // Menyimpan transaksi ke database

        return redirect()->route('booking-transactions.index')->with('success', 'Booking Transaction created successfully.'); // Redirect dengan pesan sukses
    }

    /**
     * Display the specified resource.
     */
    public function show(BookingTransaction $transaction)
    {
        return view('booking_transactions.show', compact('transaction')); // Menampilkan detail transaksi
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BookingTransaction $transaction)
    {
        $customers = Customer::all(); // Mengambil semua pelanggan
        $orders = Order::all(); // Mengambil semua pesanan
        return view('booking_transactions.edit', compact('transaction', 'customers', 'orders')); // Menampilkan formulir untuk mengedit transaksi
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BookingTransaction $transaction)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id', // Validasi ID pelanggan
            'order_id' => 'required|exists:orders,id', // Validasi ID pesanan
            'quantity' => 'required|integer', // Validasi jumlah
            'total_amount' => 'required|numeric', // Validasi total jumlah
            'is_paid' => 'boolean', // Validasi status pembayaran
            'proof' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi bukti pembayaran
        ]);

        $transaction->fill($request->all()); // Mengisi data transaksi dengan input

        if ($request->hasFile('proof')) {
            // Hapus bukti lama jika ada
            if ($transaction->proof) {
                Storage::disk('public')->delete($transaction->proof); // Menghapus bukti lama dari storage
            }
            $path = $request->file('proof')->store('proofs', 'public'); // Menyimpan bukti baru
            $transaction->proof = $path; // Menyimpan path bukti baru ke model
        }

        $transaction->save(); // Menyimpan perubahan ke database

        return redirect()->route('booking-transactions.index')->with('success', 'Booking Transaction updated successfully.'); // Redirect dengan pesan sukses
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookingTransaction $transaction)
    {
        // Hapus bukti jika ada
        if ($transaction->proof) {
            Storage::disk('public')->delete($transaction->proof); // Menghapus bukti dari storage
        }

        $transaction->delete(); // Menghapus transaksi dari database

        return redirect()->route('booking-transactions.index')->with('success', 'Booking Transaction deleted successfully.'); // Redirect dengan pesan sukses
    }
}
