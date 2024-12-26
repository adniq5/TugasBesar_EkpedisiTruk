@extends('layouts.app')

@section('content')
    <h1>Dashboard</h1>
    <div class="row">
        <div class="col-md-4">
            <h2>Programmers</h2>
            <a href="{{ route('programmers.create') }}" class="btn btn-primary">Add Programmer</a>
            <ul class="list-group">
                @foreach ($programmers as $programmer)
                    <li class="list-group-item">
                        {{ $programmer->nama }}
                        <a href="{{ route('programmers.edit', $programmer) }}" class="btn btn-warning btn-sm float-right">Edit</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-4">
            <h2>Customers</h2>
            <a href="{{ route('customers.create') }}" class="btn btn-primary">Add Customer</a>
            <ul class="list-group">
                @foreach ($customers as $customer)
                    <li class="list-group-item">
                        {{ $customer->name }}
                        <a href="{{ route('customers.edit', $customer) }}" class="btn btn-warning btn-sm float-right">Edit</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-4">
            <h2>Booking Transactions</h2>
            <a href="{{ route('booking-transactions.create') }}" class="btn btn-primary">Add Booking</a>
            <ul class="list-group">
                @foreach ($bookings as $booking)
                    <li class="list-group-item">
                        Booking #{{ $booking->id }}
                        <a href="{{ route('booking-transactions.edit', $booking) }}" class="btn btn-warning btn-sm float-right">Edit</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
