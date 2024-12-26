@extends('layouts.app')

@section('content')
    <h1>Customer Details</h1>
    <p><strong>Name:</strong> {{ $customer->name }}</p>
    <p><strong>Email:</strong> {{ $customer->email }}</p>
    <p><strong>Phone:</strong> {{ $customer->phone }}</p>
    @if ($customer->profile_picture)
        <p><strong>Profile Picture:</strong></p>
        <img src="{{ asset('storage/' . $customer->profile_picture) }}" alt="Profile Picture" width="100">
    @endif
    <a href="{{ route('customers.index') }}" class="btn btn-secondary">Back</a>
@endsection
