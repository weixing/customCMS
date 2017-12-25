<?php

namespace App\Http\Controllers\Permission;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;

use App\Models\Auth;
use App\Exceptions\AuthException;
use App\Services\Helper;

class AuthController extends Controller
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
        $allAuthList = Auth::orderBy('order', 'asc')
            ->get();

        $authList = [];
        $subAuthList = [];

        foreach ($allAuthList as $value) {
            if ($value->pid) {
                if (!isSet($subAuthList[$value->pid])) {
                    $subAuthList[$value->pid] = [];
                }
                $subAuthList[$value->pid][] = $value;
            } else {
                $authList[] = $value;
            }
        }
        return view('auth.list')
            ->with('pageName', trans('page.authList'))
            ->with('pageDesc', trans('page.authListDesc'))
            ->with('authList', $authList)
            ->with('subAuthList', $subAuthList);
    }

    public function editStatus(Request $request)
    {
        $aid = intval($request->input('aid'));
        $status = intval($request->input('status'));

        if (!($aid && $auth = Auth::find($aid))) {
           $data = App::make('JsonpFormat')->jsonpFail([], 1003); 
           //return response()->json($data)->setCallback($request->input('callback'));
           return response()->json($data);
        }

        if ($status) {
            $status = 1;
        } else {
            $status = 0;
        }

        $auth->status = $status;
        if (!$auth->save()) {
            //throw new AuthException(['en'=>'invalid param', 'cn'=>'参数错误']);
            Helper::showMessage('参数错误');
        }

       $data = App::make('JsonpFormat')->jsonpSucc([]); 
       return response()->json($data);
    }

    public function edit($authId = 0)
    {
        $authId = intval($authId);

        if (!$authId) {
            $auth = new Auth;
            $auth->aid = 0;
        } else if (!$auth = Auth::find($authId)) {
            return Helper::showMessage('参数错误');
        }

        $authList = Auth::where('pid', '=', 0)
            ->get();

        return view('auth.edit')
            ->with('pageName', trans('page.authEdit'))
            ->with('pageDesc', trans('page.authEditDesc'))
            ->with('authList', $authList)
            ->with('auth', $auth);
    }

    /**
     * 显示编辑/添加权限信息的界面
     * @param Request $request Request 对象
     * @return view 视图
     */
    public function editRun(Request $request)
    {
        $validateRule = [
            'aid' => 'required|numeric',
            'name' => 'required|max:50|min:1',
            'pid' => 'required|numeric',
            'controller' => 'nullable|alpha|max:50',
            'action' => 'nullable|alpha|max:50',
            'url' => 'nullable|regex:/^[a-zA-Z][a-zA-Z0-9\/]{4,20}$/|max:50',
            'icon' => 'nullable|alphadash|max:50',
            'order' => 'required|numeric|',
            'is_menu' => 'numeric|min:1',
            'status' => 'numeric|min:1',
        ];

        if (!$this->doValidate($validateRule)) {
            return Helper::showMessage($this->validateMsg);
        }

        if ($request->input('aid') == 0) {
            $auth = new Auth;       //如果aid是0，表示这是一个新增操作
        } else if (!$auth = Auth::find($request->input('aid'))) {
            return Helper::showMessage('参数错误');
        }

        $auth->name = $request->input('name');
        $auth->pid = $request->input('pid');
        $auth->controller = $request->input('controller', '');
        $auth->action = $request->input('action', '');
        $auth->url = $request->input('url');
        $auth->order = $request->input('order');
        $auth->icon = $request->input('icon', '');
        $auth->is_menu = $request->input('is_menu', 0);
        $auth->status = $request->input('status', 0);

        if (!$auth->save()) {
            //throw new AuthException(['en'=>'invalid param', 'cn'=>'参数错误']);
            Helper::showMessage('参数错误');
        }

        return Helper::showMessage('操作成功', '/auth/edit/'.$auth->aid);
    }
}
