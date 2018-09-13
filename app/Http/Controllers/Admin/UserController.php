<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function login()
    {
        return view('admin.user.login');
    }

    public function doLogin(Request $request)
    {

    }
}
