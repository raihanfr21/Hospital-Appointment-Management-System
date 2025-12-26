<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Authenticatable
{
    use HasFactory;
    protected $table = 'users_dokter'; // Nama tabel yang digunakan

    protected $fillable = [
        'username',
        'password',
        'nama',
        'spesialis_id',
    ];

    // Jika Anda memiliki relasi dengan tabel lain, Anda bisa mendefinisikannya di sini
    public function specialization()
    {
        return $this->belongsTo(Specialization::class, 'spesialis_id');
    }
}