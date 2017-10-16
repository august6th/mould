<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    protected $fillable = [
        'gname', 'gimg', 'con_point', 'dstock', 'gstock', 'probability',
    ];
}
