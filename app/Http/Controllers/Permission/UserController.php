<?php

namespace App\Http\Controllers\Permission;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;

use App\Models\User;
use App\Models\Role;
use App\Services\Helper;

class UserController extends Controller
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

    /**
     * 管理员用户列表
     * @return view 视图信息
     */
    public function index()
    {
        $userList = User::orderBy('uid', 'asc')
            ->get();

        //获取角色信息，并生成数组
        $roleList = Role::getRoleList();

        return view('user.list')
            ->with('pageName', trans('page.userList'))
            ->with('pageDesc', trans('page.userListDesc'))
            ->with('userList', $userList)
            ->with('roleList', $roleList);
    }

    public function editStatus(Request $request)
    {
        $uid = intval($request->input('uid'));
        $status = intval($request->input('status'));

        if (!($uid && $user = User::find($uid))) {
           $data = App::make('JsonpFormat')->jsonpFail([], 1003); 
           return response()->json($data);
        }

        if ($status) {
            $status = 1;
        } else {
            $status = 0;
        }

        $user->status = $status;
        if (!$user->save()) {
            Helper::showMessage('参数错误');
        }

       $data = App::make('JsonpFormat')->jsonpSucc([]); 
       return response()->json($data);
    }

    public function edit($userId = 0)
    {
        $userId = intval($userId);

        if (!$userId) {
            $user = new User;
            $user->uid = 0;
        } else if (!$user = user::find($userId)) {
            return Helper::showMessage('参数错误');
        }

        //获取角色信息，并生成数组
        $roleList = Role::getRoleList();

        return view('user.edit')
            ->with('pageName', trans('page.userEdit'))
            ->with('pageDesc', trans('page.userEditDesc'))
            ->with('user', $user)
            ->with('roleList', $roleList);
    }

    public function editRun(Request $request)
    {
        $validateRule = [
            'uid' => 'required|numeric',
            'account' => 'required|max:50|min:1',
            'name' => 'required|max:50|min:1',
            'rid' => 'required|numeric',
            'password' => 'confirmed',
            'status' => 'numeric|min:1',
        ];

        if (!$this->doValidate($validateRule)) {
            return Helper::showMessage($this->validateMsg);
        }

        if ($request->input('uid') == 0) {
            $user = new User;       //如果uid是0，表示这是一个新增操作
        } else if (!$user = User::find($request->input('uid'))) {
            return Helper::showMessage('参数错误');
        }

        $user->account = $request->input('account');
        $user->name = $request->input('name');
        $user->rid = $request->input('rid');
        $user->status = $request->input('status', 0);

        if ($request->input('password')) {
            $passwordHash = Helper::BuildPWDHash($request->input('account'), $request->input('password'));
            $user->password_hash = $passwordHash;
        }

        if (!$user->save()) {
            Helper::showMessage('参数错误');
        }

        return Helper::showMessage('操作成功', '/user/edit/'.$user->uid);
    }
}
