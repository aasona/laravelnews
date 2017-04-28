@extends('layouts.admin')

@section('content')
    <!--头部 开始-->
    <div class="top_box">
        <div class="top_left">
            <div class="logo">后台管理模板</div>
            <ul>
                <li><a href="{{url('admin/info')}}" class="active" target="main">管理页</a></li>
                <li><a href="{{url('/')}}" target="_blank">首页</a></li>
            </ul>
        </div>
        <div class="top_right">
            <ul>
                <li>管理员：admin</li>
                <li><a href="{{url('admin/pass')}}" target="main">修改密码</a></li>
                <li><a href="{{url('admin/quit')}}">退出</a></li>
            </ul>
        </div>
    </div>
    <!--头部 结束-->

    <!--左侧导航 开始-->
    <div class="menu_box">
        <ul>
            <li>
                <h3><i class="fa fa-fw fa-clipboard"></i>内容管理</h3>
                <ul class="sub_menu">
                    <li><a href="{{url('admin/category')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>分类管理</a></li>
                    <li><a href="{{url('admin/article')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>新闻管理</a></li>
                    <li><a href="{{url('admin/navs')}}" target="main"><i class="fa fa-fw fa-list-alt"></i>导航管理</a></li>
                    <li><a href="{{url('admin/positions')}}" target="main"><i class="fa fa-fw fa-image"></i>推荐位管理</a></li>
                    <li><a href="{{url('admin/positionData')}}" target="main"><i class="fa fa-fw fa-image"></i>推荐位内容管理</a></li>
                </ul>
            </li>
            <li>
                <h3><i class="fa fa-fw fa-cog"></i>系统设置</h3>
                <ul class="sub_menu">
                    <li><a href="{{url('admin/links')}}" target="main"><i class="fa fa-fw fa-cubes"></i>友情链接</a></li>
                    <li><a href="{{url('admin/config')}}" target="main"><i class="fa fa-fw fa-database"></i>网站配置</a></li>
                </ul>
            </li>
            <li>
                <h3><i class="fa fa-fw fa-thumb-tack"></i>工具导航</h3>
                <ul class="sub_menu">
                    <li><a href="{{url('admin/backup')}}" target="main"><i class="fa fa-fw fa-database"></i>数据备份</a></li>
                    <li><a href="{{url('admin/refresh')}}" target="main"><i class="fa fa-fw fa-font"></i>首页缓存</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <!--左侧导航 结束-->

    <!--主体部分 开始-->
    <div class="main_box">
        <iframe src="{{url('admin/info')}}" frameborder="0" width="100%" height="100%" name="main"></iframe>
    </div>
    <!--主体部分 结束-->

    <!--底部 开始-->
    <div class="bottom_box">
        CopyRight © 2017. Powered By <a href="http://www.laravel.com">http://www.laravel.com</a>.
    </div>

@stop

