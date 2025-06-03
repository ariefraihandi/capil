<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['menu_name', 'route_name', 'order', 'status'];

    // Relasi ke AccessMenu
    public function accessMenus()
    {
        return $this->hasMany(AccessMenu::class, 'menu_id');
    }
}
