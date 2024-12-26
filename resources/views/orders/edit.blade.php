@extends('layouts.app')

@section('content')
    <h1>Edit Order</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('orders.update', $order) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="customer_id">Customer</label>
            <select name="customer_id" class="form-control" required>
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}" {{ $order->customer_id == $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="truck_id">Truck</label>
            <select name="truck_id" class="form-control" required>
                @foreach ($trucks as $truck)
                    <option value="{{ $truck->id }}" {{ $order->truck_id == $truck->id ? 'selected' : '' }}>{{ $truck->license_plate }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="notes">Notes</label>
            <textarea name="notes" class="form-control">{{ $order->notes }}</textarea>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" class="form-control" value="{{ $order->price }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    <form action="{{ route('orders.destroy', $order) }}" method="POST" style="margin-top: 20px;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?');">Hapus Pesanan</button>
    </form>
@endsection
