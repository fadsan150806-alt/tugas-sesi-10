@extends('layouts.app')

@section('title', 'Atur Role')
@section('heading', 'Pengaturan Hak Akses')

@section('content')

<div class="panel">

    <h3 style="margin-top:0;">Ubah Role Pengguna</h3>

    <p style="color:#64748b;">
        Pengguna: <strong>{{ $user->name }}</strong>
    </p>

    <p style="color:#64748b;">
        Email: {{ $user->email }}
    </p>

    <form action="{{ route('users.updateRole', $user) }}" method="POST">

        @csrf
        @method('PUT')

        <label>Pilih Role</label>

        <select name="role" class="form-control" required>

            @foreach($roles as $role)
                <option value="{{ $role->name }}"
                    @selected($user->hasRole($role->name))>
                    {{ $role->name }}
                </option>
            @endforeach

        </select>

        <button type="submit" class="btn-primary">
            Simpan Role
        </button>

        <a href="{{ route('users.index') }}" class="btn-secondary">
            Kembali
        </a>

    </form>

</div>

@endsection
