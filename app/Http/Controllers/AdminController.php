<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests\EventStoreRequest;
use App\Http\Requests\EventUpdateRequest;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        return view('admin.login');
    }

}
