@extends('layouts.app')

@section('title', 'Edit Buku')
@section('heading', 'Edit Data Buku')

@section('content')

<div class="panel">

    <h3 style="margin-top:0;">Perbarui Informasi Buku</h3>

    <form action="{{ route('books.update', $book) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Judul Buku</label>
        <input type="text" name="judul" class="form-control"
               value="{{ old('judul', $book->judul) }}" required>

        <label>Nama Penulis</label>
        <input type="text" name="penulis" class="form-control"
               value="{{ old('penulis', $book->penulis) }}" required>

        <label>Penerbit</label>
        <input type="text" name="penerbit" class="form-control"
               value="{{ old('penerbit', $book->penerbit) }}" required>

        <label>Tahun Terbit</label>
        <input type="number" name="tahun_terbit" class="form-control"
               value="{{ old('tahun_terbit', $book->tahun_terbit) }}"
               min="1900" max="{{ date('Y') }}" required>

        <label>Kategori</label>
        <select name="kategori" class="form-control" required>
            @foreach(['Teknologi', 'Pendidikan', 'Novel', 'Sejarah', 'Sains', 'Umum'] as $kategori)
                <option value="{{ $kategori }}"
                    @selected(old('kategori', $book->kategori) == $kategori)>
                    {{ $kategori }}
                </option>
            @endforeach
        </select>

        <label>ISBN</label>
        <input type="text" name="isbn" class="form-control"
               value="{{ old('isbn', $book->isbn) }}">

        <label>Stok Buku</label>
        <input type="number" name="stok" class="form-control"
               value="{{ old('stok', $book->stok) }}" min="0" required>

        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control"
                  rows="5">{{ old('deskripsi', $book->deskripsi) }}</textarea>

        <button type="submit" class="btn-primary">
            Simpan Perubahan
        </button>

        <a href="{{ route('books.index') }}" class="btn-secondary">
            Batal
        </a>

    </form>

</div>

@endsection
