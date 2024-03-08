<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiSiswa extends Model

{
    use HasFactory;

    protected $fillable = [
        'title', 'content', 'slug', 'status'
    ];
}