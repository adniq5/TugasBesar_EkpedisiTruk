@extends('layouts.app')

@section('content')
    <h1>Daftar Pesanan</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Truck</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->customer->name }}</td>
                    <td>{{ $order->truck->license_plate }}</td>
                    <td>{{ $order->formatted_price }}</td> <!-- Menggunakan accessor untuk format harga -->
                    
                </tr>
            @endforeach
        </tbody>
    </table>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
@endsection
