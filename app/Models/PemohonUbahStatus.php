<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PemohonUbahStatus extends Model
{
    use HasFactory;

    protected $table = 'pemohon_ubahstatus';

    protected $fillable = [
        'id',
        'id_pemohon',
        'cheklist_ubah_status',
        'cheklist_ubah_alamat',
        'url_document',
        'status',
        'catatan',
        'status_awal',
        'status_baru',
        'jalan_awal',
        'jalan_baru',
        'rt_rw_awal',
        'rt_rw_baru',
        'kel_des_awal',
        'kel_des_baru',
        'kec_awal',
        'kec_baru',
        'kab_kota_awal',
        'kab_kota_baru',
        'provinsi_awal',
        'provinsi_baru',
        'id_sign',
    ];

    public $incrementing = false; // UUID tidak auto-increment
    protected $keyType = 'string'; // UUID adalah string

    // Generate UUID secara otomatis
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    // Relasi ke tabel SignsUbahStatus (belongsTo)
    public function sign()
    {
        return $this->belongsTo(SignsUbahStatus::class, 'id_sign', 'id');
    }

    // Relasi dengan PemohonInformasi (belongsTo)
    public function pemohon()
    {
        return $this->belongsTo(PemohonInformasi::class, 'id_pemohon', 'id');
    }
}
