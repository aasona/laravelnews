<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Article;
use App\Entity\Links;
use App\Entity\PositionData;
use App\Http\Controllers\Home\CommonController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\Console\Output\BufferedOutput;

class ToolController extends CommonController
{
    //数据备份
    public function backup()
    {

        try {
            $output = new BufferedOutput;
            //Artisan::call('backup:run', ['--only-db' => true],$output);
            Artisan::call('backup:list', [], $output);
            dd(Artisan::output());
        } catch (\Exception $e) {
            var_dump($e);
        }

    }


    //缓存操作
    public function refreshHtml()
    {
        try{
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
        //$s = Cache::forget('html');

        $ref = Cache::put('html', $res, 60);
        echo "更新缓存成功！！！";

        }catch (\Exception $e){

        }
    }
}
