@extends('layouts.admin')
@section('content')
        <!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 推荐位内容管理
</div>
<!--面包屑导航 结束-->

<!--结果集标题与导航组件 开始-->
<div class="result_wrap">
    <div class="result_title">
        <h3>推荐位内容管理</h3>
        @if(count($errors)>0)
            <div class="mark">
                @if(is_object($errors))
                    @foreach($errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                @else
                    <p>{{$errors}}</p>
                @endif
            </div>
        @endif
    </div>
    <div class="result_content">
        <div class="short_wrap">
            <a href="{{url('admin/positionData/create')}}"><i class="fa fa-plus"></i>添加新内容</a>
            <a href="{{url('admin/positionData')}}"><i class="fa fa-recycle"></i>全部内容</a>
        </div>
    </div>
</div>
<!--结果集标题与导航组件 结束-->

<div class="result_wrap">
    <form action="{{url('admin/positionData')}}" method="post">
        {{csrf_field()}}
        <table class="add_tab">
            <tbody>
            <tr>
                <th><i class="require">*</i>标题名称：</th>
                <td>
                    <input type="text" name="pcon_title">
                    <span><i class="fa fa-exclamation-circle yellow"></i>标题名称必须填写</span>
                </td>
            </tr>

            <tr>
                <th><label for="inputname" class="col-sm-2 control-label">选择推荐位:</label></th>
                <td>
                    <select name="position_id">
                        @foreach($posData as $val)
                            <option value="{{$val->pos_id}}">{{$val->pos_name}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>

            <tr>
                <th></th>
                <td>
                    <img src="" id="art_thumb_img" style="max_witdh:350px;max-height: 100px">
                </td>
            </tr>
            <tr>
                <th>缩略图：</th>
                <td>
                    <style>
                        .uploadify{display:inline-block;}
                        .uploadify-button{border:none; border-radius:5px; margin-top:8px;}
                        table.add_tab tr td span.uploadify-button-text{color: #FFF; margin:0;}
                    </style>
                    <input type="text" size="50" name="art_thumb">
                    <input id="file_upload" name="file_upload" type="file" multiple="true">
                    <script src="{{asset('news/org/uploadify/jquery.uploadify.min.js')}}" type="text/javascript"></script>
                    <link rel="stylesheet" type="text/css" href="{{asset('news/org/uploadify/uploadify.css')}}">
                    <script type="text/javascript">
                        <?php $timestamp = time();?>
                        $(function() {
                            $('#file_upload').uploadify({
                                'buttonText':'图片上传',
                                'formData'     : {
                                    'timestamp' : '<?php echo $timestamp;?>',
                                    '_token'     : "{{csrf_token()}}"
                                },
                                'swf'      : "{{asset('news/org/uploadify/uploadify.swf')}}",
                                'uploader' : "{{url('admin/upload')}}",
                                'onUploadSuccess' : function (file,data,response) {
                                    $('input[name=art_thumb]').val(data);
                                    $('#art_thumb_img').attr('src',data);
                                }
                            });
                        });
                    </script>
                </td>
            </tr>
            <tr>
                <th> Url：</th>
                <td>
                    <input type="text" class="lg" name="pcon_url" value="http://">
                </td>
            </tr>
            <tr>
                <th>文章id：</th>
                <td>
                    <input type="text" class="sm" name="art_id" value="0">
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <input type="submit" value="提交">
                    <input type="button" class="back" onclick="history.go(-1)" value="返回">
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>

@endsection
