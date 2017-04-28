@extends('layouts.home')

@section('css')
    <link rel="stylesheet" href="{{asset('news/home/assets/css/amazeui.css')}}">
@stop
@section('content')
    <div class="banner">
        <div class="am-g am-container">
            <div class="am-u-sm-12 am-u-md-12 am-u-lg-8">
                <div data-am-widget="slider" class="am-slider am-slider-c1" data-am-slider='{"directionNav":false}'>
                    <ul class="am-slides">
                        @foreach($bagpic as $b)
                            <li>
                                <a href="{{url('new/'.$b->art_id)}}"><img src="{{url($b->pcon_thumb)}}"></a>
                                <div class="am-slider-desc">{{$b->pcon_title}}</div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="am-u-sm-0 am-u-md-0 am-u-lg-4 padding-none">
                <div class="star am-container"><span>要闻推荐</span></div>
                <ul class="padding-none am-gallery am-avg-sm-2 am-avg-md-4 am-avg-lg-2 am-gallery-overlay"
                    data-am-gallery="{ pureview: true }">

                    @foreach($middlepic as $m)
                        <li>
                            <div class="am-gallery-item">
                                <a href="{{url('new/'.$m->art_id)}}">
                                    <img src="{{url($m->pcon_thumb)}}"/>
                                    <h3 class="am-gallery-title">{{$m->pcon_title}}</h3>
                                    <div class="am-gallery-desc">2375-09-26</div>
                                </a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <!--banner2-->
    <div class="am-container">
        <ul class="padding-none banner2 am-gallery am-avg-sm-2 am-avg-md-4 am-avg-lg-4 am-gallery-overlay"
            data-am-gallery="{ pureview: true }">

            @foreach($smalepic as $s)
                <li>
                    <div class="am-gallery-item">
                        <a href="{{url('new/'.$s->art_id)}}">
                            <img src="{{url($s->pcon_thumb)}}"/>
                            <h3 class="am-gallery-title">{{$s->pcon_title}}</h3>
                            <div class="am-gallery-desc">{{$s->pcon_time}}</div>
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    <!--news-->
    <div class="am-g am-container newatype">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-8 oh">
            <div data-am-widget="titlebar" class="am-titlebar am-titlebar-default"
                 style="border-bottom: 0px; margin-bottom: -10px">
                <h2 class="am-titlebar-title ">
                    最新资讯
                </h2>
                <nav class="am-titlebar-nav">
                    <a href="#more">more &raquo;</a>
                </nav>
            </div>

            <div data-am-widget="list_news" class="am-list-news am-list-news-default news">
                <div class="am-list-news-bd">
                    <ul class="am-list">
                        @foreach($new as $v)
                            <li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-left"
                                data-am-scrollspy="{animation:'fade'}">
                                <div class="am-u-sm-5 am-list-thumb">
                                    <a href="{{url('new/'.$v->art_id)}}">
                                        <img src="{{url($v->art_thumb)}}"/>
                                    </a>
                                </div>
                                <div class=" am-u-sm-7 am-list-main">
                                    <h3 class="am-list-item-hd"><a
                                                href="{{url('new/'.$v->art_id)}}">{{$v->art_title}}</a></h3>
                                    <div class="am-list-item-text">
                                        {{$v->art_description}}
                                    </div>
                                </div>
                            </li>
                            <div class="newsico am-fr">
                                <i class="am-icon-clock-o">{{date('Y-m-d',$v->art_time)}}</i>
                                <i art_id="{{$v->art_id}}" class="am-icon-hand-pointer-o node-{{$v->art_id}}"></i>
                            </div>
                        @endforeach

                    </ul>
                </div>
                <div class="am-hide-sm">
                </div>
            </div>
        </div>
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-4">

            <div data-am-widget="titlebar" class="am-titlebar am-titlebar-default">
                <h2 class="am-titlebar-title ">
                    点击排行
                </h2>
                <nav class="am-titlebar-nav">
                    <a href="#more">more &raquo;</a>
                </nav>
            </div>

            <div data-am-widget="list_news" class="am-list-news am-list-news-default right-bg"
                 data-am-scrollspy="{animation:'fade'}">
                <ul class="am-list">
                    @foreach($hot as $h)
                        <li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-left">
                            <div class="am-u-sm-4 am-list-thumb">
                                <img src="{{url($h->art_thumb)}}"/>
                            </div>

                            <div class=" am-u-sm-8 am-list-main">
                                <h3 class="am-list-item-hd"><a href="{{url('new/'.$h->art_id)}}">{{$h->art_title}}</a>
                                </h3>
                            </div>
                        </li>
                        <hr data-am-widget="divider" style="" class="am-divider am-divider-default"/>
                    @endforeach
                </ul>
            </div>

            <ul class="am-gallery am-avg-sm-1
  am-avg-md-1 am-avg-lg-1 am-gallery-default" data-am-gallery="{ pureview: true }">
                @foreach($pic as $p)
                    <li>
                        <div class="am-gallery-item">
                            <a href="{{$p->pcon_url}}" class="">
                                <img src="{{url($p->pcon_thumb)}}"/>
                                <h3 class="am-gallery-title">{{$p->pcon_title}}</h3>
                                <div class="am-gallery-desc">
                                    <div class="am-fr">北京</div>
                                    <div class="am-fl">{{date('Y-m-d',$p->pcon_time)}}</div>
                                </div>
                            </a>
                        </div>
                    </li>
                @endforeach
                <li>
                    <div class="am-gallery-item">
                        <a href="http://s.amazeui.org/media/i/demos/bing-2.jpg" class="">
                            <img src="http://s.amazeui.org/media/i/demos/bing-2.jpg" alt="某天 也许会相遇 相遇在这个好地方"/>
                            <h3 class="am-gallery-title">某天 也许会相遇 相遇在这个好地方</h3>
                            <div class="am-gallery-desc">
                                <div class="am-fr">北京</div>
                                <div class="am-fl">2016/11/11</div>
                            </div>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div data-am-widget="gotop" class="am-gotop am-gotop-fixed">
        <a href="#top" title="回到顶部">
            <span class="am-gotop-title">回到顶部</span>
            <i class="am-gotop-icon am-icon-chevron-up"></i>
        </a>
    </div>
    <script src="{{asset('news/home/js/count.js')}}"></script>
@stop