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
        'id_konselor', 'nilai'
    ];

    public function konselor(): BelongsTo
    {
        return $this->belongsTo(Konselor::class, 'id_konselor');
    }
}
