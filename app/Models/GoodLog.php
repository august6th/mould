<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodLog extends Model
{
    protected $table = 'goods_log';

    protected $fillable = [
        'user_oid', 'good_id', 'receive',
    ];
}
