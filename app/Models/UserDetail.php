<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'image',
        'jabatan',
        'nip',
        'whatsapp',
        'tlahir',
        'tglahir',
        'kelamin',
        'alamat',
        'instansi',
        'awal_kerja',
        'iguser',
        'fbuser',
        'twuser',
        'ttuser',
        'lastmodified',
        'posisi',
        'key',
    ];

    protected $table = 'users_detail'; // pastikan nama tabel sesuai

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'instansi', 'id');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan', 'name');
    }

    public function cutiSisa()
    {
        return $this->hasOne(CutiSisa::class, 'user_id', 'user_id');
    }

    public function atasans()
    {
        return $this->hasMany(Atasan::class, 'atasan_id', 'user_id');
    }

    // Relasi ke Atasan dimana user adalah atasan kedua (jika diperlukan)
    public function atasansDua()
    {
        return $this->hasMany(Atasan::class, 'atasan_dua_id', 'user_id');
    }

}