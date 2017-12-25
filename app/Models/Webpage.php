<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Services\Helper;

class Webpage extends Model
{
    protected $table = 'cms_webpage';
    protected $fillable = [
        'wpid', 'name', 'status'
    ];
    protected $hidden = [
    ];
    protected $primaryKey = 'wpid';

    const CREATED_AT = 'createtime';
    const UPDATED_AT = 'updatetime';
}
