@extends('layouts.app')

@section('content')
    <h1>Daftar Transaksi Pemesanan</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('booking-transactions.create') }}" class="btn btn-primary mb-3">Tambah Transaksi Pemesanan</a>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Transaction ID</th>
                <th>Customer Name</th>
                <th>Order ID</th>
                <th>Payment Status</th>
                <th>Aksi</th>
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
                    <td>
                        <a href="{{ route('booking-transactions.edit', $transaction) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('booking-transactions.destroy', $transaction) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?');">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
