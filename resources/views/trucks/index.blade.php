@extends('layouts.app')

@section('content')
    <h1>Trucks</h1>
    <a href="{{ route('trucks.create') }}" class="btn btn-primary mb-3">Add Truck</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>License Plate</th>
                <th>Capacity (kg)</th>
                <th>Status</th>
                <th>Driver Name</th>
                <th>Truck Image</th>
                <th>Actions</th>
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
                    <td>
                        <a href="{{ route('trucks.edit', $truck) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('trucks.destroy', $truck) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this truck?');">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
