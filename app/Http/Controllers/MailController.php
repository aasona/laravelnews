<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //
    public function mail()
    {
        Mail::raw('邮件内容', function ($message) {
            $message->from('yhbcqyt@163.com', 'aasona');
            $message->subject('邮件主题 测试');
            $message->to('984756587@qq.com');
        });
    }
}
