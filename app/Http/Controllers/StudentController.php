<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $mahasiswa = Student::all();
        return view('student', compact('mahasiswa'));
    }

    public function show($nim)
    {
        $mhs = Student::findByNim($nim);

        if (!$mhs) {
            abort(404, 'Mahasiswa tidak ditemukan.');
        }

        return view('detailStudent', compact('mhs'));
    }
}
