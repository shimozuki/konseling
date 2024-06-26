<?php

namespace App\Http\Controllers;

use App\Models\JadwalBimbingan;
use App\Models\Konselor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class notificationController extends Controller
{
    public function index()
    {
        $id = Auth::id();

        $id_konselor = Konselor::select('id')->where('id_user', $id)->first();
        $jumlahJadwal = $jumlahJadwal = JadwalBimbingan::where('status', '=', 0)
            ->where('id_konselor', $id_konselor->id)
            ->count();

        return view('layouts.partials.menu.konselor', compact('jumlahJadwal'));
    }
}
