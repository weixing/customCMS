<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;
use Config;

use App\Models\Block;
use App\Services\Helper;

class BlockController extends Controller
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
        $blockList = Block::orderBy('bid', 'asc')
            ->get();

        return view('block.list')
            ->with('blockType', Config::get('constants.blockType'))
            ->with('pageName', trans('page.blockList'))
            ->with('pageDesc', trans('page.blockListDesc'))
            ->with('blockList', $blockList);
    }

    public function editStatus(Request $request)
    {
        $bid = intval($request->input('bid'));
        $status = intval($request->input('status'));

        if (!($bid && $block = Block::find($bid))) {
           $data = App::make('JsonpFormat')->jsonpFail([], 1003); 
           return response()->json($data);
        }

        if ($status) {
            $status = 1;
        } else {
            $status = 0;
        }

        $block->status = $status;
        if (!$block->save()) {
            Helper::showMessage('参数错误');
        }

       $data = App::make('JsonpFormat')->jsonpSucc([]); 
       return response()->json($data);
    }

    public function edit($blockId = 0)
    {
        $blockId = intval($blockId);

        if (!$blockId) {
            $block = new Block;
            $block->bid = 0;
        } else if (!$block = Block::find($blockId)) {
            return Helper::showMessage('参数错误');
        }

        return view('block.edit')
            ->with('blockType', Config::get('constants.blockType'))
            ->with('pageName', trans('page.blockEdit'))
            ->with('pageDesc', trans('page.blockEditDesc'))
            ->with('block', $block);
    }

    public function editRun(Request $request)
    {
        $validateRule = [
            'bid' => 'required|numeric',
            'name' => 'required|max:100|min:1',
            'type' => 'numeric|min:1',
            'template' => 'required',
            'status' => 'numeric|min:1',
        ];

        if (!$this->doValidate($validateRule)) {
            return Helper::showMessage($this->validateMsg);
        }

        if ($request->input('bid') == 0) {
            $block = new Block;       //如果bid是0，表示这是一个新增操作
        } else if (!$block = Block::find($request->input('bid'))) {
            return Helper::showMessage('参数错误');
        }

        $block->name = $request->input('name');
        $block->type = $request->input('type');
        $block->template = $request->input('template');
        $block->status = $request->input('status', 0);

        if (!$block->save()) {
            Helper::showMessage('参数错误');
        }

        return Helper::showMessage('操作成功', '/block/edit/'.$block->bid);
    }

    public function editContent()
    {
        echo 'aa';
    }
}
