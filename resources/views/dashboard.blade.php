@extends('layouts.app')

@section('title', 'Dashboard')
@section('heading', 'Dashboard')

@section('content')

<div style="margin-bottom:25px;">
    <h2 style="font-size:25px;margin:0 0 8px;">
        Selamat Datang, {{ Auth::user()->name }}!
    </h2>

    <p style="color:#64748b;margin:0;">
        Anda login sebagai
        <strong>{{ Auth::user()->getRoleNames()->first() }}</strong>.
        Selamat menggunakan Sistem Manajemen Buku.
    </p>
</div>

<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(190px,1fr));gap:18px;">

    <div class="stat-card">
        <div style="color:#64748b;">Total Buku</div>
        <div class="stat-number">{{ $totalBooks }}</div>
        <div style="font-size:12px;color:#94a3b8;">Koleksi buku terdaftar</div>
    </div>

    @can('users.manage_roles')
        <div class="stat-card">
            <div style="color:#64748b;">Total Pengguna</div>
            <div class="stat-number">{{ $totalUsers }}</div>
            <div style="font-size:12px;color:#94a3b8;">Seluruh akun pengguna</div>
        </div>

        <div class="stat-card">
            <div style="color:#64748b;">Total Dosen</div>
            <div class="stat-number">{{ $totalDosen }}</div>
            <div style="font-size:12px;color:#94a3b8;">Pengguna dengan role Dosen</div>
        </div>

        <div class="stat-card">
            <div style="color:#64748b;">Total Mahasiswa</div>
            <div class="stat-number">{{ $totalMahasiswa }}</div>
            <div style="font-size:12px;color:#94a3b8;">Pengguna dengan role Mahasiswa</div>
        </div>
    @endcan

</div>

<div class="panel" style="margin-top:25px;">

    <h3 style="margin-top:0;">Buku Terbaru</h3>

    <table class="table">
        <thead>
            <tr>
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th>Kategori</th>
                <th>Stok</th>
            </tr>
        </thead>

        <tbody>
            @forelse($latestBooks as $book)
                <tr>
                    <td>{{ $book->judul }}</td>
                    <td>{{ $book->penulis }}</td>
                    <td>{{ $book->kategori }}</td>
                    <td>{{ $book->stok }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align:center;color:#94a3b8;">
                        Belum ada data buku.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection
