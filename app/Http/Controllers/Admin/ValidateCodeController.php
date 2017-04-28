<?php

namespace App\Http\Controllers\Admin;

use App\Tool\Validate\ValidateCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ValidateCodeController extends Controller
{

    public function create(Request $request)
    {
        $validateCode = new ValidateCode;
        $request->session()->put('validate_code', $validateCode->getCode());
        $validateCode->doimg();
    }

    public function index(Request $request){
        $validate_code_session = $request->session()->get('validate_code', '');
        echo $validate_code_session;
    }
}
