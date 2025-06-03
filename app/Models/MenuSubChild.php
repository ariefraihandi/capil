<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuSubChild extends Model
{
    protected $table = 'menu_subs_childs'; // Specify the correct table name
    protected $fillable = ['id_submenu', 'title', 'order', 'url', 'is_active'];

    public function menuSub()
    {
        return $this->belongsTo(MenuSub::class, 'id_submenu');
    }
}
