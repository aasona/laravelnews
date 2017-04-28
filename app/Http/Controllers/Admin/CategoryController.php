<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends CommonController
{
    //get.admin/category  全部分类列表
    public function index()
    {
        $categorys = (new Category)->tree();

        return view('admin.category.index')->with('data', $categorys);

    }

    //get.admin/category/create 添加分类
    public function create()
    {
        $data = Category::where('cate_pid', 0)->get();
        return view('admin/category/add', compact('data'));
    }

    //post.admin/category  添加分类提交
    public function store(Request $request)
    {

        $input = $request->except('_token');
        $rules = [
            'cate_name' => 'required',
        ];

        $message = [
            'cate_name.required' => '分类名称不能为空！',
        ];

        $validator = Validator::make($input, $rules, $message);

        if ($validator->passes()) {
            $re = Category::create($input);
            if ($re) {
                return redirect('admin/category');
            } else {
                return back()->with('errors', '数据添加失败！请重新添加！');
            }
        } else {
            return back()->withErrors($validator);
        }
    }




    //get.admin/category/{category}/edit 编辑
    public function edit($cate_id)
    {
        $data = Category::where('cate_pid', 0)->get();
        $field = Category::find($cate_id);
        return view('admin.category.edit', compact('field', 'data'));
    }



    public function update($cate_id)
    {
        $input = Input::except('_method', '_token');
        $re = Category::where('cate_id', $cate_id)->update($input);
        if ($re) {
            return redirect('admin/category');
        } else {
            return back()->with('errors', '更新失败，请重新尝试！');
        }

    }


    public function destroy($cate_id)
    {
        $re = Category::where('cate_id',$cate_id)->delete();
        Category::where('cate_pid',$cate_id)->update(['cate_pid'=>0]);
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

    public function changeOrder(Request $request)
    {
        $input = $request->all();
        $cate = Category::find($input['cate_id']);
        $cate->cate_order = $input['cate_order'];
        $re = $cate->update();
        if ($re) {
            $data = [
                'status' => 0,
                'msg' => '分类排序更新成功',
            ];
        } else {
            $data = [
                'status' => 1,
                'msg' => '分类排序更新失败',
            ];
        }
        return $data;
    }

}
