<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App;
use Config;

use App\Models\Content;
use App\Models\Category;
use App\Services\Helper;

class ContentController extends Controller
{
    protected $disk;    //保存文件系统实例
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('login');
        $this->disk = Storage::disk('public');
        parent::__construct();
    }

    public function index($page = 1)
    {
        $page = intval($page);
        if ($page <= 1) {
            $page = 1;
        }

        $pageSize = Config::get('constants.pageSize');
        $validateList = Config::get('constants.validateList');
        $contentList = Content::orderBy('cid', 'asc')
            ->limit($pageSize)
            ->offset(($page - 1) * $pageSize)
            ->get();

        $categoryList = Category::getCategoryList();

        return view('content.list')
            ->with('pageName', trans('page.contentList'))
            ->with('pageDesc', trans('page.contentListDesc'))
            ->with('categoryList', $categoryList)
            ->with('validateList', $validateList)
            ->with('contentList', $contentList);
    }

    public function editStatus(Request $request)
    {
        $cid = intval($request->input('cid'));
        $status = intval($request->input('status'));

        if (!($cid && $content = Content::find($cid))) {
           $data = App::make('JsonpFormat')->jsonpFail([], 1003); 
           return response()->json($data);
        }

        if ($status) {
            $status = 2;
        } else {
            $status = 0;
        }

        $content->status = $status;
        if (!$content->save()) {
            Helper::showMessage('参数错误');
        }

       $data = App::make('JsonpFormat')->jsonpSucc([]); 
       return response()->json($data);
    }

    public function edit($contentId = 0)
    {
        $contentId = intval($contentId);

        if (!$contentId) {
            $content = new Content;
            $content->cid = 0;
        } else if (!$content = Content::find($contentId)) {
            return Helper::showMessage('参数错误');
        }
        
        $categoryList = Category::getCategoryList();

        return view('content.edit')
            ->with('pageName', trans('page.contentEdit'))
            ->with('pageDesc', trans('page.contentEditDesc'))
            ->with('categoryList', $categoryList)
            ->with('content', $content);
    }

    public function editRun(Request $request)
    {
        $validateRule = [
            'cid' => 'required|numeric',
            'title' => 'required|max:100|min:1',
            'sub_title' => 'required|max:100|min:1',
            'category_id' => 'required|numeric|min:1',
            'text' => 'required',
        ];

        if (!$this->doValidate($validateRule)) {
            return Helper::showMessage($this->validateMsg);
        }

        if ($request->input('cid') == 0) {
            $content = new Content;       //如果cid是0，表示这是一个新增操作
        } else if (!$content = Content::find($request->input('cid'))) {
            return Helper::showMessage('参数错误');
        }

        $content->title = $request->input('title');
        $content->sub_title = $request->input('sub_title');
        $content->category_id = $request->input('category_id');
        $content->text = $request->input('text');

        if ($file = $request->file('thumb')) {
            $filename = Helper::formatPath($file);
            $this->disk->put($filename, fopen($file->getRealPath(), 'r+'));
            $content->thumb = $this->disk->url($filename);
        }

        if (!$content->save()) {
            Helper::showMessage('参数错误');
        }

        return Helper::showMessage('操作成功', '/content/edit/'.$content->cid);
    }

    public function validateRun(Request $request)
    {
        $validateRule = [
            'cid' => 'required|numeric|min:1',
            'status' => 'required|numeric',
        ];

        if (!$this->doValidate($validateRule)) {
            return Helper::showMessage($this->validateMsg);
        }

        $contentId = intval($request->input('cid'));
        if (!$content = Content::find($contentId)) {
            return Helper::showMessage('参数错误');
        }

        if ($content->status != 2) {
            return Helper::showMessage('该文章不是待审核状态');
        }

        $content->status = $request->input('status');
        if (!$content->save()) {
            Helper::showMessage('参数错误');
        }

        return Helper::showMessage('操作成功', '/content/list/');
    }

}
