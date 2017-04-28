<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CommonController extends Controller
{
    //数据接口
   public function showData($status, $message, $data = array())
    {
        $reuslt = array(
            'status' => $status,
            'message' => $message,
            'data' => $data,
        );

        echo json_encode($reuslt,JSON_UNESCAPED_UNICODE);
        exit;
    }

    public function upload(){
        $file = Input::file('Filedata');
        if($file->isValid()){
            $entension = $file->getClientOriginalExtension();
            $newName = date('Ymdhis').mt_rand(100,999).'.'.$entension;
            $path = $file->move(public_path().'/uploads',$newName);
            $filepath = '/uploads/'.$newName;
            return $filepath;
        }
    }
}
