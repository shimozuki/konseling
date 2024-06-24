<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::get();

        $data = ['title' => 'Halaman User', 'siswa' => $siswa];

        return view('admin.user.index', $data);
    }

    public function create()
    {
        $data = ['title' => 'Halaman Tambah Siswa'];

        return view('admin.user.create', $data);
    }

    public function store(Request $request)
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

        // insert username & password table user
        $validatedUser = ['username' => $validated['username'], 'password' => $validated['password'], 'level' => 2];
        $user = User::create($validatedUser);

        $validatedSiswa = $request->except(['username', 'password']);
        $validatedSiswa['id_user'] =  $user->id;
        Siswa::create($validatedSiswa);

        return redirect()->route('admin/siswa')->with('success', 'berhasil menambahkan siswa');
    }

    public function edit(Siswa $siswa)
    {

        $data = ['title' => 'Halaman Ubah Siswa', 'siswa' => Siswa::with('user')->find($siswa)->first()];

        return view('admin.user.edit', $data);
    }

    public function update(Siswa $siswa, Request $request)
    {
        $validated = $request->validate([
            'nisn' => ['required', Rule::unique('tbl_siswa')->ignore($siswa->id)],
            'kelas' => ['required'],
            'nama' => ['required'],
            'alamat' => ['required'],
            'tgl_lahir' => ['required'],
            'jenis_kelamin' => ['required'],
        ]);
        $validated['id_kelas'] = $request->input('kelas');
        $siswa->update($validated);
        return redirect()->route('admin/siswa')->with('success', 'berhasil mengubah siswa');
    }


    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return redirect()->route('admin/siswa')->with('success', 'berhasil menghapus siswa');
    }
}
