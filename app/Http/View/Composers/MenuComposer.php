<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Konselor;
use App\Models\JadwalBimbingan;
use App\Models\Pesan;

class MenuComposer
{
    public function compose(View $view)
    {
        $id = Auth::id();
        $id_konselor = Konselor::select('id')->where('id_user', $id)->first();
        $jumlahJadwal = JadwalBimbingan::where('status', '=', 0)->where('id_konselor', $id_konselor->id)->count();
        $pesan = Pesan::where('id_tujuan', $id)->count();
        $view->with([
            'jumlahJadwal' => $jumlahJadwal,
            'pesan' => $pesan
        ]);
    }
}
