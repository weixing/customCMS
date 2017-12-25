<?php

namespace App\Http\Controllers\Permission;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;

use App\Models\Role;
use App\Models\Auth;
use App\Services\Helper;

class RoleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('login');
        parent::__construct();
    }

    public function index()
    {
        $roleList = Role::orderBy('rid', 'asc')
            ->get();

        return view('role.list')
            ->with('pageName', trans('page.roleList'))
            ->with('pageDesc', trans('page.roleListDesc'))
            ->with('roleList', $roleList);
    }

    public function editStatus(Request $request)
    {
        $rid = intval($request->input('rid'));
        $status = intval($request->input('status'));

        if (!($rid && $role = Role::find($rid))) {
           $data = App::make('JsonpFormat')->jsonpFail([], 1003); 
           return response()->json($data);
        }

        if ($status) {
            $status = 1;
        } else {
            $status = 0;
        }

        $role->status = $status;
        if (!$role->save()) {
            Helper::showMessage('参数错误');
        }

       $data = App::make('JsonpFormat')->jsonpSucc([]); 
       return response()->json($data);
    }

    public function edit($roleId = 0)
    {
        $roleId = intval($roleId);

        if (!$roleId) {
            $role = new Role;
            $role->rid = 0;
        } else if (!$role = Role::find($roleId)) {
            return Helper::showMessage('参数错误');
        }

        //获取角色信息，并生成数组
        $authListRes = Auth::where('status', '=', 1)
            ->orderBy('order', 'asc')
            ->get();

        $authList = [];
        $subAuthList = [];
        foreach ($authListRes as $auth) {
            if ($auth->pid > 0) {
                if (!isSet($subAuthList[$auth->pid])) {
                    $subAuthList[$auth->pid] = [];
                }
                $subAuthList[$auth->pid][] = $auth;
            } else {
                $authList[] = $auth;
                if (!isSet($subAuthList[$auth->aid])) {
                    $subAuthList[$auth->aid] = [];
                }
            }
        }

        $roleAuth = Helper::FormatIntArrayStr($role->aids);

        return view('role.edit')
            ->with('pageName', trans('page.roleEdit'))
            ->with('pageDesc', trans('page.roleEditDesc'))
            ->with('role', $role)
            ->with('roleAuth', $roleAuth)
            ->with('authList', $authList)
            ->with('subAuthList', $subAuthList);
    }

    public function editRun(Request $request)
    {
        $validateRule = [
            'rid' => 'required|numeric',
            'name' => 'required|max:50|min:1',
            'status' => 'numeric|min:1',
        ];

        if (!$this->doValidate($validateRule)) {
            return Helper::showMessage($this->validateMsg);
        }

        if ($request->input('rid') == 0) {
            $role = new Role;       //如果rid是0，表示这是一个新增操作
        } else if (!$role = Role::find($request->input('rid'))) {
            return Helper::showMessage('参数错误');
        }

        $role->name = $request->input('name');
        $role->status = $request->input('status', 0);

        if (isSet($request->aids) && is_array($request->aids) && isSet($request->aids[0])) {
            $role->aids = implode(',', $request->aids);
        }

        if (!$role->save()) {
            Helper::showMessage('参数错误');
        }

        return Helper::showMessage('操作成功', '/role/edit/'.$role->rid);
    }
}
