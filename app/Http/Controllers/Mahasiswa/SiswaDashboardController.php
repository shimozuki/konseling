<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaDashboardController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        $id_user = Siswa::select('nama')->where('id_user', $id)->first();
        $siswa = Siswa::count();
        $data = ['title' => 'Halaman Dashboard', 'siswa' => $siswa, 'nama' => $id_user->nama];

        return view('siswa.dashboard.index', $data);
    }
}
