<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessSub extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id',
        'submenu_id',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function menuSub()
    {
        return $this->belongsTo(MenuSub::class, 'submenu_id');
    }

    public function accessSubChildren()
    {
        return $this->hasMany(AccessSubChild::class, 'role_id', 'role_id');
    }
}
