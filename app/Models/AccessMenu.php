<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id',
        'menu_id',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
    
    public function accessSubs()
    {
        return $this->hasMany(AccessSub::class, 'role_id', 'role_id');
    }
}
