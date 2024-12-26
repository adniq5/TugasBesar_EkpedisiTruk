@extends('layouts.app')

@section('content')
    <h1>Edit Programmer</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('programmers.update', $programmer) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="nama">Name</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama', $programmer->nama) }}" required>
        </div>

        <div class="form-group">
            <label for="nim">NIM</label>
            <input type="text" name="nim" class="form-control" value="{{ old('nim', $programmer->nim) }}" required>
        </div>

        <div class="form-group">
            <label for="kelas">Kelas</label>
            <input type="text" name="kelas" class="form-control" value="{{ old('kelas', $programmer->kelas) }}" required>
        </div>

        <div class="form-group">
            <label for="jurusan">Jurusan</label>
            <input type="text" name="jurusan" class="form-control" value="{{ old('jurusan', $programmer->jurusan) }}" required>
        </div>

        <div class="form-group">
            <label for="instansi">Instansi</label>
            <input type="text" name="instansi" class="form-control" value="{{ old('instansi', $programmer->instansi) }}" required>
        </div>

        <div class="form-group">
            <label for="image">Profile Picture</label>
            <input type="file" name="image" class="form-control">
            @if ($programmer->image)
                <img src="{{ asset('storage/' . $programmer->image) }}" alt="Profile Picture" width="100" class="mt-2">
            @else
                <p>No profile picture uploaded.</p>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    <form action="{{ route('programmers.destroy', $programmer) }}" method="POST" style="margin-top: 20px;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this programmer?');">Delete Programmer</button>
    </form>
@endsection
