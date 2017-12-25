<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Services\Helper;

class Category extends Model
{
    protected $table = 'cms_category';
    protected $fillable = [
        'cid', 'name', 'status'
    ];
    protected $hidden = [
    ];
    protected $primaryKey = 'cid';

    const CREATED_AT = 'createtime';
    const UPDATED_AT = 'updatetime';

    /**
     * 获取所有数据，并拼凑成数组以供使用
     */
    public static function getCategoryList()
    {
        //获取角色信息，并生成数组
        $categoryListPri = Category::where('status', '=', 1)
            ->get();
        $categoryList = [];
        foreach ($categoryListPri as $category) {
            $categoryList[$category->cid] = $category;
        }

        return $categoryList;
    }
}
