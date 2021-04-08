<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
    	return view('search');
    }

    public function courses(Request $request)
    {
    	return view('courses');
    }

    public function articles(Request $request)
    {
        return view('articles');
    }
}
