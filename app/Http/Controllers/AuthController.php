<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function index()
    {
        //untuk mengarahkan ke halaman login
        if (Auth::check()) {
            $user = Auth::user();
            return match ($user->role) {
                'admin' => redirect()->route('admin.books'),
                'user'  => redirect()->route('user.dashboard'),
                default => abort(403, 'Role tidak dikenali.'),
            };
        }
        return view('auth.login');
    }
    public function register()
    {
        //untuk mengarahkan ke halaman Register
        if (Auth::check()) {
            $user = Auth::user();
            return match ($user->role) {
                'admin' => redirect()->route('admin.books'),
                'user'  => redirect()->route('user.dashboard'),
                default => abort(403, 'Role tidak dikenali.'),
            };
        }
        return view('auth.registrasi');
    }
    public function RegisterPost(Request $request)
    {
        $validatedData = $request->validate([

            //validasi
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ], [

            //Pesan yang dikembalikan ketika terjadi kesalahan pada validasi
            'email.required' => 'Username wajib diisi.',
            'email.email' => 'Email Tidak Valid',
            'password.required' => 'Password wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password minimal 6 karakter.',
            'password_confirmation.required' => 'Konfirmasi password harus diisi.'
        ]);

        // Simpan data ke database
        User::create([
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        return redirect('/')->with('success', 'Pendaftaran berhasil!');
    }
    public function login(Request $request)
    {
        $rules = [
            'email' => 'required',
            'password' => 'required|string',
        ];

        $messages = [
            'email.required' => 'email harus diisi.',
            'password.required' => 'Password harus diisi.',
        ];

        $validateUser = $request->validate($rules, $messages);

        if (Auth::attempt($validateUser)) {
            $request->session()->regenerate();

            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.books');
            } elseif ($user->role === 'user') {
                return redirect()->intended('/books');
            }
        }
        // Jika login gagal
        return back()->withErrors([
            'login' => 'Username atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }
}
