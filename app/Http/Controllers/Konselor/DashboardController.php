<?php

namespace App\Http\Controllers\Konselor;

use App\Http\Controllers\Controller;
use App\Models\Konselor;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $id = Auth::id();

        $id_konselor = Konselor::select('nama')->where('id_user', $id)->first();
        $siswa = Siswa::count();
        $data = ['title' => 'Halaman Dashboard', 'siswa' => $siswa, 'nama' => $id_konselor->nama];

        return view('konselor.dashboard.index', $data);
    }
}
