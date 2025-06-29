<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student
{
    public static function all()
    {
        return [
            [
                'nama' => 'Faris',
                'nim' => '22650025',
                'kelas' => 'A',
                'jurusan' => 'Teknik Informatika'
            ],
            [
                'nama' => 'Fatur',
                'nim' => '23650040',
                'kelas' => 'B',
                'jurusan' => 'Teknik Informatika'
            ],
            [
                'nama' => 'Rendi',
                'nim' => '22650037',
                'kelas' => 'A',
                'jurusan' => 'Teknik Pertambangan'
            ],
            [
                'nama' => 'Abdul',
                'nim' => '23650060',
                'kelas' => 'B',
                'jurusan' => 'Teknik Pertambangan'
            ],
            [
                'nama' => 'Marcelo',
                'nim' => '23650066',
                'kelas' => 'B',
                'jurusan' => 'Teknik Mesin'
            ]
        ];
    }

    public static function findByNim($nim)
    {
        foreach (Student::all() as $mhs) {
            if ($mhs['nim'] == $nim) {
                return $mhs;
            }
        }
        return null;
    }
}
