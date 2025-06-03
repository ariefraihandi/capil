<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuSub extends Model
{
    protected $fillable = ['menu_id', 'title', 'order', 'url', 'icon', 'itemsub', 'is_active'];
    
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
