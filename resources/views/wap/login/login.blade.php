@extends('wap.master.index')
@section('title','登录')
@section('head')
    <link rel="stylesheet" type="text/css" href="/wap/css/center.css" />
    <link rel="stylesheet" type="text/css" href="/wap/css/loaders.min.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/loading.css"/>
    <script src="/wap/js/rem.js"></script>
    <script src="/wap/js/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/admin/js/register.js"></script>
    <script type="text/javascript">
        sessionStorage.url = "confirm";
        $(window).load(function(){
            $(".loading").addClass("loader-chanage")
            $(".loading").fadeOut(300)
        })
    </script>
    <style>
        input:: placeholder { /* Mozilla Firefox 19+ */
            font-size:2px;
        }
    </style>
@endsection

@section('content')
    <div style="height: 100%; width: 100%;">
        <form action="/wap/login/login" method="post" class="loginform">
            <img src="/wap/images/login.png" style=" width: 100%; height: 100%; background-size: cover; position: absolute; z-index: -1;">
            <div style=" position: absolute; z-index: 1;  width: 20%;  left: 40%; top: 70px;">
                <img src="/wap/images/login1.png"  id="head" style=" width: 70px; height: 70px; border-radius:70%; overflow: hidden;" >
            </div>
            <div style=" position: absolute; z-index: 1;  border: #7e8691 solid 1px; width: 80%; left: 10%; top: 180px; height: 40px;">
                <img src="/wap/images/account.png"  style=" border: #0E1112 solid 0px;  width: 285px; height: 40px;  " >
                <div style=" border: black solid 0px; width: 182px; height: 30px; float: left; margin-left: 60px; margin-top: -40px; position: absolute; z-index: 1;">
                    <input style=" color: grey;  width: 220px; height: 30px; background: none; border: 0px; font-size: 15px; " id="username" onblur="show();" type="text" name="username"  placeholder="请输入手机号/邮箱/用户名" data-reg={reg:/^[\s\S]+$/,errormsg:'用户名/邮箱/手机号不能为空'}>
                </div>
            </div>

            <div style=" position: absolute; z-index: 1;  border: #7e8691 solid 1px; width: 80%; left: 10%; top: 245px; height: 40px;">
                <img src="/wap/images/pwd.png" style=" width: 285px; height: 40px;" >
                <div style=" border: black solid 0px; width: 182px; height: 30px; float: left; margin-left: 60px; margin-top: -40px; position: absolute; z-index: 1;">
                    <input style=" color: grey;  width: 220px; height: 30px; background: none; border: 0px; font-size: 15px; "  type="password" name="password" placeholder="请输入登录密码" data-reg={reg:/^.{1,2000}$/,errormsg:'请输入您的密码！'}>
                </div>
            </div>

            <div style=" position: absolute; z-index: 1;  border: #7e8691 solid 0px; width: 94%; left: 3%; top: 300px;">
                <div style=" border: black solid 0px; width: 80%; left: 5%;  float: left; top: 5px; position: absolute; z-index: 1;">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="submit" class="sub" value="登&nbsp;&nbsp;录" style=" border:solid 0px #ea583b; border-radius: 5px; background: #ea583b;color:white;width: 110%; height: 40px; font-size: 15px;">
                </div>
            </div>

            <div style=" position: absolute; z-index: 1;  border: #7e8691 solid 0px; width: 160px; height: 40px; margin-left: 175px; margin-top: 350px;">
                <a href="/wap/login/reg" style="width:100%;text-align:center; font-size: 15px;">还没有账号？立即注册</a>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>

        var return_url="{{$return_url}}";
        $('form').submit(function () {
            return false;
        });
        //登录
        jcj_validate($('.loginform'),function(data){
            if(data.status === 1){
                //提示
                setTimeout(function(){
                    if(return_url != ''){
                        window.location.href = return_url;
                    }else{
                        window.location.href = data.returnurl;
                    }
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
@endsection