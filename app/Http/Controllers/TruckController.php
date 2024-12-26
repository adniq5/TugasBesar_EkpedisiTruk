<?php

namespace App\Http\Controllers;

use App\Models\Truck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TruckController extends Controller
{
    // Menampilkan daftar semua truk
    public function index()
    {
        $trucks = Truck::all();
        return view('trucks.index', compact('trucks'));
    }

    // Menampilkan formulir untuk menambahkan truk baru
    public function create()
    {
        return view('trucks.create');
    }

    // Menyimpan truk baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'license_plate' => 'required|string|max:20|unique:trucks,license_plate',
            'capacity' => 'required|integer',
            'status' => 'required|string',
            'driver_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $truck = new Truck($request->all());

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('trucks', 'public');
            $truck->image = $path;
        }

        $truck->save();

        return redirect()->route('trucks.index')->with('success', 'Truck created successfully.');
    }

    // Menampilkan formulir untuk mengedit truk
    public function edit(Truck $truck)
    {
        return view('trucks.edit', compact('truck'));
    }

    // Memperbarui data truk di database
    public function update(Request $request, Truck $truck)
    {
        $request->validate([
            'license_plate' => 'required|string|max:20|unique:trucks,license_plate,' . $truck->id,
            'capacity' => 'required|integer',
            'status' => 'required|string',
            'driver_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $truck->fill($request->all());

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($truck->image) {
                Storage::disk('public')->delete($truck->image);
            }
            $path = $request->file('image')->store('trucks', 'public');
            $truck->image = $path;
        }

        $truck->save();

        return redirect()->route('trucks.index')->with('success', 'Truck updated successfully.');
    }

    // Menghapus truk dari database
    public function destroy(Truck $truck)
    {
        // Hapus gambar jika ada
        if ($truck->image) {
            Storage::disk('public')->delete($truck->image);
        }

        $truck->delete();

        return redirect()->route('trucks.index')->with('success', 'Truck deleted successfully.');
    }
}
