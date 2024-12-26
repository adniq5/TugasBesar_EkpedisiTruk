<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    // Menampilkan daftar semua customer
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    // Menampilkan formulir untuk menambahkan customer baru
    public function create()
    {
        return view('customers.create');
    }

    // Menyimpan customer baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'nullable|string|max:20',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $customer = new Customer($request->all());

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $customer->profile_picture = $path;
        }

        $customer->save();

        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }

    // Menampilkan formulir untuk mengedit customer
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    // Memperbarui data customer di database
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'phone' => 'nullable|string|max:20',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $customer->fill($request->all());

        if ($request->hasFile('profile_picture')) {
            // Hapus gambar lama jika ada
            if ($customer->profile_picture) {
                Storage::disk('public')->delete($customer->profile_picture);
            }
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $customer->profile_picture = $path;
        }

        $customer->save();

        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }

    // Menghapus customer dari database
    public function destroy(Customer $customer)
    {
        // Hapus gambar jika ada
        if ($customer->profile_picture) {
            Storage::disk('public')->delete($customer->profile_picture);
        }

        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }
}
