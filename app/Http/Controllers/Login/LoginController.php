<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

use App\Models\User;
use App\Models\Role;
use App\Services\Helper;

class LoginController extends Controller
{
    //
    public function index(Request $request)
    {
        //print_r($request->getSession());
        return view('Login');
    }

    /**
     * 执行登陆操作
     * @param $request Request对象
     * @return void
     */
    public function doLogin(Request $request)
    {
        $validateRule = [
            'account' => 'required|alpha|max:50|min:1',
            'password' => 'required',
        ];

        if (!$this->doValidate($validateRule)) {
            return Helper::showMessage($this->validateMsg);
        }

        $admin = User::where('account', '=', $request->input('account'))
            ->where('status', '=', 1)
            ->first();

        if (!$admin) {
            return Helper::showMessage(trans('auth.failed'));
        }
        $passwordHash = Helper::BuildPWDHash($request->input('account'), $request->input('password'));
        if ($passwordHash != $admin->password_hash) {
            return Helper::showMessage(trans('auth.failed'));
        }

        $role = Role::getById($admin->rid);
        $admin->roleInfo = $role;
        Session::put('admin', $admin);
        Session::save();
        //print_r(request()->session()->all());
        return redirect('/');

    }

    /**
     * 退出登录
     * @param $request Request对象
     * @return void
     */
    public function logout(Request $request)
    {
        Session::flush();
        Session::save();
        return redirect('/');

    }
}
