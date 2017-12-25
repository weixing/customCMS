<?php

namespace App\Http\Controllers\Passport;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;

use App\PassportUser;

class PassportUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('login');
        parent::__construct();
    }

    /**
     * 个人中心用户列表
     * @return view 视图信息
     */
    public function index()
    {
        $passportUserList = PassportUser::orderBy('uid', 'asc')
            ->get();

        return view('user.list')
            ->with('pageName', trans('page.userList'))
            ->with('pageDesc', trans('page.userListDesc'))
            ->with('PassportUserList', $passportUserList);
    }
}
