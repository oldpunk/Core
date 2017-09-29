<?php

namespace Modules\Core\Http\Controllers;


class IndexController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('core::index');
    }
}
