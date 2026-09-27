@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')
    <p><a href="{{ route('categories.index') }}">&larr; Kembali ke daftar kategori</a></p>

    <h1>Edit Kategori</h1>

    <form action="{{ route('categories.update', $category['id']) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama_kategori">Nama Kategori</label>
            <input type="text" name="nama_kategori" id="nama_kategori" value="{{ old('nama_kategori', $category['nama_kategori']) }}">
            @error('nama_kategori')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi (opsional)</label>
            <textarea name="deskripsi" id="deskripsi" rows="4">{{ old('deskripsi', $category['deskripsi']) }}</textarea>
            @error('deskripsi')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn">Perbarui</button>
    </form>
@endsection