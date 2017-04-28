<!doctype html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{Config::get('web.web_title')}}</title>
    <!--360 browser -->
    <meta name="renderer" content="webkit">
    <meta name="author" content="wos">
    <!-- Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="images/i/app.png">
    <!--Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Amaze UI"/>
    <link rel="apple-touch-icon-precomposed" href="images/i/app.png">
    <!--Win8 or 10 -->
    <meta name="_token" content="{{ csrf_token() }}"/>
    <meta name="msapplication-TileImage" content="images/i/app.png">
    <meta name="msapplication-TileColor" content="#e1652f">
    @yield('css')
    <link rel="icon" type="image/png" href="{{asset('news/home/images/i/favicon.png')}}">
    <link rel="stylesheet" href="{{asset('news/home/css/public.css')}}">
    <script src="{{asset('news/home/assets/js/jquery.min.js')}}"></script>
    <script src="http://libs.baidu.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
    <script src="{{asset('news/home/assets/js/amazeui.ie8polyfill.min.js')}}"></script>
    <script src="{{asset('news/home/assets/js/amazeui.min.js')}}"></script>
    <script src="{{asset('news/home/js/public.js')}}"></script>
</head>
<body>
<header class="am-topbar am-topbar-fixed-top wos-header">
    <div class="am-container">
        <h1 class="am-topbar-brand">
            <a href="{{url('/')}}"><img src="{{asset('news/home/images/logo.png')}}"></a>
        </h1>

        <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-warning am-show-sm-only"
                data-am-collapse="{target: '#collapse-head'}">
            <span class="am-sr-only">导航切换</span>
            <span class="am-icon-bars"></span>
        </button>

        <div class="am-collapse am-topbar-collapse" id="collapse-head">
            <ul class="am-nav am-nav-pills am-topbar-nav" id="nav">
                {{--<li class="am-active"><a href="#">首页</a></li>--}}
                @foreach($navs as $na)
                    <li><a href="{{url($na->nav_url)}}">{{$na->nav_name}}</a></li>
                @endforeach
            </ul>

            {{--<div class="am-topbar-right">
                <button class="am-btn am-btn-default am-topbar-btn am-btn-sm"><span class="am-icon-pencil"></span>注册
                </button>
            </div>--}}

            <div class="am-topbar-right">
                <button class="am-btn am-btn-danger am-topbar-btn am-btn-sm" onclick="window.open('http://www.news.com/admin/login')"><span class="am-icon-user"></span> 登录
                </button>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        //获取当前url地址
        var urlstr = location.href;
        //console.log(urlstr);

        //alert((urlstr + '/').indexOf($(this).attr('href')));//-1

        var urlstatus=false;

        $("#nav a").each(function () {
            if ((urlstr).indexOf($(this).attr('href').substring(19)) > -1&&$(this).attr('href').substring(19)!='') {
                $(this).parent().addClass('am-active'); urlstatus = true;
                //console.log($(this).attr('href').substring(19));//当前url地址
                //console.log($(this).attr('href'));//匹配后 这个节点下的url地址
            } else {
                //console.log($(this).attr('href'));
                $(this).parent().removeClass('am-active');
            }
        });
        if (!urlstatus&&$("#nav a").attr('href').substring(19)=='') {$("#nav li:first").addClass('am-active'); }
    </script>

</header>
@yield('content')
<footer>
    <div class="content">
        <ul class="am-avg-sm-5 am-avg-md-5 am-avg-lg-5 am-thumbnails">
            <li>友情链接&nbsp;:</li>
            @foreach($links as $l)
                <li><a href="{{$l->link_url}}">{{$l->link_name}}</a></li>
            @endforeach
        </ul>
        <p>{{Config::get('web.web_design')}}<br>{{Config::get('web.copyright')}}</p>
        {{-- <div class="w2div">
             <ul data-am-widget="gallery" class="am-gallery am-avg-sm-2
am-avg-md-2 am-avg-lg-2 am-gallery-overlay" data-am-gallery="{ pureview: true }">
                 <li class="w2">
                     <div class="am-gallery-item">
                         <a href="Temp-images/dd.jpg">
                             <img src="Temp-images/dd.jpg"/>
                             <h3 class="am-gallery-title">订阅号：Amaze UI</h3>
                         </a>
                     </div>
                 </li>
                 <li class="w2">
                     <div class="am-gallery-item">
                         <a href="Temp-images/dd.jpg">
                             <img src="Temp-images/dd.jpg"/>
                             <h3 class="am-gallery-title">服务号：Amaze UI</h3>
                         </a>
                     </div>
                 </li>
             </ul>
         </div>--}}
    </div>
</footer>
</body>
</html>
