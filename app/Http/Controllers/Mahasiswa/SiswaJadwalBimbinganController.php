<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\JadwalBimbingan;
use App\Models\Konselor;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaJadwalBimbinganController extends Controller
{
    public function index()
    {
        $jadwalBimbingan = JadwalBimbingan::with('dataUser', 'konselor')->get();

        $data = [
            'title' => 'Halaman Jadwal Bimbingan',
            'jadwalBimbingan' => $jadwalBimbingan,
            'date' => Carbon::now()->toDateString()
        ];
    
        return view('siswa.jadwal-bimbingan.index', $data);
    }

    public function create()
    {
        $konselor = Konselor::select('id', 'nama')->get();
        $data = ['title' => 'Halaman Tambah Jadwal Bimbingan', 'konselor' => $konselor];

        return view('konselor.jadwal-bimbingan.create', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_konselor' => ['required'],
            'tgl_bimbingan' => ['required'],
        ]);

        $user = Siswa::where('id_user', Auth::id())->first();
        $validated['id_data_user'] = $user->id;
        JadwalBimbingan::create($validated);
        return redirect()->route('siswa/jadwal-bimbingan')->with('success', 'berhasil menambahkan jadwal bimbingan');
    }
}
