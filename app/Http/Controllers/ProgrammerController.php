<?php

namespace App\Http\Controllers;

use App\Models\Programmer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgrammerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programmers = Programmer::all(); // Mengambil semua data programmer
        return view('programmers.index', compact('programmers')); // Mengirim data ke tampilan
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('programmers.create'); // Menampilkan formulir untuk menambah programmer
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:20|unique:programmers,nim',
            'kelas' => 'required|string|max:50',
            'jurusan' => 'required|string|max:100',
            'instansi' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi untuk gambar
        ]);

        $programmer = new Programmer($request->all()); // Membuat instance baru dari Programmer

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('programmers/images', 'public'); // Menyimpan gambar
            $programmer->image = $path; // Menyimpan path gambar ke model
        }

        $programmer->save(); // Menyimpan programmer ke database

        return redirect()->route('programmers.index')->with('success', 'Programmer created successfully.'); // Redirect dengan pesan sukses
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $programmer = Programmer::findOrFail($id); // Mengambil programmer berdasarkan ID
        return view('programmers.show', compact('programmer')); // Menampilkan detail programmer
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $programmer = Programmer::findOrFail($id); // Mengambil programmer berdasarkan ID
        return view('programmers.edit', compact('programmer')); // Menampilkan formulir untuk mengedit programmer
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $programmer = Programmer::findOrFail($id); // Mengambil programmer berdasarkan ID

        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:20|unique:programmers,nim,' . $programmer->id,
            'kelas' => 'required|string|max:50',
            'jurusan' => 'required|string|max:100',
            'instansi' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi untuk gambar
        ]);

        $programmer->fill($request->all()); // Mengisi data programmer dengan input

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($programmer->image) {
                Storage::disk('public')->delete($programmer->image); // Menghapus gambar lama dari storage
            }
            $path = $request->file('image')->store('programmers/images', 'public'); // Menyimpan gambar baru
            $programmer->image = $path; // Menyimpan path gambar baru ke model
        }

        $programmer->save(); // Menyimpan perubahan ke database

        return redirect()->route('programmers.index')->with('success', 'Programmer updated successfully.'); // Redirect dengan pesan sukses
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $programmer = Programmer::findOrFail($id); // Mengambil programmer berdasarkan ID

        // Hapus gambar jika ada
        if ($programmer->image) {
            Storage::disk('public')->delete($programmer->image); // Menghapus gambar dari storage
        }

        $programmer->delete(); // Menghapus programmer dari database

        return redirect()->route('programmers.index')->with('success', 'Programmer deleted successfully.'); // Redirect dengan pesan sukses
    }
}
