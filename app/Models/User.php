<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email', 
        'whatsapp', 
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function detail()
    {
        return $this->hasOne(UserDetail::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role', 'name');
    }

    public function scopeAdmin($query)
    {
        // Ambil ID role berdasarkan nama 'administrasi'
        $adminRoleId = Role::where('name', 'administrasi')->value('id');

        if ($adminRoleId) {
            return $query->where('role', $adminRoleId);
        }

        return $query;
    }

    public function scopeKepegawaian($query)
    {
        $kepegawaianRoleId = Role::where('name', 'kepegawaian')->value('id');

        if ($kepegawaianRoleId) {
            return $query->where('role', $kepegawaianRoleId);
        }

        return $query;
    }


    public function devices()
    {
        return $this->hasMany(UserDevice::class);
    }
}
