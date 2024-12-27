@extends('layouts.app')

@section('content')
    <h1>Trucks</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>License Plate</th>
                <th>Capacity (kg)</th>
                <th>Status</th>
                <th>Driver Name</th>
                <th>Truck Image</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trucks as $truck)
                <tr>
                    <td>{{ $truck->license_plate }}</td>
                    <td>{{ $truck->capacity }}</td>
                    <td>{{ $truck->status }}</td>
                    <td>{{ $truck->driver_name }}</td>
                    <td>
                        @if ($truck->image)
                            <img src="{{ asset('storage/' . $truck->image) }}" alt="Truck Image" width="100" class="img-thumbnail">
                        @else
                            <span>No Image</span>
                        @endif
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
