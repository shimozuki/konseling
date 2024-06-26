<?php

namespace App\Http\Controllers\Konselor;

use App\Http\Controllers\Controller;
use App\Models\JadwalBimbingan;
use App\Models\Konselor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class JadwalBimbinganController extends Controller
{
    public function index()
    {
        $id = Auth::id();

        $id_konselor = Konselor::select('id')->where('id_user', $id)->first();
        $jadwalBimbingan = JadwalBimbingan::with('dataUser', 'konselor')->where('id_konselor', $id_konselor->id)->get();

        $data = [
            'title' => 'Halaman Jadwal Bimbingan',
            'jadwalBimbingan' => $jadwalBimbingan,
            'date' => Carbon::now()->toDateString()
        ];

        return view('konselor.jadwal-bimbingan.index', $data);
    }

   

    

    public function edit(JadwalBimbingan $jadwalBimbingan)
    {
        $data = ['title' => 'Halaman Ubah Kasus', 'jadwalBimbingan' => $jadwalBimbingan];

        return view('konselor.jadwal-bimbingan.edit', $data);
    }

    public function update(JadwalBimbingan $jadwalBimbingan, Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required'],
            'tgl_bimbingan' => ['required'],
        ]);

        $konselor = Konselor::where('id_user', Auth::id())->first();
        $validated['id_konselor'] = $konselor->id;
        $jadwalBimbingan->update($validated);

        return redirect()->route('konselor/jadwal-bimbingan')->with('success', 'berhasil mengubah jadwal bimbingan');
    }


    public function destroy(JadwalBimbingan $jadwalBimbingan)
    {
        $jadwalBimbingan->delete();
        return redirect()->route('konselor/jadwal-bimbingan')->with('success', 'berhasil menghapus kasus siswa');
    }

    public function approve(Request $request, $id)
    {
        // Logika approve jadwal bimbingan
        $jadwal = JadwalBimbingan::findOrFail($id);
        $jadwal->status = 1; // Set status menjadi disetujui
        $jadwal->save();

        return redirect()->back()->with('success', 'Jadwal bimbingan berhasil disetujui.');
    }

    public function finish(Request $request, $id)
    {
        // Logika approve jadwal bimbingan
        $jadwal = JadwalBimbingan::findOrFail($id);
        $jadwal->status = 3; // Set status menjadi disetujui
        $jadwal->save();

        return redirect()->back()->with('success', 'Jadwal bimbingan telah selesai.');
    }

    public function reject(Request $request, $id)
    {
        // Logika reject jadwal bimbingan
        $jadwal = JadwalBimbingan::findOrFail($id);
        $jadwal->status = 2; // Set status menjadi ditolak
        $jadwal->save();

        return redirect()->back()->with('success', 'Jadwal bimbingan berhasil ditolak.');
    }
}
