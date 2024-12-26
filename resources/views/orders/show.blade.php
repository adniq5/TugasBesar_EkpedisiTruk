@extends('layouts.app')

@section('content')
    <h1>Order Details</h1>
    <p><strong>Customer:</strong> {{ $order->customer->name }}</p>
    <p><strong>Truck:</strong> {{ $order->truck->license_plate }}</p>
    <p><strong>Order Date:</strong> {{ $order->order_date }}</p>
    <p><strong>Notes:</strong> {{ $order->notes }}</p>
    <p><strong>Price:</strong> {{ $order->price }}</p>
    <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back</a>
@endsection
