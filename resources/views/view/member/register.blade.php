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
				<div class="pc-login-title"><h2>用户注册</h2></div>
				<form action="">
					<div class="pc-sign">
						<input type="text" name="phone" placeholder="手机号" onclick="_cphone(this)" onblur="_cphone(this)">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<span style="color:red;display:none" class="info"></span>
					</div>
					<div class="pc-sign">
						<input type="text" name="username" placeholder="用户名" onclick="_cusername(this)" onblur="_cusername(this)">
						<span style="color:red;display:none" class="info"></span>
					</div>
					<div class="pc-sign">
						<input type="password" name="password" placeholder="请输入您的密码" onclick="_password(this)" onblur="_password(this)">
						<span style="color:red;display:none" class="info"></span>
					</div>
					<div class="pc-sign">
						<input type="password" name='repassword' placeholder="请确认您的密码" onclick="_repassword(this)" onblur="_repassword(this)">
						<span style="color:red;display:none" class="info"></span>
					</div>
					<div class="pc-sign">
						<input type="password" style="width:200px;" name="code"   placeholder="请输入您的验证码" onclick="_ccode(this)" onblur="_ccode(this)">
						<input type="button" style="display:inline-block;width:130px;"  value="发送验证码" data-status="n" onclick="_mscode(this)" placeholder="">
						<span style="color:red;display:none" class="info"></span>
					</div>
					<div class="pc-submit-ss">
						<input type="submit" class="sub" value="立即注册" placeholder="">
					</div>
                    <?php /*<div class="pc-item-san clearfix">*/ ?>
                    <?php /*<a href="#"><img src="/view/one/img/icon/weixin.png" alt="">微信登录</a>*/ ?>
                    <?php /*<a href="#"><img src="/view/one/img/icon/weibo.png" alt="">微博登录</a>*/ ?>
                    <?php /*<a href="#" style="margin-right:0"><img src="/view/one/img/icon/tengxun.png" alt="">QQ登录</a>*/ ?>
                    <?php /*</div>*/ ?>
					<div class="pc-reg">

						<a href="/view/member/login" class="red">已有账号 请登录</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<footer>
	<div class="center">
		<div class="pc-footer-login">
			<p>关于我们 招聘信息 联系我们 商家入驻 商家后台 商家社区 ©2017 Yungouwu.com 北京云购物网络有限公司</p>
			<p style="color:#999">营业执照注册号：990106000129004 | 网络文化经营许可证：北网文（2016）0349-219号 | 增值电信业务经营许可证：京2-20110349 | 安全责任书 | 京公网安备 99010602002329号 </p>
		</div>
	</div>
</footer>
<script>
    var status=false;
    var isuser=false;//用户是否存在
    _cphone=function(obj){
        var info = $(obj).parent('div').find('.info').css('display','block');
        var re=/^[\d]{11}$/;
        if(!re.test($(obj).val())){
            status=false;
            isuser=false;
            info.html('手机格式不对');
        }else{
            $.ajax({
                url: '/view/member/checkphone',
                data: {
                    username:$(obj).val(),
                    _token: "<?php echo e(csrf_token()); ?>"
                },
                type: 'post',
                dataType: 'json',
                async:false,
                success: function (data) {
                    console.log(data);
                    if(data.status === 1){
                        status=false;
                        isuser=false;
                        info.html('用户已经存在');
                    }else{
                        status=true;
                        isuser=true;
                        info.css({display:'none'});
                    }
                }
            });
        }
    };
    _cusername=function(obj){
        var info = $(obj).parent('div').find('.info').css('display','block');
        var re=/.+/;
        if(!re.test($(obj).val())){
            status=false;
            info.html('输入不能为空');
        }else{
            $.ajax({
                url: '/view/member/checkname',
                data: {
                    username:$(obj).val(),
                    _token: "<?php echo e(csrf_token()); ?>"
                },
                type: 'post',
                dataType: 'json',
                async:false,
                success: function (data) {
                    console.log(data);
                    if(data.status === 1){
                        info.html('用户已经存在');
                    }else{
                        status=true;
                        info.css({display:'none'});
                    }
                }
            });
        }
    }
    _password=function(obj){
        var info = $(obj).parent('div').find('.info').css('display','block');
        var re=/.+/;
        if(!re.test($(obj).val())){
            status=false;
            info.html('输入不能为空');
        }else{
            status=true;
            info.css({display:'none'});
        }
    }
    _repassword=function(obj){
        var info = $(obj).parent('div').find('.info').css('display','block');
        var re=/.+/;
        if(!re.test($(obj).val())){
            status=false;
            info.html('输入不能为空');
        }else if( $(obj).val() !== $('input[name="password"]').val() ){
            status=false;
            info.html('两次密码不一样');
        }else{
            status=true;
            info.css({display:'none'});
        }
    }
    var mscode=false;
    _mscode=function(obj){
        var info = $(obj).parent('div').find('.info').css('display','block');
        var re=/^[\d]{11}$/;
        if(  !re.test( $('input[name="phone"]').val() ) ){
            status=false;
            info.html('手机格式不对');
            $('input[name="phone"]').focus();
        }else if(isuser == false){
            console.log(55);
            return false;
//            info.html('手机格式不对');
        }else if($('obj').data('status') === 'y' ){
            return false;
        }else{
            $('input[type="button"]').attr('data-status','y');
            var num = 3;
            var st = setInterval(function(){
                if(num < 1){
                    $('input[type="button"]').attr('data-status','n').val('发送验证码');
                    clearInterval(st);
                }else{
                    $('input[type="button"]').val(num+'s后发送');
                    num--;
                }
            },1000);

        }
    }
    _ccode=function(obj){
        var info = $(obj).parent('div').find('.info').css('display','block');
        var re=/.+/;
        var re2=/^[\d]{6}$/;
        var re1=/^[\d]{11}$/;
        if(  !re1.test( $('input[name="phone"]').val() ) ){
            status=false;
//            info.html('手机格式不对');
            $('input[name="phone"]').focus();
        }else if(!re.test( $('input[name="code"]').val()) ){
            status=false;
            info.html('输入不能为空');
        }else if(  !re2.test( $('input[name="code"]').val() )  ){
            status=false;
            info.html('输入6位');
		}else{
            $.ajax({
                url: '/view/member/checkcode',
                data: {
                    phone:$('input[name="phone"]').val(),
                    code:$('input[name="code"]').val(),
                    _token: "{{ csrf_token() }}"
                },
                type: 'post',
                dataType: 'json',
                async:false,
                success: function (data) {
                    console.log(data);
                    if(data.status === 1){
                        status=true;
                        info.html('验证通过');
                    }else{
                        status=true;
                        info.css({display:'none'});
                    }
                }
            });
        }
    }
    $('form').submit(function(){
        var param = $('form').serialize();
		if(status === 'true'){
		    console.log(33);
		    $.ajax({
		            url: '/view/member/register',
		            data: param,
		            type: 'post',
		            dataType: 'json',
		            async:false,
		            success: function (data) {
		                if(data.status === 1){
		                    console.log(data);
		                    console.log(data.returnurl);
                            layer.open({
                                title: '提示',
                                shadeClose:true,//点击遮罩关闭
                                content: data.message,
                                yes:function(){
                                    layer.closeAll();
                                     window.location.href=data.returnurl;
                                },
                                cancel: function(){
                                    //右上角关闭回调
                                    window.location.href=data.returnurl;
                                }
                            });
						}else{
                            layer.open({
                                title: '提示',
                                shadeClose:true,//点击遮罩关闭
                                content: data.message,
                                yes:function(){
                                    layer.closeAll();
//                                    window.location.reload();
                                },
                                cancel: function(){
                                    //右上角关闭回调
//                                    window.location.reload();
                                }
                            });
						}
		            }
		        });
		}
        return false;
    });
</script>
</body>
</html>