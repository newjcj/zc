@extends('wap.master.index')
@section('title','订单列表')
@section('head')
    <link rel="stylesheet" type="text/css" href="/wap/css/center.css" />
    <link rel="stylesheet" type="text/css" href="/wap/css/loaders.min.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/loading.css"/>
    <script src="/wap/js/rem.js"></script>
    <script src="/wap/js/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/admin/js/register.js"></script>
    <script type="text/javascript" src="/view/validform/Validform_v5.3.2.js"></script>
    <script type="text/javascript">
        sessionStorage.url = "confirm";
        $(window).load(function(){
            $(".loading").addClass("loader-chanage");
            $(".loading").fadeOut(300)
        })
    </script>

    <style type="text/css">
        input[type=button], input[type=submit], input[type=file], button { cursor: pointer; -webkit-appearance: none; }
        .pcont{

        }
        .cont{
            /*display:inline-block;width:270px;*/
            display:flex;
        }
        .cont input[name='phone']{
            display:inline-block;width:150px;
        }
        .cont input[type='button']{
            width: 80px; height: 30px; margin-top:8px;border:solid 1px #ccc;background:none;
        }
    </style>
@endsection

@section('content')
    <header id="header" style="">
        <div class="topbar" style=" background-color: #f5655c;">
            <a href="javascript:history.back();" class="back_btn"><i class="iconfont">ş</i></a>
            <h1 class="page_title">支付密码设置</h1>
        </div>
    </header>
    <!-- 会员俱乐部 -->
    <div class="vip-club border_top_bottom vip-account">
        {{--全部订单--}}
        <form action="/wap/user/addpwd" method="post" class="registerform">
            <div class="vip-club border_top_bottom" >
                <div style="" class="pcont">
                    <div class="vip-club-title border_bottom cont">
                        手机号&nbsp;&nbsp;&nbsp;&nbsp;<input id="phone" datatype="phone" name="phone"  ajaxurl="/wap/login/checkphone2?_token={{csrf_token()}}" onblur="_cphone(this,1)" placeholder="请输入手机号码" style=" font-size: 12px; border: 0px; background: none;" >&nbsp;
                        &nbsp;<input type="button" name="scod" style=""  id="sendbtn"  value="发送验证码" data-status="n" onclick="_mscode(this)">
                    </div>
                    <div><span></span></div>
                </div>

                <div class="vip-club-title border_bottom">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    验证码&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="code" datatype="code" placeholder="请输入收到的验证码" style=" font-size: 12px; border: 0px;" >
                </div>
                <div class="vip-club-title border_bottom">
                    设置支付密码&nbsp;&nbsp;&nbsp;<input type="password" id="password" name="password" placeholder="请输入密码" style=" font-size: 12px; border: 0px;" >
                </div>
                <div class="vip-club-title border_bottom">
                    确认支付密码&nbsp;&nbsp;&nbsp;<input type="password"  name="repassword" onclick="" recheck="password" placeholder="请再次输入密码" style=" font-size: 12px; border: 0px;" >
                </div>
                <div class="vip-club-title border_bottom">
                    <input type="submit" id="tj" class="sub" style="  font-size: 17px; border: 0px; border-radius: 6px; margin-left: 90px; width: 200px; height: 32px; background-color: #f5655c; color: white" value="确&nbsp;&nbsp;定">
                </div>
            </div>
        </form>
    </div>
    <input type="hidden" id="orders" value="{{$orders}}" >
    <br><br><br><br><br><br>
@endsection

@section('script')
    <script>
        $(function(){
            //$(".registerform").Validform();  //就这一行代码！;
            var demo=$(".registerform").Validform({
                tiptype:2,
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
                    //执行设置支付密码
                    $.ajax({
                        url: '/wap/user/addpwd',
                        data: {
                            phone:$('input[name="phone"]').val(),
                            paypwd: $("#password").val(),
                            code:$('input[name="code"]').val(),
                            _token: "{{csrf_token()}}"
                        },
                        type: 'post',
                        dataType: 'json',
                        async:false,
                        success: function (data) {
                            if(data.status===1){
                                layer.msg(data.message,{time:1000},function(){
                                    location.href="/wap/order/payway?orders="+$("#orders").val();
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
        //手机存在的提示
        _hasphoneinfo=function(obj){
            if($('.Validform_checktip').text() !== '请输入正确的手机号！' && $('.Validform_checktip').text() !== '请填写信息！' ){
                $('.Validform_checktip').each(function(i,obj){
                    $(obj).html("<span style='color:red;'>手机不存在</span>");
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