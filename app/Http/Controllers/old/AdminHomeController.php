<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;

class AdminHomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        echo 'bbbb';
        $page = Page::all();
        //print_r($page);
        //return view('AdminHome')->withPages(Page::all());
        //return view('AdminHome')->withPages($page);
        return view('AdminHome')->with('pages', $page);
        //return view('AdminHome');
    }
}
