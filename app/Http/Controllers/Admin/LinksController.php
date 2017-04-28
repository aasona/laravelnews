<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Links;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LinksController extends Controller
{

    public function index(){
        $data = Links::orderBy('link_order','asc')->get();
        return view('admin.links.index',compact('data'));
    }
    public function changeOrder()
    {
        $input = Input::all();
        $cate = Links::find($input['link_id']);
        $cate->link_order = $input['link_order'];
        $re = $cate->update();
        if ($re) {
            $data = [
                'status' => 0,
                'msg' => '友情链接排序更新成功',
            ];
        } else {
            $data = [
                'status' => 1,
                'msg' => '友情链接排序更新失败',
            ];
        }
        return $data;
    }
    public function create()
    {
        return view('admin/links/add', compact('data'));
    }
    public function store()
    {
        $input = Input::except('_token');
        $rules = [
            'link_name' => 'required',
            'link_url' => 'required'
        ];

        $message = [
            'link_name.required' => '链接名称不能为空！',
            'link_url.required' => '链接地址不能为空',
        ];

        $validator = Validator::make($input, $rules, $message);

        if ($validator->passes()) {
            $re = Links::create($input);
            if ($re) {
                return redirect('admin/links');
            } else {
                return back()->with('errors', '数据添加失败！请重新添加！');
            }
        } else {
            return back()->withErrors($validator);
        }
    }

    public function edit($link_id)
    {
        $field = Links::find($link_id);
        return view('admin.links.edit', compact('field'));
    }


    public function update($link_id)
    {
        $input = Input::except('_method', '_token');
        $re = Links::where('link_id', $link_id)->update($input);
        if ($re) {
            return redirect('admin/links');
        } else {
            return back()->with('errors', '更新失败，请重新尝试！');
        }

    }
    public function destroy($link_id)
    {
        $re = Links::where('link_id',$link_id)->delete();
        if($re){
            $dataDel = [
                'status' => 0,
                'msg' => '删除成功',
            ];
        }else{
            $dataDel = [
                'status' => 1,
                'msg' => '删除失败,请重新尝试!',
            ];
        }
        return $dataDel;
    }
}
