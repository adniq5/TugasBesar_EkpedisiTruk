@extends('layouts.app')

@section('content')
    <h1>Booking Transaction Details</h1>
    <p><strong>Customer:</strong> {{ $transaction->customer->name }}</p>
    <p><strong>Order:</strong> {{ $transaction->order->name }}</p>
    <p><strong>Quantity:</strong> {{ $transaction->quantity }}</p>
    <p><strong>Total Amount:</strong> {{ $transaction->total_amount }}</p>
    <p><strong>Is Paid:</strong> {{ $transaction->is_paid ? 'Yes' : 'No' }}</p>
    @if ($transaction->proof)
        <p><strong>Proof:</strong></p>
        <img src="{{ asset('storage/' . $transaction->proof) }}" alt="Proof" width="100">
    @endif
    <a href="{{ route('booking-transactions.index') }}" class="btn btn-secondary">Back</a>
@endsection
