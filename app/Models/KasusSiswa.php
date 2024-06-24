<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class KasusSiswa extends Model
{
    use HasFactory;

    protected $table = 'tbl_kasus_user';

    protected $guarded = ['id'];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'id_data_user');
    }

    public function kasus(): BelongsTo
    {
        return $this->belongsTo(Kasus::class, 'id_kasus');
    }
}
