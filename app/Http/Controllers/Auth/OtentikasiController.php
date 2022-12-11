<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class OtentikasiController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    // melakukan proses register
    public function registerProcess(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:20',
            'email' => 'required|unique:users|max:20',
            'password' => 'required|max:20',
            'phone' => 'max:20',
            'address' => 'required',
        ]);
        // hash password
        $validatedData['password'] = Hash::make($validatedData['password']);
        // simpan data
        User::create($validatedData);

        Session::flash('status','success');
        Session::flash('message', 'Register berhasil, admin akan mengaktifkan akun anda');
        return redirect(route('register'));
    }

    // melakukan proses login
    public function loginProcess(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // login amankan?
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // cek jenis user
            if (Auth::user()->role_id == 1 & Auth::user()->status=="active") {
                return redirect('/dashboard');
            } elseif (Auth::user()->role_id == 2 & Auth::user()->status=="active") {
                return redirect('/profile');
            } else {
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // pesan error
            Session::flash('status','failed');
            Session::flash('message', 'Akun anda belum aktif, hubungi admin di 081212341234');
            return redirect('/');
            }
        }

        // ketika gagal login
        Session::flash('status','failed');
        Session::flash('message', 'Silakan register terlebih dahulu');
        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
