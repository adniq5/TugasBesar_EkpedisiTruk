@extends('layouts.app')

@section('content')
    <h1>Truck Details</h1>
    <p><strong>License Plate:</strong> {{ $truck->license_plate }}</p>
    <p><strong>Capacity:</strong> {{ $truck->capacity }}</p>
    <p><strong>Status:</strong> {{ $truck->status }}</p>
    <p><strong>Driver Name:</strong> {{ $truck->driver_name }}</p>
    @if ($truck->image)
        <p><strong>Image:</strong></p>
        <img src="{{ asset('storage/' . $truck->image) }}" alt="Image" width="100">
    @endif
    <a href="{{ route('trucks.index') }}" class="btn btn-secondary">Back</a>
@endsection
