@extends('layouts.app')

@section('title', 'Tambah Buku')
@section('heading', 'Tambah Data Buku')

@section('content')

<div class="panel">

    <h3 style="margin-top:0;">Formulir Buku Baru</h3>

    <p style="color:#94a3b8;font-size:13px;">
        Lengkapi informasi buku yang ingin ditambahkan.
    </p>

    <form action="{{ route('books.store') }}" method="POST">
        @csrf

        <label>Judul Buku</label>
        <input type="text" name="judul" class="form-control"
               value="{{ old('judul') }}" required>

        <label>Nama Penulis</label>
        <input type="text" name="penulis" class="form-control"
               value="{{ old('penulis') }}" required>

        <label>Penerbit</label>
        <input type="text" name="penerbit" class="form-control"
               value="{{ old('penerbit') }}" required>

        <label>Tahun Terbit</label>
        <input type="number" name="tahun_terbit" class="form-control"
               value="{{ old('tahun_terbit') }}"
               min="1900" max="{{ date('Y') }}" required>

        <label>Kategori</label>
        <select name="kategori" class="form-control" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach(['Teknologi', 'Pendidikan', 'Novel', 'Sejarah', 'Sains', 'Umum'] as $kategori)
                <option value="{{ $kategori }}"
                    @selected(old('kategori') == $kategori)>
                    {{ $kategori }}
                </option>
            @endforeach
        </select>

        <label>ISBN</label>
        <input type="text" name="isbn" class="form-control"
               value="{{ old('isbn') }}">

        <label>Stok Buku</label>
        <input type="number" name="stok" class="form-control"
               value="{{ old('stok', 0) }}" min="0" required>

        <label>Deskripsi Buku</label>
        <textarea name="deskripsi" class="form-control"
                  rows="5">{{ old('deskripsi') }}</textarea>

        <div style="display:flex;gap:10px;">
            <button type="submit" class="btn-primary">
                Simpan Buku
            </button>

            <a href="{{ route('books.index') }}" class="btn-secondary">
                Kembali
            </a>
        </div>

    </form>

</div>

@endsection
