<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;

use App\Models\Webpage;
use App\Models\Site;
use App\Services\Helper;

class WebpageController extends Controller
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
        $webpageList = Webpage::orderBy('wpid', 'asc')
            ->get();

        //获取发布点信息，并生成数组
        $siteList = Site::getSiteList();

        return view('webpage.list')
            ->with('siteList', $siteList)
            ->with('pageName', trans('page.webpageList'))
            ->with('pageDesc', trans('page.webpageListDesc'))
            ->with('webpageList', $webpageList);
    }

    public function editStatus(Request $request)
    {
        $wpid = intval($request->input('wpid'));
        $status = intval($request->input('status'));

        if (!($wpid && $webpage = Webpage::find($wpid))) {
           $data = App::make('JsonpFormat')->jsonpFail([], 1003); 
           return response()->json($data);
        }

        if ($status) {
            $status = 1;
        } else {
            $status = 0;
        }

        $webpage->status = $status;
        if (!$webpage->save()) {
            Helper::showMessage('参数错误');
        }

       $data = App::make('JsonpFormat')->jsonpSucc([]); 
       return response()->json($data);
    }

    public function edit($webpageId = 0)
    {
        $webpageId = intval($webpageId);

        if (!$webpageId) {
            $webpage = new Webpage;
            $webpage->wpid = 0;
        } else if (!$webpage = Webpage::find($webpageId)) {
            return Helper::showMessage('参数错误');
        }

        //获取发布点信息，并生成数组
        $siteList = Site::getSiteList();

        return view('webpage.edit')
            ->with('siteList', $siteList)
            ->with('pageName', trans('page.webpageEdit'))
            ->with('pageDesc', trans('page.webpageEditDesc'))
            ->with('webpage', $webpage);
    }

    public function editRun(Request $request)
    {
        $validateRule = [
            'wpid' => 'required|numeric',
            'name' => 'required|max:100|min:1',
            'url' => 'required|max:100|min:1',
            'sid' => 'required|numeric|min:1',
            'template' => 'required',
            'status' => 'numeric|min:1',
        ];

        if (!$this->doValidate($validateRule)) {
            return Helper::showMessage($this->validateMsg);
        }

        if ($request->input('wpid') == 0) {
            $webpage = new Webpage;       //如果wpid是0，表示这是一个新增操作
        } else if (!$webpage = Webpage::find($request->input('wpid'))) {
            return Helper::showMessage('参数错误');
        }

        $webpage->name = $request->input('name');
        $webpage->url = $request->input('url');
        $webpage->sid = $request->input('sid');
        $webpage->template = $request->input('template');
        $webpage->status = $request->input('status', 0);

        if (!$webpage->save()) {
            Helper::showMessage('参数错误');
        }

        return Helper::showMessage('操作成功', '/webpage/edit/'.$webpage->wpid);
    }
}
