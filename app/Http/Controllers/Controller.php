<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Validator;
use Request;
use Session;
use View;

use App\Models\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $validateMsg = '';

    public function __construct()
    {
        $authTree = $this->getAuthTree();
        View::share('authTree', $authTree);
    }

    /**
     * 验证参数，如果失败，则直接调用showMessage显示
     * @param $rule 验证规则
     * @return bool 是否验证成功
     */
    public function doValidate($rule)
    {
        $validator = Validator::make(Request::all(), $rule);

        if ($validator->fails()) {
            $this->validateMsg = $validator->errors()->first();
            return false;
        }
        return true;
    }

    /**
     * 从数据取出权限数据，并生成权限列表
     * @return array 划分层级后的权限数据
     */
    public function getAuthTree()
    {
        $authList = Auth::where('status', '=', 1)
            ->orderBy('order', 'asc')
            ->get();
        $finalAuthList = [];    //保存最终权限树
        $subAuthList = [];      //保存自权限数组
        foreach ($authList as $value) {
            if ($value->is_menu) {
                if ($value->pid) {
                    if (!isSet($subAuthList[$value->pid])) {
                        $subAuthList[$value->pid] = [];
                    }
                    $subAuthList[$value->pid][] = $value;
                } else {
                    $finalAuthList[] = $value;
                }
            }
        }

        foreach ($finalAuthList as $key => $value) {
            if (!isSet($subAuthList[$value->aid])) {
                $subAuthList[$value->aid] = [];
            }
            $finalAuthList[$key]->subAuthList = $subAuthList[$value->aid];
        }

        return $finalAuthList;
    }
}
