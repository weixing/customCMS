<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PassportUser extends Model
{
    protected $connection = 'mysql_passport';
    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        '*',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password_hash',
    ];

    protected $primaryKey = 'uid';

    const CREATED_AT = 'createtime';
    const UPDATED_AT = 'updatetime';
}
