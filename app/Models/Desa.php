<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'koordinator'];

    public function kelompok()
    {
        return $this->hasMany(Kelompok::class);
    }
}
