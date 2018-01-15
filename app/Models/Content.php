<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Services\Helper;

class Content extends Model
{
    protected $table = 'cms_content';
    protected $fillable = [
        'cid', 'title', 'sub_title','category_id', 'status'
    ];
    protected $hidden = [
    ];
    protected $primaryKey = 'cid';

    const CREATED_AT = 'createtime';
    const UPDATED_AT = 'updatetime';
}
