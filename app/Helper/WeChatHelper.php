<?php

namespace App\Helper;

//use App\Helper\HttpHelper;

class WeChatHelper
{
    public static $authUri = [
        'code' => 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=%s&redirect_uri=%s&response_type=code&scope=%s&state=%s#wechat_redirect',
        'access_token' => 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=%s&secret=%s',
        'access_token_web' => 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=%s&secret=%s&code=%s&grant_type=authorization_code',
        'ticket' => 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=%s',
        'qr_code' => 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=%s',
        'login' => 'https://open.weixin.qq.com/connect/qrconnect?appid=%s&redirect_uri=%s&response_type=code&scope=snsapi_login&state=%s#wechat_redirect'
    ];

    // snsapi_base / snsapi_userinfo
    public static function getCodeUrl($scope, $state = '')
    {
        $config = config('services.wechat');
        $url = sprintf(self::$authUri['code'], $config['app_id'], urlencode($config['app_uri']), $scope, $state);

        return $url;
    }

    // snsapi_login
    public static function getLoginUrl($state = '')
    {
        $config = config('services.wechat');
        $url = sprintf(self::$authUri['login'], $config['app_id'], urlencode($config['app_uri']), $state);

        return $url;
    }

    // 获取网页授权的token
    public static function getAccessToken($code)
    {
        $config = config('services.wechat');
        $url = sprintf(self::$authUri['access_token_web'], $config['app_id'], $config['app_secret'], $code);

        if (empty(session('access_token')) || (session('expires_in') - time()) < 200) {
            $results = HttpHelper::send($url);
            $results = json_decode($results, true);
            $results['expires_in'] = time() + $results['expires_in'];
            session($results);
        }

        return session('access_token');
    }

    // 获取access token
//    public static function getAccessToken()
//    {
//        $config = config('services.wechat');
//        $url = sprintf(self::$authUri['access_token'], $config['app_id'], $config['app_secret']);
//
//        if (empty(session('access_token')) || (session('expires_in') - time()) < 200) {
//            $results = HttpHelper::send($url);
//            $results = json_decode($results, true);
//            $results['expires_in'] = time() + $results['expires_in'];
//            session($results);
//        }
//
//        return session('access_token');
//    }

    public static function getTicket($expire_seconds = 604800, $scene_id = 200)
    {
        $dataPtn = '{"expire_seconds": %d, "action_name": "QR_SCENE", "action_info": {"scene": {"scene_id": %d}}}';
        $data = sprintf($dataPtn, intval($expire_seconds), intval($scene_id));
        $url = sprintf(self::$authUri['ticket'], self::getAccessToken());

        $results = HttpHelper::send($url, 'POST', $data);
        $results = json_decode($results, true);

        return isset($results['ticket']) ? $results['ticket'] : '';
    }

    public static function getQrCode()
    {
        $url = sprintf(self::$authUri['qr_code'], urlencode(self::getTicket()));
        $results = HttpHelper::send($url);

        return $results;
    }
}

