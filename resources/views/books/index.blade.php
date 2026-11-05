@extends('layouts.app')

@section('title', 'Data Buku')
@section('heading', 'Manajemen Data Buku')

@section('content')

<div class="panel">

    <div style="display:flex;justify-content:space-between;align-items:center;gap:15px;margin-bottom:22px;flex-wrap:wrap;">
        <div>
            <h3 style="margin:0 0 5px;">Daftar Koleksi Buku</h3>
            <p style="margin:0;color:#94a3b8;font-size:13px;">
                Informasi seluruh buku yang tersedia.
            </p>
        </div>

        @can('books.create')
            <a href="{{ route('books.create') }}" class="btn-primary">
                + Tambah Buku
            </a>
        @endcan
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th>Kategori</th>
                <th>Tahun</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($books as $index => $book)
                <tr>
                    <td>{{ $books->firstItem() + $index }}</td>

                    <td>
                        <strong>{{ $book->judul }}</strong>
                    </td>

                    <td>{{ $book->penulis }}</td>

                    <td>
                        <span class="badge">{{ $book->kategori }}</span>
                    </td>

                    <td>{{ $book->tahun_terbit }}</td>

                    <td>{{ $book->stok }}</td>

                    <td>
                        <div style="display:flex;gap:7px;flex-wrap:wrap;">

                            <a href="{{ route('books.show', $book) }}"
                               class="btn-secondary">
                                Detail
                            </a>

                            @can('books.edit')
                                <a href="{{ route('books.edit', $book) }}"
                                   class="btn-primary">
                                    Edit
                                </a>
                            @endcan

                            @can('books.delete')
                                <form action="{{ route('books.destroy', $book) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus buku ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn-danger" type="submit">
                                        Hapus
                                    </button>
                                </form>
                            @endcan

                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center;padding:30px;color:#94a3b8;">
                        Belum ada data buku.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination">
        {{ $books->links() }}
    </div>

</div>

@endsection
