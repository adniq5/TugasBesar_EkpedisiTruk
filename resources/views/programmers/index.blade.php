@extends('layouts.app')

@section('content')
    <h1>Programmers</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>NIM</th>
                <th>Kelas</th>
                <th>Jurusan</th>
                <th>Instansi</th>
                <th>Image</th>
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
                    
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
