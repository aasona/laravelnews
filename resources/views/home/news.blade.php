@extends('layouts.home')

@section('css')
    <link rel="stylesheet" href="{{asset('news/home/assets/css/amazeui.css')}}">
@stop

@section('content')
<div class="am-g am-container">
    <div class="am-u-sm-12 am-u-md-12 am-u-lg-8">
        <div class="newstitles">
            <h2>{{$field->art_title}}</h2>
            <img src="{{url($field->art_thumb)}}" class="face">
            <span>{{$field->art_editor}}</span>
            时间：{{date('Y-m-d',$field->art_time)}}   阅读：{{$field->art_view}}
        </div>
        {{--<a href="#"><img src="Temp-images/ad2.png" class="am-img-responsive" width="100%"/></a>--}}

        <div class="contents">
            {!! $con->art_content !!}
        </div>
        {{--<div class="shang">
            <img src="images/shang.png" >
        </div>--}}
        <div class="am-duoshuo am-duoshuo-default">
            <!-- UY BEGIN -->
            <div id="uyan_frame"></div>
            <script type="text/javascript" src="http://v2.uyan.cc/code/uyan.js"></script>
            <!-- UY END -->
            <div class="ds-thread" >
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

        {{--   <script>
               var mypics = new Array()
                   mypics[0] = "{{asset('news/home/images/1.jpg')}}"
                   mypics[1] = "{{asset('news/home/images/2.jpg')}}"
                   mypics[2] = "{{asset('news/home/images/3.jpg')}}"
               mypics[3] = "{{asset('news/home/images/4.jpg')}}"
               mypics[4] = "{{asset('news/home/images/5.jpg')}}"
                  //document.write(mypics[0]);
               //$("#img_pics").attr("src","mypics[0]");
               /*
                $("#img_pics").each(function(i){
                $(this).attr("src","mypics[i]");
                });*/
           </script>--}}

        <div data-am-widget="list_news" class="am-list-news am-list-news-default right-bg"
             data-am-scrollspy="{animation:'fade'}">
            <ul class="am-list">
                @foreach($hot as $h)
                    <li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-left">
                        <div class="am-u-sm-4 am-list-thumb">
                            <img src="{{url($h->art_thumb)}}"/>
                        </div>

                        <div class=" am-u-sm-8 am-list-main">
                            <h3 class="am-list-item-hd"><a href="http://www.douban.com/online/11624755/">{{$h->art_title}}</a></h3>
                        </div>
                    </li>
                    <hr data-am-widget="divider" style="" class="am-divider am-divider-default"/>
                @endforeach
            </ul>
        </div>

        <ul class="am-gallery am-avg-sm-1
  am-avg-md-1 am-avg-lg-1 am-gallery-default" data-am-gallery="{ pureview: true }">
            <li>
                <div class="am-gallery-item">
                    <a href="http://s.amazeui.org/media/i/demos/bing-1.jpg" class="">
                        <img src="http://s.amazeui.org/media/i/demos/bing-1.jpg" alt="远方 有一个地方 那里种有我们的梦想"/>
                        <h3 class="am-gallery-title">远方 有一个地方 那里种有我们的梦想</h3>
                        <div class="am-gallery-desc">
                            <div class="am-fr">北京</div>
                            <div class="am-fl">2016/11/11</div>
                        </div>
                    </a>
                </div>
            </li>
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


<div data-am-widget="gotop" class="am-gotop am-gotop-fixed" >
    <a href="#top" title="回到顶部">
        <span class="am-gotop-title">回到顶部</span>
        <i class="am-gotop-icon am-icon-chevron-up"></i>
    </a>
</div>
@stop

