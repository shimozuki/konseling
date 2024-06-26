<?php

namespace App\Http\Controllers;

use App\Models\JadwalBimbingan;
use Illuminate\Http\Request;
use App\Models\Nilai; // Sesuaikan dengan namespace model Nilai

class NilaiController extends Controller
{
    public function store(Request $request)
    {
        // Validasi request jika diperlukan
        $validatedData = $request->validate([
            'konselor_id' => 'required|integer',
            'nilai' => 'required|integer',
            'jadwal_id' => 'required|integer',
        ]);

        $jadwal = JadwalBimbingan::findOrFail($request->jadwal_id);
        $jadwal->status = 4; // Set status menjadi disetujui
        $jadwal->save();
        // Simpan nilai ke dalam tabel Nilai
        $nilai = new Nilai();
        $nilai->id_konselor = $request->konselor_id;
        $nilai->nilai = $request->nilai;
        $nilai->id_jadwal = $request->jadwal_id;
        $nilai->save();

        // Response success (optional)
        return response()->json(['message' => 'Nilai konselor berhasil disimpan.']);
    }
}
