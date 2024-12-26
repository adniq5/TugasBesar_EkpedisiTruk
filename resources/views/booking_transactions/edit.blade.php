@extends('layouts.app')

@section('content')
    <h1>Edit Booking Transaction</h1>

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

    <form action="{{ route('booking-transactions.update', $transaction) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="customer_id">Customer</label>
            <select name="customer_id" class="form-control" required>
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}" {{ $transaction->customer_id == $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="order_id">Order</label>
            <select name="order_id" class="form-control" required>
                @foreach ($orders as $order)
                    <option value="{{ $order->id }}" {{ $transaction->order_id == $order->id ? 'selected' : '' }}>{{ $order->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" class="form-control" value="{{ $transaction->quantity }}" required>
        </div>

        <div class="form-group">
            <label for="total_amount">Total Amount</label>
            <input type="number" name="total_amount" class="form-control" value="{{ $transaction->total_amount }}" required>
        </div>

        <div class="form-group">
            <label for="is_paid">Is Paid</label>
            <input type="checkbox" name="is_paid" value="1" {{ $transaction->is_paid ? 'checked' : '' }}>
        </div>

        <div class="form-group">
            <label for="proof">Proof</label>
            <input type="file" name="proof" class="form-control">
            @if ($transaction->proof)
                <img src="{{ asset('storage/' . $transaction->proof) }}" alt="Proof" width="100" class="mt-2">
            @else
                <p>No proof uploaded.</p>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
