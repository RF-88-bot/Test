<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book_
{
    public static function all()
    {
        return collect([
            [
                'id' => 1,
                'title' => 'Laskar Pelangi',
                'author' => 'Andrea Hirata',
                'category' => 'Fiction',
                'year' => 2005,
                'publisher' => 'Bentang Pustaka'
            ],
            [
                'id' => 2,
                'title' => 'Filosofi Teras',
                'author' => 'Henry Manampiring',
                'category' => 'Philosophy',
                'year' => 2018,
                'publisher' => 'Kompas'
            ],
            [
                'id' => 3,
                'title' => 'Atomic Habits',
                'author' => 'James Clear',
                'category' => 'Self Improvement',
                'year' => 2018,
                'publisher' => 'Avery'
            ],
            [
                'id' => 4,
                'title' => 'Bumi Manusia',
                'author' => 'Pramoedya Ananta Toer',
                'category' => 'Historical Fiction',
                'year' => 1980,
                'publisher' => 'Hasta Mitra'
            ],
            [
                'id' => 5,
                'title' => 'Sejarah Filsafat Barat',
                'author' => 'Bertrand Russell',
                'category' => 'Philosophy',
                'year' => 1945,
                'publisher' => ' Simon & Schuster'
            ],
            [
                'id' => 6,
                'title' => 'Sejarah Filsafat Timur',
                'author' => 'Laendi',
                'category' => 'Historical Fiction',
                'year' => 2025,
                'publisher' => 'tv one'
            ],
            [
                'id' => 7,
                'title' => 'Sejarah',
                'author' => 'Abdul',
                'category' => 'Self Improvement',
                'year' => 2016,
                'publisher' => 'sctv'
            ]
        ]);
    }

    public static function find($id)
    {
        return static::all()->firstWhere('id', $id);
    }
}
