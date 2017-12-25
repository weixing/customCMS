<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;

use App\Models\Site;
use App\Services\Helper;

class SiteController extends Controller
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
        $siteList = Site::orderBy('sid', 'asc')
            ->get();

        return view('site.list')
            ->with('pageName', trans('page.siteList'))
            ->with('pageDesc', trans('page.siteListDesc'))
            ->with('siteList', $siteList);
    }

    public function editStatus(Request $request)
    {
        $sid = intval($request->input('sid'));
        $status = intval($request->input('status'));

        if (!($sid && $site = Site::find($sid))) {
           $data = App::make('JsonpFormat')->jsonpFail([], 1003); 
           return response()->json($data);
        }

        if ($status) {
            $status = 1;
        } else {
            $status = 0;
        }

        $site->status = $status;
        if (!$site->save()) {
            Helper::showMessage('参数错误');
        }

       $data = App::make('JsonpFormat')->jsonpSucc([]); 
       return response()->json($data);
    }

    public function edit($siteId = 0)
    {
        $siteId = intval($siteId);

        if (!$siteId) {
            $site = new Site;
            $site->sid = 0;
        } else if (!$site = Site::find($siteId)) {
            return Helper::showMessage('参数错误');
        }

        return view('site.edit')
            ->with('pageName', trans('page.siteEdit'))
            ->with('pageDesc', trans('page.siteEditDesc'))
            ->with('site', $site);
    }

    public function editRun(Request $request)
    {
        $validateRule = [
            'sid' => 'required|numeric',
            'name' => 'required|max:100|min:1',
            'path' => 'required|max:100|min:1',
            'domain' => 'required|max:100|min:1',
            'status' => 'numeric|min:1',
        ];

        if (!$this->doValidate($validateRule)) {
            return Helper::showMessage($this->validateMsg);
        }

        if ($request->input('sid') == 0) {
            $site = new Site;       //如果sid是0，表示这是一个新增操作
        } else if (!$site = Site::find($request->input('sid'))) {
            return Helper::showMessage('参数错误');
        }

        $site->name = $request->input('name');
        $site->path = $request->input('path');
        $site->domain = $request->input('domain');
        $site->status = $request->input('status', 0);

        if (!$site->save()) {
            Helper::showMessage('参数错误');
        }

        return Helper::showMessage('操作成功', '/site/edit/'.$site->sid);
    }
}
