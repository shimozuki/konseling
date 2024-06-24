<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'tbl_data_user';

    protected $guarded = ['id'];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
