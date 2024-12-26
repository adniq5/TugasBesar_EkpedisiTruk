@extends('layouts.app')

@section('content')
    <h1>Add Booking Transaction</h1>
    <form action="{{ route('booking-transactions.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="customer_id">Customer</label>
            <select name="customer_id" class="form-control" required>
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="order_id">Order</label>
            <select name="order_id" class="form-control" required>
                @foreach ($orders as $order)
                    <option value="{{ $order->id }}">{{ $order->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="total_amount">Total Amount</label>
            <input type="number" name="total_amount" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="is_paid">Is Paid</label>
            <input type="checkbox" name="is_paid" value="1">
        </div>
        <div class="form-group">
            <label for="proof">Proof</label>
            <input type="file" name="proof" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
