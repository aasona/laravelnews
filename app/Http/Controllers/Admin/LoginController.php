<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Admin;
use App\Tool\Validate\ValidateCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;


class LoginController extends CommonController
{
    //
    public function login(Request $request)
    {

        if ($input = $request->all()) {
            $code_session = $request->session()->get('validate_code', '');

            if ($input['user_name'] == null) {
                return $this->showData('0', '用户名不能为空！');
            }
            if ($input['user_pass'] == null) {
                return $this->showData('0', '密码不能为空！');
            }
            if ($input['code'] == null) {
                return $this->showData('0', '请输入验证码');
            }
            if (strtolower($input['code']) != $code_session) {
                return $this->showData('0', '验证码输入错误！');
            }
            $admin = Admin::first();//first()从数据表中获取一行数据
            if ($admin->admin_name != $input['user_name'] || Crypt::decrypt($admin->admin_pass) != $input['user_pass']) {
                return $this->showData('0', '用户名或密码错误！');
            }
            //session(['admin']=>$admin); 失效，因为laravel中写入session的值是在方法执行完。
            Session::put(['admin' => $admin]);//将用户信息存入session。立即生效！！！
            Session::save();
            return $this->showData('1','登录成功！');
        } else {
            return view('admin.login');
        }
    }
    public function quit()
    {
        session(['admin' => null]);
        return redirect('admin/login');
    }

    public function adminsession()
    {
        //dd(session('validate_code'));
        //dd(session('admin'));
    }

    /* public function crypt()
     {
         //长度<250
         $str = 'admin123';

         //$str_p = "eyJpdiI6ImdhWkpiYlhzbVdWN1wvY1pKc0FwTVNRPT0iLCJ2YWx1ZSI6ImpYM1E5aXljMGtjbzMwOUlGY0NHS3c9PSIsIm1hYyI6IjdhYWNhYmVhZmUyMDFmMGFhMzljNDdkZjlhYWQ0NjE3OTliZTM5ODZkOWI4YjdhYWIzYmVkMzM0NTFiMTUzYTUifQ";
         echo Crypt::encrypt($str);
         echo "<br/>";
         //echo Crypt::decrypt($str_p);

     }*/

}
