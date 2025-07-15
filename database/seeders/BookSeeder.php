<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\BookCategory;
use App\Models\BookCopy;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::first();

        $data = [
            'Teknologi dan Pemrograman' => [
                [
                    'title' => 'Pemrograman Laravel untuk Pemula',
                    'author' => 'Abdul Kadir',
                    'publisher' => 'Erlangga',
                    'publish_year' => 2022,
                ],
                [
                    'title' => 'Belajar JavaScript Dasar',
                    'author' => 'Dewi Lestari',
                    'publisher' => 'Informatika Bandung',
                    'publish_year' => 2021,
                ]
            ],
            'Bisnis dan Ekonomi' => [
                [
                    'title' => 'Belajar Membuat Startup',
                    'author' => 'Faisal Rahman',
                    'publisher' => 'Gramedia Pustaka Utama',
                    'publish_year' => 2023,
                ],
                [
                    'title' => 'Strategi Bisnis di Era Digital',
                    'author' => 'Rina Santoso',
                    'publisher' => 'Deepublish',
                    'publish_year' => 2020,
                ]
            ],
            'Kuliner' => [
                [
                    'title' => 'Resep Masakan Nusantara',
                    'author' => 'Budi Santoso',
                    'publisher' => 'Media Kuliner',
                    'publish_year' => 2020,
                ],
                [
                    'title' => 'Kue Tradisional dan Modern',
                    'author' => 'Yanti Sukmawati',
                    'publisher' => 'Pustaka Karya',
                    'publish_year' => 2021,
                ]
            ],
            'Kesehatan dan Kebugaran' => [
                [
                    'title' => 'Panduan Hidup Sehat',
                    'author' => 'Dr. Aulia Rahman',
                    'publisher' => 'Kesehatan Nusantara',
                    'publish_year' => 2022,
                ],
                [
                    'title' => 'Detoksifikasi Tubuh Alami',
                    'author' => 'Fitri Lestari',
                    'publisher' => 'Gramedia Pustaka Utama',
                    'publish_year' => 2020,
                ]
            ],
            'Pendidikan dan Referensi' => [
                [
                    'title' => 'Kamus Lengkap Bahasa Indonesia',
                    'author' => 'Pusat Bahasa',
                    'publisher' => 'Balai Pustaka',
                    'publish_year' => 2021,
                ],
                [
                    'title' => 'Panduan Menulis Ilmiah',
                    'author' => 'Dr. Andi Wijaya',
                    'publisher' => 'Deepublish',
                    'publish_year' => 2019,
                ]
            ]
        ];

        foreach ($data as $categoryName => $books) {
            // Check if the category exists, otherwise create it
            $category = BookCategory::firstOrCreate([
                'name' => $categoryName,
                'created_by' => $superAdmin->id
            ]);

            foreach ($books as $book) {
                // Create book entry
                $createdBook = Book::create([
                    'title' => $book['title'],
                    'author' => $book['author'],
                    'publisher' => $book['publisher'],
                    'publish_year' => $book['publish_year'],
                    'category_id' => $category->id,
                    'created_by' => $superAdmin->id
                ]);

                // Create copies for the book
                for ($copy = 1; $copy <= rand(1, 5); $copy++) {
                    BookCopy::create([
                        'code' => $createdBook->id . '-' . $copy,
                        'book_id' => $createdBook->id,
                        'created_by' => $superAdmin->id
                    ]);
                }
            }
        }
    }
}
