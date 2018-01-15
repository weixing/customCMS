<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;

use App\Models\Category;
use App\Services\Helper;

class CategoryController extends Controller
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
        $categoryListTmp = Category::orderBy('parent_cid', 'desc')
            ->orderBy('cid', 'asc')
            ->get();

        $categoryList = []; //用于保存整理好的分类列表
        $categoryChildList = [];    //用于保存上级分类和下级分类关系
        foreach ($categoryListTmp as $oneCategory) {
            if (0 == $oneCategory->parent_cid) {
                if (isset($categoryChildList[$oneCategory->cid])) {
                    $oneCategory->childList = $categoryChildList[$oneCategory->cid];
                } else {
                    $oneCategory->childList = [];
                }
                $categoryList[] = $oneCategory;
            } else {
                $categoryChildList[$oneCategory->parent_cid][] = $oneCategory;
            }
        }

        return view('category.list')
            ->with('pageName', trans('page.categoryList'))
            ->with('pageDesc', trans('page.categoryListDesc'))
            ->with('categoryList', $categoryList);
    }

    public function editStatus(Request $request)
    {
        $cid = intval($request->input('cid'));
        $status = intval($request->input('status'));

        if (!($cid && $category = Category::find($cid))) {
           $data = App::make('JsonpFormat')->jsonpFail([], 1003); 
           return response()->json($data);
        }

        if ($status) {
            $status = 1;
        } else {
            $status = 0;
        }

        $category->status = $status;
        if (!$category->save()) {
            Helper::showMessage('参数错误');
        }

       $data = App::make('JsonpFormat')->jsonpSucc([]); 
       return response()->json($data);
    }

    public function edit($categoryId = 0)
    {
        $categoryId = intval($categoryId);

        if (!$categoryId) {
            $category = new Category;
            $category->cid = 0;
        } else if (!$category = Category::find($categoryId)) {
            return Helper::showMessage('参数错误');
        }

        $topCategoryList = Category::getTopCategoryList();

        return view('category.edit')
            ->with('topCategoryList', $topCategoryList)
            ->with('pageName', trans('page.categoryEdit'))
            ->with('pageDesc', trans('page.categoryEditDesc'))
            ->with('category', $category);
    }

    public function editRun(Request $request)
    {
        $validateRule = [
            'cid' => 'required|numeric',
            'name' => 'required|max:100|min:1',
            'parent_cid' => 'numeric',
            'alias' => 'required|alpha_dash|max:100|min:1',
            'status' => 'numeric|min:1',
        ];

        if (!$this->doValidate($validateRule)) {
            return Helper::showMessage($this->validateMsg);
        }

        if ($request->input('cid') == 0) {
            $category = new Category;       //如果cid是0，表示这是一个新增操作
        } else if (!$category = Category::find($request->input('cid'))) {
            return Helper::showMessage('参数错误');
        }

        $category->name = $request->input('name');
        $category->alias = $request->input('alias');
        $category->parent_cid = $request->input('parent_cid');
        $category->status = $request->input('status', 0);

        if (!$category->save()) {
            Helper::showMessage('参数错误');
        }

        return Helper::showMessage('操作成功', '/category/edit/'.$category->cid);
    }
}
