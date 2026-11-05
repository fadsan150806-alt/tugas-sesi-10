<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalBooks' => Book::count(),
            'totalUsers' => User::count(),
            'totalAdmins' => User::role('Admin')->count(),
            'totalDosen' => User::role('Dosen')->count(),
            'totalMahasiswa' => User::role('Mahasiswa')->count(),
            'latestBooks' => Book::latest()->take(5)->get(),
        ]);
    }
}
