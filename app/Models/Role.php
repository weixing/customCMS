<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Services\Helper;

class Role extends Model
{
    protected $table = 'admin_role';
    protected $fillable = [
        'rid', 'name', 'aids',
    ];
    protected $hidden = [
    ];
    protected $primaryKey = 'rid';

    const CREATED_AT = 'createtime';
    const UPDATED_AT = 'updatetime';

    /**
     * 根据role id获取管理员角色
     * @param int $roleId 角色id
     * @return Role 角色实例
     */
    public static function getById($roleId)
    {
        $roleId = intval($roleId);
        $role = Role::where('rid', '=', $roleId)->first();
        return $role;
    }

    public static function getRoleList()
    {
        //获取角色信息，并生成数组
        $roleListPri = Role::where('status', '=', 1)
            ->get();
        $roleList = [];
        foreach ($roleListPri as $role) {
            $roleList[$role->rid] = $role;
        }

        return $roleList;
    }

}
