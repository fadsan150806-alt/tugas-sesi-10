@extends('layouts.app')

@section('title', 'Kelola Pengguna')
@section('heading', 'Manajemen Pengguna')

@section('content')

<div class="panel">

    <h3 style="margin-top:0;">Daftar Pengguna</h3>

    <p style="color:#94a3b8;font-size:13px;">
        Admin dapat mengatur role setiap pengguna.
    </p>

    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($users as $index => $user)
                <tr>
                    <td>{{ $users->firstItem() + $index }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>

                    <td>
                        @foreach($user->roles as $role)
                            <span class="badge">{{ $role->name }}</span>
                        @endforeach
                    </td>

                    <td>
                        <a href="{{ route('users.edit', $user) }}"
                           class="btn-primary">
                            Atur Role
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align:center;">
                        Belum ada pengguna.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination">
        {{ $users->links() }}
    </div>

</div>

@endsection
