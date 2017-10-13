<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sign extends Model
{
    //
    protected $fillable = [
        'openid', 'name', 'corporate', 'telephone', 'lottery_flag', 'is_admin',
    ];
}
