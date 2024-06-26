<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Konselor;
use App\Models\JadwalBimbingan;
use App\Models\Pesan;
use App\Models\Siswa;

class MenusComposer
{
    public function compose(View $view)
    {
        $id = Auth::id();
        $id_user = Siswa::select('id')->where('id_user', $id)->first();
        $pesan = Pesan::where('id_tujuan', $id)->count();
        $view->with([
            'pesan' => $pesan,
        ]);
    }
}
