<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="Generator" content="EditPlus®">
    <meta name="Author" content="">
    <meta name="Keywords" content="">
    <meta name="Description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
    <meta name="renderer" content="webkit">
    <title></title>
    <link rel="shortcut icon" type="image/x-icon" href="/view/one/img/icon/favicon.ico">
    <link rel="stylesheet" type="text/css" href="/view/one/css/base.css">
    <link rel="stylesheet" type="text/css" href="/view/one/css/home.css">
    <link rel="stylesheet" type="text/css" href="/view/validform/style.css">
    <script src="http://cdn.bootcss.com/jquery/3.2.1/jquery.js"></script>
    <script src="/view/validform/js/Validform_v5.3.2.js"></script>

    <script type="text/javascript" src="/admin/js/register.js"></script>
    <script type="text/javascript" src="/admin/js/epii.js"></script>
    <script type="text/javascript" src="/admin/layui/layui.all.js"></script>
</head>
<body>

<header id="pc-header">
    <div class="center">
        <div class="pc-fl-logo">
            <h1>
                <a href="index.html"></a>
            </h1>
        </div>
    </div>
</header>
<section>
    <div class="pc-login-bj">
        <div class="center clearfix">
            <div class="fl"></div>
            <div class="fr pc-login-box">
                <div class="pc-login-title"><h2>用户登录</h2></div>
                <form class="loginform" action="/view/member/login" method="post">
                    <div class="pc-sign">
                        <input type="text" name="username" data-reg={reg:/^[\s\S]+$/,errormsg:'用户名/邮箱/手机号不能为空'} placeholder="用户名/邮箱/手机号">
                    </div>
                    <div class="pc-sign">
                        <input type="password" name="password" data-reg={reg:/^[1-9|a-z|A-Z]{1,2000}$/,errormsg:'请输入您的密码！'} placeholder="请输入您的密码">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                    </div>
                    <div class="pc-submit-ss">
                        <input type="submit" class="sub"   value="登录" placeholder="">
                    </div>
                    {{--<div class="pc-item-san clearfix">--}}
                    {{--<a href="#"><img src="/view/one/img/icon/weixin.png" alt="">微信登录</a>--}}
                    {{--<a href="#"><img src="/view/one/img/icon/weibo.png" alt="">微博登录</a>--}}
                    {{--<a href="#" style="margin-right:0"><img src="/view/one/img/icon/tengxun.png" alt="">QQ登录</a>--}}
                    {{--</div>--}}
                    <div class="pc-reg">
                        <a href="#">忘记密码</a>
                        <a href="/view/member/register" class="red">免费注册</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script>
    {{--$('input[name="username"]').blur(function(){--}}
        {{--$.ajax({--}}
                {{--url: '/view/member/isuser',--}}
                {{--data: {--}}
                    {{--username:$('input[name="username"]').val(),--}}
                    {{--_token: "{{csrf_token()}}"--}}
                {{--},--}}
                {{--type: 'post',--}}
                {{--dataType: 'json',--}}
                {{--async:false,--}}
                {{--success: function (data) {--}}
                    {{--if(data.status*1 !== 1){--}}
                        {{--layer.open({--}}
                            {{--title: '提示',--}}
{{--//                            shadeClose:true,//点击遮罩关闭--}}
                            {{--content: data.message,--}}
                            {{--yes:function(){--}}
                                {{--$('input[name="username"]').val('').focus();--}}
                                {{--layer.closeAll();--}}
                            {{--},--}}
                            {{--cancel: function(){--}}
                                {{--$('input[name="username"]').val('').focus();--}}
                                {{--//右上角关闭回调--}}
                                {{--// window.location.href='/admin/goods/goods/index';--}}
                            {{--}--}}
                        {{--});--}}
                    {{--}--}}
                {{--}--}}
            {{--});--}}
    {{--});--}}
    $('form').submit(function () {
        return false;
    });
    //登录
        jcj_validate($('.loginform'),function(data){
            if(data.status === 1){
                //提示
                setTimeout(function(){
                    window.location.href='/view/home/index';
                },100)
            }else{
                layer.open({
                    content: data.message
                    ,skin: 'msg'
                    ,time: 2000 //2秒后自动关闭
                });
                setTimeout(function(){
                    window.location.reload();
                },1000)
            }
        });


</script>
<footer>
    <div class="center">
        <div class="pc-footer-login">
            <p>关于我们 招聘信息 联系我们 商家入驻 商家后台 商家社区 ©2017 Yungouwu.com 北京云购物网络有限公司</p>
            <p style="color:#999">营业执照注册号：990106000129004 | 网络文化经营许可证：北网文（2016）0349-219号 | 增值电信业务经营许可证：京2-20110349 |
                安全责任书 | 京公网安备 99010602002329号 </p>
        </div>
    </div>
</footer>
<script>

</script>
</body>
</html>