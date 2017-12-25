<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Services\Helper;

class Auth extends Model
{
    protected $table = 'admin_auth';
    protected $fillable = [
        '*',
    ];
    protected $hidden = [
    ];
    protected $primaryKey = 'aid';

    const CREATED_AT = 'createtime';
    const UPDATED_AT = 'updatetime';

    /**
     * 根据权限id列表，获取所有权限信息
     * @param str $aidStr 权限id列表，用","隔开
     * @Return array auth列表
     */
    public static function getListByIdStr($aidStr)
    {
        $aidStr = Helper::FormatIntArrayStr($aidStr);
        $authList = Auth::find($aidStr);
        return $authList;
    }
}
