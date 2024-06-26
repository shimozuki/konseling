<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Konselor\DashboardController as KonselorDashboardController;
use App\Http\Controllers\Konselor\JadwalBimbinganController;
use App\Http\Controllers\Konselor\KasusController;
use App\Http\Controllers\Konselor\KasusSiswaController;
use App\Http\Controllers\Konselor\KomentarPesanController;
use App\Http\Controllers\Konselor\PesanController;
use App\Http\Controllers\KonselorController;
use App\Http\Controllers\Mahasiswa\SiswaJadwalBimbinganController;
use App\Http\Controllers\Mahasiswa\SiswaKomentarPesanController;
use App\Http\Controllers\Mahasiswa\SiswaDashboardController;
use App\Http\Controllers\Mahasiswa\SiswaKasusSiswaController;
use App\Http\Controllers\Mahasiswa\SiswaPesanController;
use App\Http\Controllers\Siswa\PesertaBimbinganController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'processRegistration'])->name('register.process');
Route::controller(LoginController::class)->group(function () {
    Route::get('/', 'index')->name('auth/login');
    Route::post('/', 'authenticate')->name('auth/authenticate');
});

Route::get('logout', [LogoutController::class, 'logout'])->name('auth/logout');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin/dashboard');

    Route::controller(SiswaController::class)->group(function () {
        Route::get('siswa', 'index')->name('admin/siswa');

        Route::get('siswa/tambah', 'create')->name('admin/siswa/tambah');
        Route::post('siswa/simpan', 'store')->name('admin/siswa/simpan');

        Route::get('siswa/ubah/{siswa}', 'edit')->name('admin/siswa/ubah');
        Route::patch('siswa/perbarui/{siswa}', 'update')->name('admin/siswa/perbarui');

        Route::delete('siswa/hapus/{siswa}', 'destroy')->name('admin/siswa/hapus');
    });

    Route::controller(KonselorController::class)->group(function () {
        Route::get('konselor', 'index')->name('admin/konselor');
        Route::get('admin/konselor/history/{id}', 'showKonselorHistory')->name('admin.konselor.history');
        Route::get('konselor/tambah', 'create')->name('admin/konselor/tambah');
        Route::post('konselor/simpan', 'store')->name('admin/konselor/simpan');

        Route::get('konselor/ubah/{konselor}/{user}', 'edit')->name('admin/konselor/ubah');
        Route::patch('konselor/perbarui/{konselor}', 'update')->name('admin/konselor/perbarui');

        Route::delete('konselor/hapus/{konselor}', 'destroy')->name('admin/konselor/hapus');
    });
});

Route::group(['prefix' => 'konselor', 'middleware' => ['auth', 'konselor']], function () {
    Route::controller(KonselorDashboardController::class)->group(function () {
        Route::get('dashboard', 'index')->name('konselor/dashboard');
    });

    Route::controller(KasusController::class)->group(function () {
        Route::get('kasus', 'index')->name('konselor/kasus');

        Route::get('kasus/tambah', 'create')->name('konselor/kasus/tambah');
        Route::post('kasus/simpan', 'store')->name('konselor/kasus/simpan');

        Route::get('kasus/ubah/{kasus}', 'edit')->name('konselor/kasus/ubah');
        Route::patch('kasus/perbarui/{kasus}', 'update')->name('konselor/kasus/perbarui');

        Route::delete('kasus/hapus/{kasus}', 'destroy')->name('konselor/kasus/hapus');
    });

    Route::controller(KasusSiswaController::class)->group(function () {
        Route::get('kasus-siswa', 'index')->name('konselor/kasus-siswa');

        Route::get('kasus-siswa/tambah', 'create')->name('konselor/kasus-siswa/tambah');
        Route::post('kasus-siswa/simpan', 'store')->name('konselor/kasus-siswa/simpan');

        Route::get('kasus-siswa/ubah/{kasusSiswa}', 'edit')->name('konselor/kasus-siswa/ubah');
        Route::patch('kasus-siswa/perbarui/{kasusSiswa}', 'update')->name('konselor/kasus-siswa/perbarui');

        Route::delete('kasus-siswa/hapus/{kasusSiswa}', 'destroy')->name('konselor/kasus-siswa/hapus');
    });

    Route::controller(JadwalBimbinganController::class)->group(function () {
        Route::get('jadwal-bimbingan', 'index')->name('konselor/jadwal-bimbingan');

        Route::get('jadwal-bimbingan/tambah', 'create')->name('konselor/jadwal-bimbingan/tambah');
        Route::post('jadwal-bimbingan/simpan', 'store')->name('konselor/jadwal-bimbingan/simpan');

        Route::get('jadwal-bimbingan/ubah/{jadwalBimbingan}', 'edit')->name('konselor/jadwal-bimbingan/ubah');
        Route::patch('jadwal-bimbingan/perbarui/{jadwalBimbingan}', 'update')->name('konselor/jadwal-bimbingan/perbarui');
        Route::post('/jadwal-bimbingan/approve/{id}', 'approve')->name('jadwal-bimbingan.approve');
        Route::post('/jadwal-bimbingan/finish/{id}', 'finish')->name('jadwal-bimbingan.finish');
        Route::post('/jadwal-bimbingan/reject/{id}', 'reject')->name('jadwal-bimbingan.reject');
        Route::delete('jadwal-bimbingan/hapus/{jadwalBimbingan}', 'destroy')->name('konselor/jadwal-bimbingan/hapus');
    });

    Route::controller(PesanController::class)->group(function () {
        Route::get('pesan-masuk', 'pesan_masuk')->name('konselor/pesan-masuk');

        Route::get('pesan-keluar', 'pesan_keluar')->name('konselor/pesan-keluar');

        Route::get('pesan-keluar/tambah', 'pesan_keluar_create')->name('konselor/pesan-keluar/tambah');
        Route::post('pesan-keluar/simpan', 'pesan_keluar_store')->name('konselor/pesan-keluar/simpan');
    });

    Route::controller(KomentarPesanController::class)->group(function () {
        Route::get('komentar-pesan/{pesan}', 'pesan')->name('konselor/komentar-pesan');

        Route::post('komentar-pesan/{pesan}', 'pesan_store')->name('konselor/komentar-pesan/simpan');
    });
});

Route::post('/simpan-nilai', 'App\Http\Controllers\NilaiController@store')->name('simpan.nilai');

Route::group(['prefix' => 'siswa', 'middleware' => ['auth', 'siswa']], function () {
    Route::controller(SiswaDashboardController::class)->group(function () {
        Route::get('dashboard', 'index')->name('siswa/dashboard');
    });

    Route::controller(SiswaKasusSiswaController::class)->group(function () {
        Route::get('kasus-siswa', 'index')->name('siswa/kasus-siswa');
    });

    Route::controller(SiswaJadwalBimbinganController::class)->group(function () {
        Route::get('jadwal-bimbingan', 'index')->name('siswa/jadwal-bimbingan');

        Route::get('jadwal-bimbingan/tambah', 'create')->name('konselor/jadwal-bimbingan/tambah');
        Route::post('jadwal-bimbingan/simpan', 'store')->name('konselor/jadwal-bimbingan/simpan');
    });



    Route::controller(PesertaBimbinganController::class)->group(function () {
        Route::post('peserta-bimbingan', 'store')->name('siswa/peserta-bimbingan/simpan');
    });

    Route::controller(SiswaPesanController::class)->group(function () {
        Route::get('pesan-masuk', 'pesan_masuk')->name('siswa/pesan-masuk');

        Route::get('pesan-keluar', 'pesan_keluar')->name('siswa/pesan-keluar');

        Route::get('pesan-keluar/tambah', 'pesan_keluar_create')->name('siswa/pesan-keluar/tambah');
        Route::post('pesan-keluar/simpan', 'pesan_keluar_store')->name('siswa/pesan-keluar/simpan');
    });

    Route::controller(SiswaKomentarPesanController::class)->group(function () {
        Route::get('komentar-pesan/{pesan}', 'pesan')->name('siswa/komentar-pesan');

        Route::post('komentar-pesan/{pesan}', 'pesan_store')->name('siswa/komentar-pesan/simpan');
    });
});
