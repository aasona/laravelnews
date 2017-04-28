<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Position;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class PositionController extends Controller
{

    public function index()
    {
        $data = Position::orderBy('pos_id','asc')->get();
        return view('admin.position.index',compact('data'));
    }

    //get.admin/navs/create   添加自定义导航
    public function create()
    {
        return view('admin/position/add');
    }

    //post.admin/navs  添加自定义导航提交
    public function store()
    {
        $input = Input::except('_token');
        $input['pos_time'] = time();
        $rules = [
            'pos_name'=>'required',
        ];
        $message = [
            'pos_name.required'=>'推荐位名称不能为空！',
        ];

        $validator = Validator::make($input,$rules,$message);

        if($validator->passes()){
            $re = Position::create($input);
            if($re){
                return redirect('admin/positions');
            }else{
                return back()->with('errors','添加推荐位失败，请稍后重试！');
            }
        }else{
            return back()->withErrors($validator);
        }
    }

    //get.admin/navs/{navs}/edit  编辑自定义导航
    public function edit($pos_id)
    {
        $field = Position::find($pos_id);
        return view('admin.position.edit',compact('field'));
    }

    //put.admin/navs/{navs}    更新自定义导航
    public function update($pos_id)
    {
        $input = Input::except('_token','_method');
        $re = Position::where('pos_id',$pos_id)->update($input);
        if($re){
            return redirect('admin/positions');
        }else{
            return back()->with('errors','推荐位更新失败，请稍后重试！');
        }
    }

    //delete.admin/navs/{navs}   删除自定义导航
    public function destroy($pos_id)
    {
        $re = Position::where('pos_id',$pos_id)->delete();
        if($re){
            $data = [
                'status' => 0,
                'msg' => '推荐位删除成功！',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '推荐位删除失败，请稍后重试！',
            ];
        }
        return $data;
    }


    //get.admin/category/{category}  显示单个分类信息
    public function show()
    {

    }

}
