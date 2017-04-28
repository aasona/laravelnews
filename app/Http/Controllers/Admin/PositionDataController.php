<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Position;
use App\Entity\PositionData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class PositionDataController extends CommonController
{
    public function index()
    {
        $data = PositionData::orderBy('pcon_order','asc')->paginate(6);

        return view('admin.positionData.index',compact('data'));
    }

    public function changeOrder()
    {
        $input = Input::all();
       // dd($input);
        $pcons = PositionData::find($input['pcon_id']);
        $pcons->pcon_order = $input['pcon_order'];
        $re = $pcons->update();
        if($re){
            $data = [
                'status' => 0,
                'msg' => '自定义导航排序更新成功！',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '自定义导航排序更新失败，请稍后重试！',
            ];
        }
        return $data;
    }

    //get.admin/navs/create   添加自定义导航
    public function create()
    {
        $posData = Position::all();
        return view('admin/positionData/add',compact('posData'));
    }

    //post.admin/navs  添加自定义导航提交
    public function store()
    {
        $input = Input::except('_token');
        $input['pcon_time'] = time();
        $rules = [
            'pcon_title'=>'required',
            'pcon_url'=>'required',
        ];

        $message = [
            'pcon_title.required'=>'标题名称不能为空！',
            'pcon_url.required'=>'URL不能为空！',
        ];

        $validator = Validator::make($input,$rules,$message);

        if($validator->passes()){
            $re = PositionData::create($input);
            if($re){
                return redirect('admin/positionData');
            }else{
                return back()->with('errors','失败，请稍后重试！');
            }
        }else{
            return back()->withErrors($validator);
        }
    }

    //get.admin/navs/{navs}/edit  编辑自定义导航
    public function edit($pcon_id)
    {
        $field = PositionData::find($pcon_id);
        $posData = Position::all();
        return view('admin.positionData.edit',compact('field','posData'));
    }

    //put.admin/navs/{navs}    更新自定义导航
    public function update($pcon_id)
    {
        $input = Input::except('_token','_method');
        $re = PositionData::where('pcon_id',$pcon_id)->update($input);
        if($re){
            return redirect('admin/positionData');
        }else{
            return back()->with('errors','更新失败，请稍后重试！');
        }
    }

    //delete.admin/navs/{navs}   删除自定义导航
    public function destroy($pcon_id)
    {
        $re = PositionData::where('pcon_id',$pcon_id)->delete();
        if($re){
            $data = [
                'status' => 0,
                'msg' => '删除成功！',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '删除失败，请稍后重试！',
            ];
        }
        return $data;
    }


    //get.admin/category/{category}  显示单个分类信息
    public function show()
    {

    }
}
