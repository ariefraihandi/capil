<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemohonInformasi extends Model
{
    use HasFactory;

    protected $table = 'pemohon_informasi';

    protected $fillable = [
        'nama',
        'alamat',        
        'whatsapp',
        'whatsapp_connected',
        'email',
        'jenis_permohonan',
        'jenis_perkara_gugatan',
        'jenis_perkara_permohonan',
        'rincian_informasi',
        'ubah_status',
        'pendidikan',
        'NIK',
        'umur',
        'jenis_kelamin',
        'tujuan_penggunaan'
    ];


}
