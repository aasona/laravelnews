<?php

namespace App\Http\Controllers\Home;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Content;
use App\Entity\Links;
use App\Entity\PositionData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class IndexController extends CommonController
{
    //
    public function index()
    {

        if (!Cache::has('html')) {
            //大图推荐
            $bagpic = PositionData::where('pos_id', 3)->orderBy('pcon_id', 'desc')->take(4)->get();

            //右侧小图
            $middlepic = PositionData::where('pos_id', 2)->orderBy('pcon_id', 'desc')->take(4)->get();

            //推荐
            $smalepic = PositionData::where('pos_id', 4)->orderBy('pcon_id', 'desc')->take(4)->get();

            $artId = PositionData::pluck('art_id');
            //热门推荐
            $new = Article::whereNotIn('art_id', $artId)->orderBy('art_time', 'desc')->take(8)->get();
            //dd($new);
            //排行
            $hot = Article::orderBy('art_view', 'desc')->take(6)->get();

            //广告位
            $pic = PositionData::where('pos_id', 5)->orderBy('pcon_id', 'desc')->take(2)->get();

            //友情链接
            $links = Links::orderBy('link_order', 'asc')->get();

            $res = view('home.index', compact('bagpic', 'middlepic', 'smalepic', 'new', 'hot', 'pic', 'links'))->render();
            Cache::put('html', $res, 60);
        }
        //Cache::forget('html');
        return Cache::get('html');
    }

    public function cate($cate_id)
    {
        //图文列表6篇（带分页）
        $data = Article::where('cate_id', $cate_id)->orderBy('art_time', 'desc')->paginate(6);

        //查看次数自增
        Category::where('cate_id', $cate_id)->increment('cate_view');

        //当前分类的子分类
        $submenu = Category::where('cate_pid', $cate_id)->get();

        $tags = Article::where('cate_id', $cate_id)->orderBy('art_view', 'desc')->take(6)->pluck('art_tag');

        //$field = Category::find($cate_id);
        return view('home.list', compact('data', 'submenu', 'tags'));
    }

    public function news($art_id)
    {
        $field = Article::Join('category', 'article.cate_id', '=', 'category.cate_id')->where('art_id', $art_id)->first();
        $con = Content::where('art_id', $art_id)->first();
        //dd($con);
        //查看次数自增
        Article::where('art_id', $art_id)->increment('art_view');

        $article['pre'] = Article::where('art_id', '<', $art_id)->orderBy('art_id', 'desc')->first();
        $article['next'] = Article::where('art_id', '>', $art_id)->orderBy('art_id', 'asc')->first();

        $data = Article::where('cate_id', $field->cate_id)->orderBy('art_id', 'desc')->take(6)->get();

        $hot = Article::orderBy('art_view', 'desc')->take(6)->get();
        return view('home.news', compact('field', 'article', 'data', 'con', 'hot'));
    }

    public function tags($art_tag)
    {
        $data = Article::where('art_tag', $art_tag)->orderBy('art_time', 'desc')->paginate(6);
        //dd($con);
        //查看次数自增
        return view('home.tags', compact('data'));
    }

    public function countArt()
    {


        if(!$_POST) {
            return $this->showData(0, '没有任何内容');
        }
        $artIds =  array_unique($_POST);

        try{
            //通过id查询数据
            $list = Article::whereIn('art_id',$artIds)->get();
        }catch (\Exception $e) {
            return $this->showData(0, $e->getMessage());
        }

        if(!$list) {
            return $this->showData(0, 'notdata');
        }

        $data = array();
        //重新定义数组，将id对应点击量
        foreach($list as $k=>$v) {
            $data[$v['art_id']] = $v['art_view'];
        }

        return $this->showData(1, 'success', $data);
    }

}
