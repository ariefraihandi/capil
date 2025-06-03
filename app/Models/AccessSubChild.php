<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessSubChild extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id',
        'childsubmenu_id',
    ];

    protected $table = 'access_sub_childs';

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function menuSubChild()
    {
        return $this->belongsTo(MenuSubChild::class, 'childsubmenu_id');
    }
}
