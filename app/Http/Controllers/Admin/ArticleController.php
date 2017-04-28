<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Admin;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Content;
use App\Entity\Position;
use App\Entity\PositionData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ArticleController extends CommonController
{
    public function index()
    {
        //
        $data = Article::orderBy('art_order', 'asc')->paginate(6);
        $posData = Position::all();
        //$admin = Admin::pluck('admin_name');
        return view('admin/article/index', compact('data', 'posData'));
    }


    public function create()
    {
        $data = (new Category)->tree();
        return view('admin.article.add', compact('data'));
    }

    public function store(Request $request)
    {
        $content = $request->only('art_content');
        $input = $request->except('_token', 'art_content');
        $input['art_time'] = time();
        //截取内容 填充描述
        if ($input['art_description'] == null) {
            $str = strip_tags($content['art_content']);
            $input['art_description'] = mb_substr($str, 0, 59, 'utf-8');
        }

        $rules = [
            'art_title' => 'required',
        ];
        $message = [
            'art_title.required' => '文章标题不能为空！',
        ];
        $validator = Validator::make($input, $rules, $message);

        $rulesCon = [
            'art_content' => 'required',
        ];
        $messageCon = [
            'art_content.required' => '文章内容不能为空！',
        ];
        $validatorCon = Validator::make($content, $rulesCon, $messageCon);

        if (!$validator->passes()) {
            return back()->withErrors($validator);
        }
        if (!$validatorCon->passes()) {
            return back()->withErrors($validatorCon);
        }

        if ($validator->passes() && $validatorCon->passes()) {

            //dd($input);
            $re = Article::create($input);
            $conDate['art_id'] = $re->art_id;
            $conDate['art_content'] = $content['art_content'];
            // dd($conDate);
            $reCon = Content::create($conDate);
            if ($reCon) {
                return redirect('admin/article');
            } else {
                return back()->with('errors', '数据填充失败，请重新尝试！');
            }
        }
    }

    public function edit($art_id)
    {

        $data = (new Category)->tree();
        $field = Article::find($art_id); //find 通过主键获取记录
        $content = Content::where('art_id', $art_id)->first(); //first 获取匹配查询条件的第一个模型
        $fieldCon = $content->art_content;
        return view('admin.article.edit', compact('data', 'field', 'fieldCon'));


    }


    public function update($art_id)
    {
        $input = Input::except('_token', '_method', 'art_content');
        $re = Article::where('art_id', $art_id)->update($input);
        $content = Input::only('art_content');
        $reCon = Content::where('art_id', $art_id)->update($content);

        if ($re) {
            return redirect('admin/article');
        } else {
            return back()->with('errors', '文章更新失败，请重新尝试！');
        }

    }


    public function destroy($art_id)
    {
        $re = Article::where('art_id', $art_id)->delete();
        $reCon = Content::where('art_id', $art_id)->delete();

        if ($re && $reCon) {
            $dataDel = [
                'status' => 0,
                'msg' => '文章删除成功',
            ];
        } else {
            $dataDel = [
                'status' => 1,
                'msg' => '文章删除失败,请重新尝试!',
            ];
        }
        return $dataDel;
    }

    public function changeOrder(Request $request)
    {
        $input = $request->all();
        $art = Article::find($input['art_id']);

        $art->art_order = $input['art_order'];
        $re = $art->update();

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

    public function push()
    {
        $jumpUrl = $_SERVER['HTTP_REFERER'];
        $positonId = intval($_POST['position_id']);
        $artId = $_POST['push'];

        //$data = implode(',', $artId);
        //dd($data);

        if (!$artId || !is_array($artId)) {
            return $this->showData(0, '请选择推荐的文章ID进行推荐');

        }
        if (!$positonId) {
            return $this->showData(0, '没有选择推荐位');
        }

        $arts = Article::wherein('art_id', $artId)->get();//获取数据库数据
        //dd($arts);

        if (!$arts) {
            return $this->showData(0, '没有相关内容');
        }

        foreach ($arts as $art) {
            $data = array(
                'pos_id' => $positonId,
                'pcon_title' => $art['art_title'],
                'pcon_thumb' => $art['art_thumb'],
                'art_id' => $art['art_id'],
                'pcon_time' => $art['art_time'],
            );
            $rePos = PositionData::create($data);
        }
        if ($rePos) {
            return $this->showData(1, '推荐成功', array('jump_url' => $jumpUrl));
        } else {
            return $this->showData(0, '推荐失败，请稍后重试！');
        }
    }

    public function ArtSearch(Request $request)
    {
      $input = $request->only('keywords');
      $keywords = $input['keywords'];
      $data = Article::where('art_title','like','%'.$keywords.'%')->get();
      dd($data);

    }

}
