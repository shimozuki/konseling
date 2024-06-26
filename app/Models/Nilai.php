<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Nilai extends Model
{
    use HasFactory;
    protected $table = 'nilai'; // Adjust table name if different
    protected $fillable = [
        'id_konselor', 'nilai', 'id_jadwal'
    ];

    public function konselor(): BelongsTo
    {
        return $this->belongsTo(Konselor::class, 'id_konselor');
    }

    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(JadwalBimbingan::class, 'id_jadwal');
    }
}
