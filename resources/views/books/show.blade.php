@extends('layouts.app')

@section('title', 'Detail Buku')
@section('heading', 'Detail Informasi Buku')

@section('content')

<div class="panel">

    <div style="margin-bottom:25px;">
        <span class="badge">{{ $book->kategori }}</span>

        <h2 style="margin:12px 0 5px;font-size:27px;">
            {{ $book->judul }}
        </h2>

        <p style="color:#64748b;">
            Informasi lengkap koleksi buku.
        </p>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:20px;">

        <div>
            <small style="color:#94a3b8;">Penulis</small>
            <h4>{{ $book->penulis }}</h4>
        </div>

        <div>
            <small style="color:#94a3b8;">Penerbit</small>
            <h4>{{ $book->penerbit }}</h4>
        </div>

        <div>
            <small style="color:#94a3b8;">Tahun Terbit</small>
            <h4>{{ $book->tahun_terbit }}</h4>
        </div>

        <div>
            <small style="color:#94a3b8;">ISBN</small>
            <h4>{{ $book->isbn ?? '-' }}</h4>
        </div>

        <div>
            <small style="color:#94a3b8;">Stok Buku</small>
            <h4>{{ $book->stok }} Buku</h4>
        </div>

    </div>

    <hr style="border:0;border-top:1px solid #edf0f4;margin:20px 0;">

    <h3>Deskripsi</h3>

    <p style="color:#64748b;line-height:1.8;">
        {{ $book->deskripsi ?: 'Tidak ada deskripsi untuk buku ini.' }}
    </p>

    <a href="{{ route('books.index') }}" class="btn-secondary">
        Kembali ke Daftar Buku
    </a>

    @can('books.edit')
        <a href="{{ route('books.edit', $book) }}" class="btn-primary">
            Edit Buku
        </a>
    @endcan

</div>

@endsection
