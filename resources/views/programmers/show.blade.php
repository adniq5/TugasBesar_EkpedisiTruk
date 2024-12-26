@extends('layouts.app')

@section('content')
    <h1>Programmer Details</h1>
    <p><strong>Name:</strong> {{ $programmer->nama }}</p>
    <p><strong>NIM:</strong> {{ $programmer->nim }}</p>
    <p><strong>Kelas:</strong> {{ $programmer->kelas }}</p>
    <p><strong>Jurusan:</strong> {{ $programmer->jurusan }}</p>
    <p><strong>Instansi:</strong> {{ $programmer->instansi }}</p>
    @if ($programmer->image)
        <p><strong>Image:</strong></p>
        <img src="{{ asset('storage/' . $programmer->image) }}" alt="Image" width="100">
    @endif
    <a href="{{ route('programmers.index') }}" class="btn btn-secondary">Back</a>
@endsection
