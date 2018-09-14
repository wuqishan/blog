<?php

namespace App\Http\Controllers\Admin;

use App\Helper\WeChatHelper;
use App\Helpers\HttpHelper;
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

    public function loginWithWechat()
    {

    }

    public function getLoginWechatQrCode()
    {
        $url = WeChatHelper::getCodeUrl('snsapi_userinfo');
//dd($url);
        return view('admin.user.qrcode', ['url' => $url]);
    }
}
