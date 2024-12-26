@extends('layouts.app')

@section('content')
    <h1>Programmers</h1>
    <a href="{{ route('programmers.create') }}" class="btn btn-primary mb-3">Add Programmer</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>NIM</th>
                <th>Kelas</th>
                <th>Jurusan</th>
                <th>Instansi</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($programmers as $programmer)
                <tr>
                    <td>{{ $programmer->nama }}</td>
                    <td>{{ $programmer->nim }}</td>
                    <td>{{ $programmer->kelas }}</td>
                    <td>{{ $programmer->jurusan }}</td>
                    <td>{{ $programmer->instansi }}</td>
                    <td>
                        @if ($programmer->image)
                            <img src="{{ asset('storage/' . $programmer->image) }}" alt="Programmer Image" width="100" class="img-thumbnail">
                        @else
                            <span>No Image</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('programmers.edit', $programmer) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('programmers.destroy', $programmer) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this programmer?');">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
