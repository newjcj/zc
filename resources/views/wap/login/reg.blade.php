@extends('wap.master.index')
@section('title','注册')
@section('head')
    <meta charset="UTF-8" />
    <title>用户注册</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <link rel="stylesheet" type="text/css" href="/wap/css/center.css" />
    <link rel="stylesheet" type="text/css" href="/wap/css/loaders.min.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/loading.css"/>
    <link rel="stylesheet" type="text/css" href="/view/validform/style.css"/>
    <script src="/wap/js/rem.js"></script>
    <script src="/wap/js/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/admin/js/register.js"></script>

    <script type="text/javascript" src="/view/validform/Validform_v5.3.2.js"></script>

<style>
    ::-webkit-input-placeholder { /* WebKit browsers */
        color: #999;
    }
</style>
    <script type="text/javascript">
        sessionStorage.url = "confirm";
        $(window).load(function(){
            $(".loading").addClass("loader-chanage")
            $(".loading").fadeOut(300)
        })
    </script>

@endsection
@section('content')
    <form action="/wap/user/register" class="registerform" method="post" >
    <div style=" height: 100%; width: 100%; ">
        <img src="/wap/images/regist.jpg" style=" width: 100%; height: 100%; background-size: cover; position: absolute; z-index: -1;">
        <div style=" position: absolute; z-index: 1; border-bottom: #d9d9d9 1px solid; width: 340px; height: 40px;  margin-left: 10px; margin-top: 20px;">
           <div style=" border: black 0px solid; width: 100px; height: 20px; margin-left: 130px; ">
             <span style="opacity: 1;"><b><font size="+1">用户注册</font></b></span>
           </div>
        </div>

        <div style=" position: absolute; z-index: 1; border-bottom: #d9d9d9 1px solid; width: 340px; height: 40px;  margin-left: 10px; margin-top: 60px; opacity: 0.5;">

        </div>

        <div style=" position: absolute; z-index: 1; border-bottom: #d9d9d9 1px solid; width: 340px; height: 40px;  margin-left: 10px; margin-top: 100px;">
            <div style=" border: black 0px solid; width: 300px; height: 20px; margin-left: 10px; margin-top: 8px;  ">
                <font >手机号：</font><input type="text" name="phone" onclick="" datatype="phone"   ajaxurl="/wap/login/checkphone1?_token={{csrf_token()}}" onblur="_cphone(this,1)"  placeholder="请输入手机号" style= "border: 0px; width:180px;height:28px;  background: none; font-size: 13px; " >
                <input type="button" name=""  id="sendbtn" value="发送验证码" data-status="n" onclick="_mscode(this)" style="border:solid 1px #ccc;background:none; width: 80px; height: 30px; margin-left: 250px; margin-top: -30px;">
            </div>
        </div>

        <div style=" position: absolute; z-index: 1; border-bottom: #d9d9d9 1px solid; width: 340px; height: 40px;  margin-left: 10px; margin-top: 145px;">
            <div style=" border: black 0px solid; width: 300px; height: 20px; margin-left: 10px; margin-top: 8px;  ">
                <font>验证码：</font><input type="text" name="code" datatype="code" onfocus="_ccode(this)" ajaxurl=""  placeholder="请输入短信验证码" style="border: 0px; width:180px;height:28px;  background: none; font-size: 13px;">
            </div>
        </div>

        <div style=" position: absolute; z-index: 1; border-bottom: #d9d9d9 1px solid; width: 340px; height: 40px;  margin-left: 10px; margin-top: 190px;">
            <div style=" border: black 0px solid; width: 350px; height: 20px; margin-left: 10px; margin-top: 8px;  ">
                <font >请输入登录密码：</font><input type="password" datatype="password" name="password" onclick="" onblur="" placeholder="请输入登录密码" style="border: 0px; width:180px;height:28px;  background: none; font-size: 13px;">
            </div>
        </div>

        <div style=" position: absolute; z-index: 1; border-bottom: #d9d9d9 1px solid; width: 340px; height: 40px;  margin-left: 10px; margin-top: 235px;">
            <div style=" border: black 0px solid; width: 350px; height: 20px; margin-left: 10px; margin-top: 8px;  ">
                <font >请再次输入密码：</font><input type="password" datatype="password" name="repassword" recheck="password" onclick="" onblur="" placeholder="请输入登录密码" style="border: 0px; width:180px;height:28px;  background: none; font-size: 13px;">
            </div>
        </div>

        <div style=" position: absolute; z-index: 1; border-bottom: #d9d9d9 0px solid; width: 340px; height: 40px;  margin-left: 10px; margin-top: 280px;">
            <div style=" border: black 0px solid; width: 350px; height: 20px; margin-left: 10px; margin-top: 8px;  ">
                <input type="submit" class="sub" value="立即注册" style="border:solid 1px #ea583b;background: #ea583b;color:white;width:300px; font-size: 16px; height: 30px;">
            </div>
        </div>
        <div style=" position: absolute; z-index: 1; border-bottom: #d9d9d9 0px solid; width: 340px; height: 40px;  margin-left: 10px; margin-top: 320px;">
            <div style=" border: black 0px solid; width: 350px; height: 20px; margin-left: 180px; margin-top: 8px;  ">
                <span><font size="-2"> <a href="/wap/login/login" style="width:100%;text-align:center;">已有账号？切换到登录</a></font></span>
            </div>
        </div>
    </div>
    </form>

@endsection

@section('script')
    <script>
        $(function(){
            //$(".registerform").Validform();  //就这一行代码！;
            var demo=$(".registerform").Validform({
                tiptype:3,
                label:".label",
                showAllError:true,
                tipSweep:false,
                datatype:{
                    "zh1-6":/^[\u4E00-\u9FA5\uf900-\ufa2d]{1,6}$/,
                    'phone':/^[\d]{11}$/,
                    'password':/^[\w]{6,30}$/,
                    'code':/^[\d]{4}$/,
                },
                ajaxPost:false,
                callback:function(data){
                    //执行注册
                    $.ajax({
                        url: '/view/member/registerwap',
                        data: {
                            username:$('input[name="phone"]').val(),
                            password:$('input[name="password"]').val(),
                            code:$('input[name="code"]').val(),
                            _token: "{{csrf_token()}}"
                        },
                        type: 'post',
                        dataType: 'json',
                        async:false,
                        success: function (data) {
                            if(data.status===1){
                                layer.msg(data.message,{time:1000},function(){
                                    window.location.href='/wap/user/center';
                                });
                            }else if(data.status === 2){
                                layer.msg(data.message,{time:1000});
                            }else{
                                layer.msg(data.message,{time:1000});
                            }
                        }
                    });
                    return false;
                }
            });

            //通过$.Tipmsg扩展默认提示信息;
            //$.Tipmsg.w["zh1-6"]="请输入1到6个中文字符！";
            demo.tipmsg.w["zh1-6"]="请输入1到6个中文字符！";
            demo.tipmsg.w["phone"]="请输入正确的手机号！";
            demo.tipmsg.w["code"]="请输入4位数验证码！";
            demo.tipmsg.w["password"]="请输入6位以上密码";

            demo.addRule([{
                ele:".inputxt:eq(0)",
                datatype:"zh2-4"
            },
                {
                    ele:".inputxt:eq(1)",
                    datatype:"*6-20"
                },
                {
                    ele:".inputxt:eq(2)",
                    datatype:"*6-20",
                    recheck:"userpassword"
                },
                {
                    ele:"select",
                    datatype:"*"
                },
                {
                    ele:":radio:first",
                    datatype:"*"
                },
                {
                    ele:":checkbox:first",
                    datatype:"*"
                }]);

        });
        //执行发送
        _dosendcode=function(){
            if($('#sendbtn').val() === '发送验证码'){
                $('#sendbtn').attr('data-status','y');
                var i=60;
                var ds=setInterval(function(){
                    var str=i+'s后发送';
                    $('#sendbtn').val(str);
                    i--;
                    if(i === 0){
                        clearInterval(ds);
                        $('#sendbtn').attr('data-status','n').val('发送验证码');
                    }
                },1000);
            }

        };
        $('#sendbtn').css({display:'none'});
        //手机存在的提示
        _hasphoneinfo=function(obj){
            if($('.Validform_checktip').text() !== '请输入正确的手机号！' && $('.Validform_checktip').text() !== '请填写信息！' ){
                $('.Validform_checktip').each(function(i,obj){
                    $(obj).html("<span style='color:red;'>手机号注册过</span>");
                    //让验证码不能发送
                    $('#sendbtn').attr('data-status','y');
                    $('#sendbtn').css({display:'none'});
                    return false;
                });
            }

        };
        //验证验证码
        _ccode=function(obj){
            $(obj).attr( 'ajaxurl','/test/jcj?_token={{csrf_token()}}&phone='+$('input[name="phone"]').val() );
            if($(obj).attr('class') === 'Validform_error'){
                console.log(222);
            }else{
                console.log(111);
            }
        };
        //验证手机是不是存在
        _cphone=function(obj,i){
            var sendT = setInterval(function(){
                if($(obj).attr('class') === 'Validform_error'){
                    //手机存在
                    _hasphoneinfo(obj);
                }else{
                    console.log(331);
                    //手机 不存在
                    //让验证码能发送
                    $('#sendbtn').attr('data-status','n');
                    $('#sendbtn').css({display:'block'});
                }
            },1000);
        };
        //jq输入事件监听
        $('input[name="phone"]').keypress(function(){
            if($(this).val().length == 10){
                console.log(2);
                _cphone(this);
            }
        });
        //发送验证码
        _mscode=function(obj){
            //ajax判断手机存不存在
            if($('input[name="phone"]').val().length === 11 && $('#sendbtn').attr('data-status') === 'n'){

                //手机不存在
                _dosendcode();
                //发送验证码
                $.ajax({
                    url: '/view/member/sendcode1',
                    data: {
                        phone:$('input[name="phone"]').val(),
                        _token: "{{csrf_token()}}"
                    },
                    type: 'post',
                    dataType: 'json',
                    async:false,
                    success: function (data) {

                    }
                });


            }



        };


    </script>

@endsection