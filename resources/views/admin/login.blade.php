<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{asset('news/admin/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('news/admin/font/css/font-awesome.min.css')}}">
    <script src="{{asset('news/admin/js/jquery.js')}}"></script>
    <script src="{{asset('news/org/layer/layer.js')}}"></script>
    <script src="{{asset('news/org/dialog.js')}}"></script>
</head>
<body style="background:#F3F3F4;">
<div class="login_box">
    <h1>news</h1>
    <h2>欢迎使用新闻管理平台</h2>
    <div class="form">
        <form action="#" method="post">
            {{csrf_field()}}
            <ul>
                <li>
                    <input type="text" name="user_name" class="text"/>
                    <span><i class="fa fa-user"></i></span>
                </li>
                <li>
                    <input type="password" name="user_pass" class="text"/>
                    <span><i class="fa fa-lock"></i></span>
                </li>
                <li>
                    <input type="text" name="code" class="code"/>
                    <span><i class="fa fa-check-square-o"></i></span>
                    <img src="{{url('admin/code')}}" onclick="this.src='{{url('admin/code')}}?'+Math.random()">
                </li>
                <li>
                    <input type="button" class="button" onclick="login.check()" value="立即登陆" style="font-family:微软雅黑; width:240px;height: 33px; border-radius: 3px;color: #fff;background: #337ab7;
                    border: 1px solid #2e6da4"/>
                </li>
            </ul>
        </form>
        <p><a href="#">返回首页</a> &copy; 2017 Powered by <a href="http://www.news.com" target="_blank">yhb</a></p>
    </div>
</div>
	<script>
        var login = {
            check : function() {
                // 获取登录页面中的用户名 和 密码
                var user_name = $('input[name="user_name"]').val();
                var user_pass = $('input[name="user_pass"]').val();
                var code = $('input[name="code"]').val();
                if (!user_name) {
                    return dialog.error('用户名不能为空！');
                }
                if (!user_pass) {
                    return dialog.error('密码不能为空！');
                }
                if (!code) {
                    return dialog.error('验证码不能为空！');
                }
                var url = "{{url('admin/login')}}";
                var data = {'_token': '{{csrf_token()}}', 'user_name': user_name, 'user_pass': user_pass, 'code': code};
                // 执行异步请求  $.post
                if ( !user_name || !user_pass || !code) {
                    return dialog.error('请将信息填写完全');
                }else{
                    $.post(url, data, function (result) {
                        if (result.status == 0) {
                            return dialog.error(result.message);
                        }
                        if (result.status == 1) {
                            return dialog.success(result.message,'{{url('admin/index')}}');
                        }

                    }, 'JSON');
                }
            }
        }
	</script>
</body>
</html>