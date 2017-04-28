<?php

namespace App\Http\Controllers\Home;

use App\Entity\Links;
use App\Entity\Navs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class CommonController extends Controller
{
    //
    public function __construct()
    {
        $navs = Navs::orderBy('nav_order','asc')->get();
        //dd($navs);
        View::share('navs',$navs);
        $links = Links::orderBy('link_order','asc')->get();
        View::share('links',$links);
    }

    //数据接口
    public function showData($status, $message, $data = array())
    {
        $result = array(
            'status' => $status,
            'message' => $message,
            'data' => $data,
        );

        echo json_encode($result,JSON_UNESCAPED_UNICODE);
        exit;
    }
}
