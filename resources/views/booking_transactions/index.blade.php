@extends('layouts.app')

@section('content')
    <h1>Daftar Transaksi Pemesanan</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Transaction ID</th>
                <th>Customer Name</th>
                <th>Order ID</th>
                <th>Payment Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->booking_trx_id }}</td>
                    <td>{{ $transaction->customer ? $transaction->customer->name : 'Tidak Diketahui' }}</td>
                    <td>{{ $transaction->order_id }}</td>
                    <td>
                        <span class="badge {{ $transaction->is_paid ? 'bg-success' : 'bg-danger' }}">
                            {{ $transaction->is_paid ? 'Sudah Dibayar' : 'Belum Dibayar' }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
