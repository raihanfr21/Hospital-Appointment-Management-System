<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'janji_temu';

    protected $fillable = [
        'pasien_id',
        'dokter_id',
        'tanggal',
        'waktu',
        'pembayaran',
        'keluhan',
        'status',
        'riwayat_penyakit',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'pasien_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'dokter_id');
    }
}