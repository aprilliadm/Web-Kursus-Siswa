<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';

    protected $fillable = [
        'username',
        'name',
        'email',
        'foto',
        'hapus',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function kelasSiswa()
    {
        return $this->hasMany(KelasSiswa::class, 'id_siswa');
    }
}
