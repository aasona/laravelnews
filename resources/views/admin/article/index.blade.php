@extends('layouts.admin')
@section('content')
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">新闻管理首页</a> &raquo; 文章管理
    </div>
    <!--结果页快捷搜索框 开始-->
    <div class="search_wrap">
        <form action="{{url('admin/article/search')}}" method="post">
            {{csrf_field()}}
            <table class="search_tab">
                <tr>
                    <th width="78">选择分类:</th>
                    <td>
                        <select onchange="javascript:location.href=this.value;">
                            <option value="">全部</option>
                            <option value="http://www.baidu.com">百度</option>
                            <option value="http://www.sina.com">新浪</option>
                        </select>
                    </td>
                    <th width="70">关键字:</th>
                    <td><input type="text" name="keywords" placeholder="关键字"></td>
                    <td><input type="submit" name="sub" value="查询" ></td>
                </tr>
            </table>
        </form>
    </div>
    <!--结果页快捷搜索框 结束-->
    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>新增文章</a>
                    <a href="{{url('admin/article')}}"><i class="fa fa-recycle"></i>全部文章</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc" width="5%"><input type="checkbox"></th>
                        <th class="tc">排序</th>
                        <th class="tc">ID</th>
                        <th>标题</th>
                        <th>点击</th>
                        <th>编辑</th>
                        <th>发布时间</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $v)
                        <tr>
                            <td class="tc"><input type="checkbox" name="pushcheck" value="{{$v->art_id}}"></td>

                            <td class="tc">
                                <input type="text" onchange="changeOrder(this,{{$v->art_id}})" name="ord[]"
                                       value="{{$v->art_order}}">
                            </td>
                            <td class="tc">
                                <input type="text" name="ord[]" value="{{$v->art_id}}">
                            </td>
                            <td>
                                <a href="#">{{$v->art_title}}</a>
                            </td>
                            <td class="tc">{{$v->art_view}}</td>
                            <td>{{$v->art_editor}}</td>
                            <td>{{date('Y-m-d H:m:s',$v->art_time)}}</td>
                            <td>
                                <a href="{{url('admin/article/'.$v->art_id.'/edit')}}">修改</a>
                                <a href="javascript:;" onclick="delArt({{$v->art_id}})">删除</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <div class="page_list">
                    {{$data->links()}}
                </div>
            </div>
        </div>
    </form>
    <div class="search_wrap">
        <table class="search_tab">
            <tr>
                <th width="100">选择推荐位：</th>
                <td>
                    <select name="position_id" id="select-push">
                        <option value="0">选择</option>
                        @foreach($posData as $val)
                        <option value="{{$val->pos_id}}">{{$val->pos_name}}</option>
                        @endforeach
                    </select>
                </td>
                <td><input id="position-push" type="button" value="推送"></td>
            </tr>
        </table>
    </div>
    <style>
        .result_content ul li span {
            font-size: 15px;
            padding: 6px 12px;
        }
    </style>
    <!--搜索结果页面 列表 结束-->
    <script>
        function changeOrder(obj, art_id) {
            var art_order = $(obj).val();
            $.post('{{url('admin/article/changeOrder')}}', {
                '_token': '{{csrf_token()}}',
                'art_id': art_id,
                'art_order': art_order,
            }, function (data) {
                if (data.status == 0) {
                    layer.msg(data.msg, {icon: 6});
                } else {
                    layer.msg(data.msg, {icon: 5});
                }
            });
        }

        function delArt(art_id) {
            layer.confirm('您确定要删除这篇文章吗？', {
                btn: ['确定', '取消'] //按钮
            }, function () {
                $.post("{{url('admin/article/')}}/" + art_id, {
                    '_method': 'delete',
                    '_token': '{{csrf_token()}}'
                }, function (dataDel) {
                    if (dataDel.status == 0) {
                        layer.msg(dataDel.msg, {icon: 6});
                        location.href = location.href;
                    } else {
                        layer.msg(dataDel.msg, {icon: 5});
                    }
                });
            }, function () {

            });
        }
        function search() {
            $.post('{{url('admin/article/search')}}', {
                    '_token': '{{csrf_token()}}',
                    'art_title': keywords,
                },
                function (data) {

                });
        }

        $("#position-push").click(function(){
            var id = $("#select-push").val();
            if(id==0) {
                return dialog.error("请选择推荐位");
            }
            push = {};
            postData = {};
            $("input[name='pushcheck']:checked").each(function(i){
                push[i] = $(this).val();
            });

            postData['push'] = push;
            postData['position_id']  =  id;
            postData['_token'] = '{{csrf_token()}}';
            //console.log(postData);return;
            var url = "{{url('admin/article/push')}}";
            $.post(url, postData, function(result){
                if(result.status == 1) {
                    // TODO
                    return dialog.success(result.message,result['data']['jump_url']);
                }
                if(result.status == 0) {
                    // TODO
                    return dialog.error(result.message);
                }
            },"json");
        });
    </script>

@stop