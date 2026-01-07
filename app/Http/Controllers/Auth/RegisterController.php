<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class RegisterController extends Controller
{
    // Tampilkan form register
    public function showForm()
    {
        return view('auth.register');
    }

    // Proses register
public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|confirmed|min:6',
    ]);

    // ✅ SIMPAN KE VARIABEL
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // ✅ AUTO LOGIN (INI SEKARANG AMAN)
    Auth::login($user);

    return redirect()->route('dashboard');
}
}


