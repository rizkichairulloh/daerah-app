<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'desa_id',
        'koordinator',
    ];

    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }
}
