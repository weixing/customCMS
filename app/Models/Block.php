<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Services\Helper;

class Block extends Model
{
    protected $table = 'cms_block';
    protected $fillable = [
        'bid', 'name', 'status'
    ];
    protected $hidden = [
    ];
    protected $primaryKey = 'bid';

    const CREATED_AT = 'createtime';
    const UPDATED_AT = 'updatetime';
}
