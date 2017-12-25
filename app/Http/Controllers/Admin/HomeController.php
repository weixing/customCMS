<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('login');
        parent::__construct();
    }

    public function index()
    {
        //print_r($page);
        //return view('AdminHome')->withPages(Page::all());
        //return view('AdminHome')->withPages($page);
        //return view('AdminHome')->with('pages', $page);
        return view('home')
            ->with('pageName', trans('page.home'))
            ->with('pageDesc', trans('page.homeDesc'));
    }
}
