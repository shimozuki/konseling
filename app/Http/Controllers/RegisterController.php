<?php
// RegisterController.php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $title = "Register";
        return view('auth.register', compact('title'));
    }

    public function processRegistration(Request $request)
    {
        $validated = $request->validate([
            'nik' => ['required', 'unique:tbl_data_user'],
            'nama' => ['required'],
            'alamat' => ['required'],
            'tgl_lahir' => ['required'],
            'jenis_kelamin' => ['required'],
            'username' => ['required', 'lowercase', 'unique:tbl_user', 'string'],
            'password' => ['required'],
        ]);

        // Insert username & password into the user table
        $user = User::create([
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'level' => 2,
        ]);

        // Insert other validated data into the Siswa table
        $siswa = new Siswa();
        $siswa->nik = $validated['nik'];
        $siswa->nama = $validated['nama'];
        $siswa->alamat = $validated['alamat'];
        $siswa->tgl_lahir = $validated['tgl_lahir'];
        $siswa->jenis_kelamin = $validated['jenis_kelamin'];
        $siswa->id_user = $user->id;
        $siswa->save();

        // Redirect to a success page or dashboard
        return redirect()->route('auth/login')->with('success', 'Registrasi berhasil!');
    }
}

