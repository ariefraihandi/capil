<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SignsUbahStatus extends Model
{
    use HasFactory;

    protected $table = 'signs_ubahstatus';

    protected $fillable = [
        'id', // UUID
        'pemohon_id', // Foreign key to pemohon
        'message', // Pesan
    ];

    public $incrementing = false; // UUID tidak auto-increment
    protected $keyType = 'string'; // UUID adalah string

    // Generate UUID secara otomatis ketika membuat record baru
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    // Relasi ke tabel PemohonUbahStatus (hasMany)
    public function pemohonUbahStatuses()
    {
        return $this->hasMany(PemohonUbahStatus::class, 'id_sign', 'id');
    }
}
