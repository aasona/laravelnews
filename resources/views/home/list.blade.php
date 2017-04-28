@extends('layouts.home')

@section('css')
    <link rel="stylesheet" href="{{asset('news/home/assets/css/amazeui.min.css')}}">
@stop

@section('content')
    <div class="am-g am-container padding-none">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-8">
            <div data-am-widget="list_news" class="am-list-news am-list-news-default ">
                <div class="am-list-news-bd">
                    <ul class="am-list">
                        @foreach($data as $d)
                            <li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-left"
                                style="border-top: 0px">
                                <div class="am-u-sm-5 am-list-thumb">
                                    <a href="{{url('new/'.$d->art_id)}}">
                                        <img src="{{url($d->art_thumb)}}"/>
                                    </a>
                                </div>

                                <div class=" am-u-sm-7 am-list-main">
                                    <h3 class="am-list-item-hd"><a
                                                href="{{url('new/'.$d->art_id)}}">{{$d->art_title}}</a></h3>

                                    <div class="am-list-item-text">{{$d->art_description}}</div>
                                </div>
                            </li>
                            <div class="newsico am-fr">
                                <i class="am-icon-clock-o">{{date('Y-m-d',$d->art_time)}}</i>
                                <i class="am-icon-hand-pointer-o">{{$d->art_view}}</i>
                            </div>
                        @endforeach
                    </ul>
                    <div class="page">
                        {{$data->links()}}
                    </div>
                    <style type="text/css">
                        .page ul {
                            position: relative;
                            margin-right: 10px;
                            font-size: 1.6rem;
                            padding-left: 0
                        }

                        .page ul li {
                            float: left;
                            position: relative;
                            display: block;
                            padding: .6em 1.5em;
                            text-decoration: none;
                            line-height: 1.2;
                            background-color: #fff;
                            border: 1px solid #ddd;
                            border-radius: .5em;
                            margin-bottom: 5px;
                            margin-right: 5px;
                        }

                        .page ul li a {
                            padding: 10px 12px;
                        }
                    </style>
                    <br/>
                </div>
            </div>
        </div>
        <div class="am-u-sm-0 am-u-md-0 am-u-lg-4 am-hide-sm">
            <div class="tag bgtag">
                <div data-am-widget="titlebar" class="am-titlebar am-titlebar-default">
                    <h2 class="am-titlebar-title ">
                        热门分类
                    </h2>
                </div>
                <ul>
                    @foreach($submenu as $sub)
                        <li class="active"><a href="{{url('list/'.$sub->cate_id)}}">{{$sub->cate_name}}</a></li>
                    @endforeach
                </ul>
                <div class="am-cf"></div>
            </div>
        </div>
        <div class="am-u-sm-0 am-u-md-0 am-u-lg-4 am-hide-sm">
            <div class="tag bgtag">
                <div data-am-widget="titlebar" class="am-titlebar am-titlebar-default">
                    <h2 class="am-titlebar-title ">
                        热门标签
                    </h2>
                </div>
                <ul>
                    @foreach($tags as $tag )
                        @if($tag!=="")
                            <li><a href="{{url('tags/'.$tag)}}">{{$tag}}</a></li>
                        @endif
                    @endforeach
                </ul>

                <div class="am-cf"></div>
            </div>
        </div>
    </div>

    <div data-am-widget="gotop" class="am-gotop am-gotop-fixed">
        <a href="#top" title="回到顶部">
            <span class="am-gotop-title">回到顶部</span>
            <i class="am-gotop-icon am-icon-chevron-up"></i>
        </a>
    </div>
@stop
