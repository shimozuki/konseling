<?php

namespace App\Models;

use App\Models\Siswa\PesertaBimbingan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JadwalBimbingan extends Model
{
    use HasFactory;

    protected $table = 'tbl_jadwal_bimbingan';

    protected $guarded = ['id'];

    public function dataUser(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'id_data_user');
    }

    public function konselor(): BelongsTo
    {
        return $this->belongsTo(Konselor::class, 'id_konselor');
    }

    public function nilai(): BelongsTo
    {
        return $this->belongsTo(Nilai::class, 'id');
    }
}
