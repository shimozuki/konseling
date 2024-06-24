<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaDashboardController extends Controller
{
    public function index()
    {
        $siswa = Siswa::count();
        $data = ['title' => 'Halaman Dashboard', 'siswa' => $siswa];

        return view('siswa.dashboard.index', $data);
    }
}
