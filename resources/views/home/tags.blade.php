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
                                <i class="am-icon-hand-pointer-o">12322</i>
                            </div>
                        @endforeach
                    </ul>

                    <ul data-am-widget="pagination" class="am-pagination am-pagination-default">

                        <li class="am-pagination-first">
                            <a href="#" class="am-hide-sm">第一页</a>
                        </li>

                        <li class="am-pagination-prev ">
                            <a href="#" class="">上一页</a>
                        </li>


                        <li>
                            <a href="#" class="am-hide-sm">1</a>
                        </li>
                        <li>
                            <a href="#" class="am-hide-sm">2</a>
                        </li>
                        <li>
                            <a href="#" class="am-hide-sm">3</a>
                        </li>
                        <li>
                            <a href="#" class="am-hide-sm">4</a>
                        </li>
                        <li>
                            <a href="#" class="am-hide-sm">5</a>
                        </li>
                        <li>
                            <a href="#" class="am-hide-sm">6</a>
                        </li>
                        <li>
                            <a href="#" class="am-hide-sm">7</a>
                        </li>
                        <li>
                            <a href="#" class="am-hide-sm">8</a>
                        </li>
                        <li class="am-active">
                            <a href="#">9</a>
                        </li>
                        <li>
                            <a href="#" class="am-hide-sm">10</a>
                        </li>
                        <li>
                            <a href="#" class="am-hide-sm">11</a>
                        </li>
                        <li>
                            <a href="#" class="am-hide-sm">12</a>
                        </li>
                        <li>
                            <a href="#" class="am-hide-sm">13</a>
                        </li>
                        <li>
                            <a href="#" class="am-hide-sm">14</a>
                        </li>
                        <li>
                            <a href="#" class="am-hide-sm">15</a>
                        </li>
                        <li>
                            <a href="#" class="am-hide-sm">16</a>
                        </li>
                        <li class="am-pagination-next ">
                            <a href="#" class="">下一页</a>
                        </li>
                        <li class="am-pagination-last ">
                            <a href="#" class="am-hide-sm">最末页</a>
                        </li>
                    </ul>
                </div>
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
