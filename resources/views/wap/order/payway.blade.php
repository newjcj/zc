@extends('wap.master.index')
@section('title','确认支付')
@section('head')
	<link rel="stylesheet" type="text/css" href="../css/base.css"/>
	<link rel="stylesheet" type="text/css" href="../css/zhifu.css"/>
	<link rel="stylesheet" type="text/css" href="../css/mui.min.css"/>
	<link rel="stylesheet" type="text/css" href="../css/loaders.min.css"/>
	<link rel="stylesheet" type="text/css" href="../css/loading.css"/>
	<script src="../js/rem.js"></script>
	<script src="../js/jquery.min.js" type="text/javascript"></script>
	<script type="text/javascript">
        $(window).load(function(){
            $(".loading").addClass("loader-chanage")
            $(".loading").fadeOut(300)
        })
        $(function(){
            //计算内容上下padding
            reContPadding({main:"#main",header:"#header",footer:"#footer"});
            function reContPadding(o){
                var main = o.main || "#main",
                    header = o.header || null,
                    footer = o.footer || null;
                var cont_pt = $(header).outerHeight(true),
                    cont_pb = $(footer).outerHeight(true);
                $(main).css({paddingTop:cont_pt,paddingBottom:cont_pb});
            }
        });
	</script>
	<style>
		input[type='password']{
			width:45%;
			height:15px;
			float:right;
			display:inline-block;
			margin-top:-2px;
		}
	</style>
	</head>
	<!--loading页开始-->
	<div class="loading">
		<div class="loader">
			<div class="loader-inner pacman">
				<div></div>
				<div></div>
				<div></div>
				<div></div>
				<div></div>
			</div>
		</div>
	</div>
	<!--loading页结束-->
	<body>
	<header class="mui-bar mui-bar-nav report-header box-s" id="header" style=" background-color: #f5655c;">
		<a href="javascript:history.go(-1)"><i class="iconfont icon-fanhui fl"></i></a>
		<p><font color="white">订单支付</font></p>
	</header>
	<div id="main" class="mui-clearfix contaniner sorder">
		<div class="warning clearfloat box-s" style="text-align:center;font-size:0.4rem;">
			<div style="width:50%;float:left;line-height:30px;">
				<img src="/wap/images/ico_money.png" style="height:20px;"> 账户余额<br>{{$user->money/100}}
			</div>
			<div style="width:50%;float:left;line-height:30px;">
				<img src="/wap/images/ico_coin.png" style="height:20px;"> 商城积分<br>{{$user->shop_coin/100}}
			</div>
		</div>
		<div class="odernum clearfloat" style="font-size:0.3rem;">
			<ul>
				<li style="text-align:right">订单总额:<span style="color:#f60">￥{{$allorderprice/100}}元</span></li>
				<li style="font-size:0.4rem;" onclick="chk(1)">使用商城积分<span id="as1" style="font-size:0.4rem;">{{$user->shop_coin/100}}</span>分抵用<span style="font-size:0.4rem;">{{$user->shop_coin/100}}元</span><img src="/wap/images/ico_yes.png" id="chk1" style="float:right;width:20px;"></li>
				<li style="font-size:0.4rem;" onclick="chk(2)">使用账户余额<span id="as2" style="font-size:0.4rem;">{{$user->money/100}}</span>元<img src="/wap/images/ico_no.png" id="chk2" style="float:right;width:20px;"></li>
			</ul>
		</div>
		<div class="odernum clearfloat" id="paytypebox">
			<ul>
				<li style="text-align:left;font-size:0.4rem;color:#f60">剩余应付金额:<span id="needpaynum">{{$needpaymoney/100}}</span>元，请选择支付方式：</li>
				<li style="height:60px;" onclick="chkpaytype(1)"><img src="/wap/images/ico_wx.png" width="40" style="float:left;"><span style="float:left;line-height:40px;color:#000;margin-left:10px;font-size:0.4rem;">微信支付</span><img src="/wap/images/ico_yes.png" id="paytype1" style="float:right;width:20px;margin-top:10px;"></li>
				<li style="height:60px;" onclick="chkpaytype(2)"><img src="/wap/images/ico_alipay.png" width="40" style="float:left;"><span style="float:left;line-height:40px;color:#000;margin-left:10px;font-size:0.4rem;">支付宝支付</span><img src="/wap/images/ico_no.png" id="paytype2" style="float:right;width:20px;margin-top:10px;"></li>
			</ul>
		</div>
		<a onclick="confirmpay()" class="address-add fl" id="zhifu" style=" background-color: #f5655c; color: white; height: 40px;">
			<font style="line-height: 40px;">确认支付</font>
		</a>

		<div id="zhaozhao"  style="position:absolute;top:0;left:0;width:100%;height:900px;background:#000;opacity:0.8;display:none">&nbsp;</div>
		<div class="odernum  clearfloat" id="div1" style="display: none;position:absolute;top:25%;width:80%;left:10%">
			<ul>
				<li style="text-align:left;font-size:0.4rem;color:#f60">请输入支付密码：</li>
				<li style="height:40px;"><input style="float: left;" id="pwd" type="password" name="password"  ><input onclick="surepay();" style=" border: 0px; border-radius: 5px; float: right; margin-right: 40px; background-color: #f5655c; color: white;" type="button" value="支&nbsp;&nbsp;付"></li>
			</ul>
		</div>
		<input id="orders" value="{{$orders}}" type="hidden">
	</div>
	<script>
        ifchk=[];
        ifchk[1]=1;
        ifchk[2]=0;
        asmoney=0;
        ordermoney={{$allorderprice/100}};
        asmoney+=$("#as1").html()*1;
        showCtr();
        paytype=1;
        function chk(id){
            ifchk[id]=ifchk[id]==0?1:0;
            chkpic=ifchk[id]==0?'no':'yes';
            $("#chk"+id).attr("src","/wap/images/ico_"+chkpic+".png");
            if(ifchk[id]==1) {
                asmoney+=$("#as"+id).html()*1;
            }else{
                asmoney-=$("#as"+id).html()*1;
            }
            //判断是否已经选足了金额，如果足了，需要去掉前一个选中的
            if(asmoney>=ordermoney){
                anotherid=id==1?2:1;
                if(ifchk[anotherid]==1) {
                    ifchk[anotherid]=0;
                    $("#chk"+anotherid).attr("src","/wap/images/ico_no.png");
                    asmoney-=$("#as"+anotherid).html()*1;
                }
            }
            showCtr();
        }
        function chkpaytype(id){
            paytype=id;
            $("#paytype1").attr("src","/wap/images/ico_no.png");
            $("#paytype2").attr("src","/wap/images/ico_no.png");
            $("#paytype"+id).attr("src","/wap/images/ico_yes.png");
        }
        function confirmpay(){
            //判断是否设置过支付密码
            $.ajax({
                url: '/wap/user/issetpwd',
                data: {
                    orders: $("#orders").val(),
                    _token: "{{csrf_token()}}"
                },
                type: 'post',
                dataType: 'json',
                async:false,
                success: function (data) {
                    console.log(data.status);
                    if(data.status === 1){
                        $("#pay").hide();
                        $("#div1").show();
                        $("#zhaozhao").show();
                        $("#zhifu").hide();
                    }else{
                        layer.msg('请设置支付密码',{time:1000},function(){
                            window.location.href=data.returnurl;
						});
                    }
                }
            });
        }

        $("#zhaozhao").click(function () {
            $("#zhaozhao").hide();
            $("#div1").hide();
            $("#zhifu").show();
        });

        function surepay(){
            $.ajax({
                url: '/wap/user/checkpwd',
                data: {
                    pwd: $("#pwd").val(),
                    _token: "{{csrf_token()}}"
                },
                type: 'post',
                dataType: 'json',
                async:false,
                success: function (data) {
                    console.log(data.status);
                    if(data.status === 1){
                        layer.confirm('是否确定支付？', {
                            btn: ['确定','取消'] //按钮
                        }, function(){
                            var payway=setPayway();
                            window.location.href = '/wap/pay/order?orders={{$orders}}&payway='+payway;
                            $.post("pay?orders={{$orders}}",{payway:payway,_token:'{{csrf_token()}}'},function (data) {
                                //POST结束
                            });
                        }, function(){
                            return;
                        });
                    }else{
                        layer.msg('密码设置有误！',{time:1000},function(){
                            $("#pwd").val("");
						});
                        // window.location.href=data.returnurl;
                    }
                }
            });
			{{--layer.confirm('是否确定支付？', {--}}
			{{--btn: ['确定','取消'] //按钮--}}
			{{--}, function(){--}}
			{{--var payway=setPayway();--}}
			{{--window.location.href = '/wap/pay/order?orders={{$orders}}&payway='+payway;--}}
			{{--$.post("pay?orders={{$orders}}",{payway:payway,_token:'{{csrf_token()}}'},function (data) {--}}
			{{--//POST结束--}}
			{{--});--}}
			{{--}, function(){--}}
			{{--return;--}}
			{{--});--}}
			{{--return;--}}
			{{--//判断密码是否正确--}}

        }

        //控制各行内容显示隐藏
        function showCtr(){
            needpaymoney={{$allorderprice/100}}-asmoney;
            if(asmoney>={{$allorderprice/100}}){//积分的钱大于等于
                $('#paytypebox').hide();
            }else{
                $('#paytypebox').show();
                $('#needpaynum').html(needpaymoney);
            }
        }

        //设置支付方式
        function setPayway(){
            img = new Array();
            img.push(($('#chk1').attr('src')==='/wap/images/ico_yes.png') ?1:0);
            img.push( ($('#chk2').attr('src')==='/wap/images/ico_yes.png') ?1:0 );
            img.push( ($('#paytype1').attr('src')==='/wap/images/ico_yes.png') ?1:0 );
            img.push( ($('#paytype2').attr('src')==='/wap/images/ico_yes.png') ?1:0 );
            img = img+',';
            switch(img){
                case '1,0,0,0,':
                    return 1;
                    break;
                case '0,1,0,0,':
                    return 2;
                    break;
                case '1,1,0,0,':
                    return 3;
                    break;
                case '1,0,1,0,':
                    return 4;
                    break;
                case '1,0,0,1,':
                    return 5;
                    break;
                case '0,1,1,0,':
                    return 6;
                    break;
                case '0,1,0,1,':
                    return 7;
                    break;
                case '1,1,1,0,':
                    return 8;
                    break;
                case '1,1,0,1,':
                    return 9;
                    break;
                case '0,0,1,0,':
                    return 10;
                    break;
                case '0,0,0,1,':
                    return 11;
                    break;
            }
        }

	</script>
	</body>
	</html>
