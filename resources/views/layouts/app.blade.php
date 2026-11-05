<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Manajemen Buku</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            margin: 0;
            font-family: 'Instrument Sans', Arial, sans-serif;
            background: #f4f6fa;
            color: #1e293b;
        }

        .sidebar {
            width: 255px;
            min-height: 100vh;
            background: #14213d;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            padding: 26px 18px;
            z-index: 10;
        }

        .brand {
            font-size: 21px;
            font-weight: 800;
            margin-bottom: 38px;
            padding: 0 12px;
        }

        .menu-label {
            font-size: 11px;
            color: #94a3b8;
            margin: 22px 12px 10px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .menu-link {
            display: flex;
            padding: 12px 14px;
            border-radius: 9px;
            margin-bottom: 6px;
            color: #cbd5e1;
            text-decoration: none;
            font-size: 14px;
            transition: .2s;
        }

        .menu-link:hover,
        .menu-link.active {
            background: #263a5d;
            color: white;
        }

        .main {
            margin-left: 255px;
            padding: 30px 35px;
        }

        .topbar {
            background: white;
            border-radius: 14px;
            padding: 18px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
            box-shadow: 0 2px 12px rgba(0,0,0,.03);
        }

        .panel {
            background: white;
            padding: 24px;
            border-radius: 14px;
            box-shadow: 0 3px 15px rgba(0,0,0,.035);
            margin-bottom: 22px;
        }

        .stat-card {
            background: white;
            border-radius: 14px;
            padding: 22px;
            box-shadow: 0 3px 15px rgba(0,0,0,.035);
        }

        .stat-number {
            font-size: 29px;
            font-weight: 800;
            margin-top: 12px;
        }

        .btn-primary {
            display: inline-block;
            background: #2563eb;
            color: white;
            padding: 10px 17px;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .btn-secondary {
            display: inline-block;
            background: #e2e8f0;
            color: #334155;
            padding: 9px 15px;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .btn-danger {
            background: #dc2626;
            color: white;
            padding: 9px 14px;
            border: none;
            border-radius: 7px;
            cursor: pointer;
        }

        .form-control {
            width: 100%;
            padding: 11px 13px;
            border: 1px solid #dbe2ea;
            border-radius: 8px;
            margin-top: 7px;
            margin-bottom: 17px;
            box-sizing: border-box;
        }

        .form-control:focus {
            outline: 2px solid #bfdbfe;
            border-color: #2563eb;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th {
            background: #f8fafc;
            color: #64748b;
            font-size: 12px;
            text-align: left;
            text-transform: uppercase;
        }

        .table th,
        .table td {
            padding: 15px 12px;
            border-bottom: 1px solid #edf0f4;
        }

        .table td {
            font-size: 14px;
        }

        .badge {
            display: inline-block;
            background: #dbeafe;
            color: #1d4ed8;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
        }

        .alert-success {
            padding: 13px 16px;
            background: #dcfce7;
            color: #166534;
            border-radius: 9px;
            margin-bottom: 20px;
        }

        .alert-error {
            padding: 13px 16px;
            background: #fee2e2;
            color: #991b1b;
            border-radius: 9px;
            margin-bottom: 20px;
        }

        .pagination {
            margin-top: 20px;
        }

        @media(max-width: 800px) {
            .sidebar {
                position: relative;
                width: auto;
                min-height: auto;
            }

            .main {
                margin-left: 0;
                padding: 18px;
            }

            .topbar {
                flex-wrap: wrap;
                gap: 12px;
            }

            .panel {
                overflow-x: auto;
            }
        }
    </style>
</head>

<body>

<aside class="sidebar">

    <div class="brand">
        📚 BookManager
    </div>

    <div class="menu-label">Menu Utama</div>

    <a href="{{ route('dashboard') }}"
       class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        ▦ &nbsp; Dashboard
    </a>

    @can('books.view')
        <a href="{{ route('books.index') }}"
           class="menu-link {{ request()->routeIs('books.*') ? 'active' : '' }}">
            ▤ &nbsp; Data Buku
        </a>
    @endcan

    @can('users.manage_roles')
        <div class="menu-label">Manajemen</div>

        <a href="{{ route('users.index') }}"
           class="menu-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
            ♙ &nbsp; Kelola Pengguna
        </a>
    @endcan

    <div class="menu-label">Akun</div>

    <div style="padding:12px;color:#cbd5e1;font-size:13px;">
        {{ Auth::user()->name }}<br>
        <span style="color:#94a3b8;">
            {{ Auth::user()->getRoleNames()->first() ?? 'Belum memiliki role' }}
        </span>
    </div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit"
            class="menu-link"
            style="width:100%;background:transparent;border:0;cursor:pointer;text-align:left;">
            ↪ &nbsp; Logout
        </button>
    </form>

</aside>

<main class="main">

    <div class="topbar">
        <div>
            <h2 style="margin:0;font-size:20px;">
                @yield('heading', 'Dashboard')
            </h2>
            <p style="margin:5px 0 0;color:#94a3b8;font-size:13px;">
                Sistem Informasi Manajemen Buku
            </p>
        </div>

        <div style="font-size:14px;color:#475569;">
            {{ Auth::user()->name }}
        </div>
    </div>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert-error">
            <ul style="margin:0;padding-left:20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')

</main>

</body>
</html>
