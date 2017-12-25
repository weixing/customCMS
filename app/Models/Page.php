<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'pages';

    protected $primaryKey = 'pid';

    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['*'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	//protected $hidden = ['password', 'remember_token'];
}
