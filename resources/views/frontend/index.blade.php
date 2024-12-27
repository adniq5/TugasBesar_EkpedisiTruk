@extends('layouts.app')

@section('content')
    <h1>Dashboard</h1>
    <div class="row">
        <div class="col-md-4">
            <h2>Programmers</h2>
            <ul class="list-group">
                @foreach ($programmers as $programmer)
                    <li class="list-group-item">
                        {{ $programmer->nama }}
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-4">
            <h2>Customers</h2>
            <ul class="list-group">
                @foreach ($customers as $customer)
                    <li class="list-group-item">
                        {{ $customer->name }}
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-4">
            <h2>Booking Transactions</h2>
            <ul class="list-group">
                @foreach ($bookings as $booking)
                    <li class="list-group-item">
                        Booking #{{ $booking->id }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
