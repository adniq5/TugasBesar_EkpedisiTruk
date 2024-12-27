@extends('layouts.app')

@section('content')
    <h1>Daftar Pelanggan</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Gambar Profil</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
                <tr>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>
                        @if ($customer->profile_picture)
                            <img src="{{ asset('storage/' . $customer->profile_picture) }}" alt="Profile Picture" style="width: 50px; height: 50px; object-fit: cover;">
                        @else
                            <span>Tidak ada gambar</span>
                        @endif
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
