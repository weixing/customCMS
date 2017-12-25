<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Services\Helper;

class Site extends Model
{
    protected $table = 'cms_site';
    protected $fillable = [
        'sid', 'name', 'path','domain', 'status'
    ];
    protected $hidden = [
    ];
    protected $primaryKey = 'sid';

    const CREATED_AT = 'createtime';
    const UPDATED_AT = 'updatetime';

    /**
     * 获取所有数据，并拼凑成数组以供使用
     */
    public static function getSiteList()
    {
        //获取角色信息，并生成数组
        $siteListPri = Site::where('status', '=', 1)
            ->get();
        $siteList = [];
        foreach ($siteListPri as $site) {
            $siteList[$site->sid] = $site;
        }

        return $siteList;
    }
}
