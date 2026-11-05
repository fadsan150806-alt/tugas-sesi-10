<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                'judul' => 'Pemrograman Web Modern',
                'penulis' => 'Budi Raharjo',
                'penerbit' => 'Informatika',
                'tahun_terbit' => 2024,
                'kategori' => 'Teknologi',
                'isbn' => '9786020000001',
                'stok' => 15,
                'deskripsi' => 'Buku pembelajaran dasar pengembangan aplikasi web.',
            ],
            [
                'judul' => 'Dasar-Dasar Basis Data',
                'penulis' => 'Abdul Kadir',
                'penerbit' => 'Andi Publisher',
                'tahun_terbit' => 2023,
                'kategori' => 'Pendidikan',
                'isbn' => '9786020000002',
                'stok' => 10,
                'deskripsi' => 'Materi dasar pengelolaan dan perancangan basis data.',
            ],
            [
                'judul' => 'Algoritma dan Pemrograman',
                'penulis' => 'Rosa A.S.',
                'penerbit' => 'Informatika',
                'tahun_terbit' => 2022,
                'kategori' => 'Teknologi',
                'isbn' => '9786020000003',
                'stok' => 8,
                'deskripsi' => 'Pengenalan algoritma dan konsep pemrograman.',
            ],
            [
                'judul' => 'Pengantar Sistem Informasi',
                'penulis' => 'Tata Sutabri',
                'penerbit' => 'Andi Publisher',
                'tahun_terbit' => 2024,
                'kategori' => 'Pendidikan',
                'isbn' => '9786020000004',
                'stok' => 12,
                'deskripsi' => 'Pembahasan konsep dasar sistem informasi.',
            ],
            [
                'judul' => 'Belajar Laravel untuk Pemula',
                'penulis' => 'Andi Setiawan',
                'penerbit' => 'Media Informatika',
                'tahun_terbit' => 2025,
                'kategori' => 'Teknologi',
                'isbn' => '9786020000005',
                'stok' => 20,
                'deskripsi' => 'Panduan dasar membangun aplikasi menggunakan Laravel.',
            ],
        ];

        foreach ($books as $book) {
            Book::firstOrCreate(
                ['isbn' => $book['isbn']],
                $book
            );
        }
    }
}
