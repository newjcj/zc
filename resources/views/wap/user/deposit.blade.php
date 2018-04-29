@extends('wap.master.index')
@section('title','提现')
@section('head')
    <link rel="stylesheet" type="text/css" href="/wap/css/base.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/zhifu.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/mui.min.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/loaders.min.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/loading.css"/>
    <script src="/wap/js/rem.js"></script>
    <script src="/wap/js/jquery.min.js" type="text/javascript"></script>
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
</head>
@section('content')
		<header class="mui-bar mui-bar-nav report-header box-s" id="header" style=" background-color: #f5655c;">
			<a href="javascript:history.go(-1)"><i class="iconfont icon-fanhui fl"></i></a>
			<p><font color="white">提现申请</font></p>
	    </header>
	    <div id="main" class="mui-clearfix contaniner sorder">	    	
	    	<div class="warning clearfloat box-s">
    			可提现金额：{{ $user->money - $user->frozen_money }}元  &nbsp;&nbsp;&nbsp;&nbsp;冻结金额：{{ $user->frozen_money?:0 }} 元
    		</div>
    		<div class="pay-method clearfloat">
    			<ul>
    				<li>
    					<div style="height:100px;">
	    					<label><font size="-0.8">提现金额：</font></label><br>
                            <font size="+1"><b>￥&nbsp;&nbsp;</b></font><input type="number" name="price"  style=" color: #e24e44; font-size: 20px; background: none; border: 0px;">
                            <hr style=" opacity: 0.3;">
    					</div>
    				</li>
    			</ul>
    		</div>

	    	<a href="javascript:_deposit()" class="address-add fl" style=" border-radius: 6px; float: right; background-color: #f5655c;">
	     		提交申请
	     	</a>
	    </div>

@endsection

@section('script')
	<script>
		//提现申请
		var _deposit=function(){
			//验证提现金额为整数
			var expr=/^\d+$/;
			var priceObj = $('input[name="price"]');
			if(!expr.test(priceObj.val())){
			    layer.msg('提现金额为整数',{time:800},function(){
			        return false;
				});
			}else{
                //提现
                $.ajax({
                    url: '/wap/pay/deposit',
                    data: {
                        price:$('input[name="price"]').val(),
                        _token: "{{csrf_token()}}"
                    },
                    type: 'post',
                    dataType: 'json',
                    async:false,
                    success: function (data) {
                        if(data.status === 1){
                            layer.open({
                                title: '提示',
                                shadeClose:true,//点击遮罩关闭
                                content: data.message,
                                yes:function(){
                                    layer.closeAll();
                                    window.location.href='/wap/user/center';
                                },
                                cancel: function(){
                                    //右上角关闭回调
                                    window.location.href='/wap/user/center';
                                }
                            });
                        }else if(data.status ===2){
                            layer.open({
                                title: '提示',
                                shadeClose:true,//点击遮罩关闭
                                content: data.message,
                                yes:function(){
                                    layer.closeAll();
                                    window.location.href='/wap/user/center';
                                },
                                cancel: function(){
                                    //右上角关闭回调
                                    window.location.href='/wap/user/center';
                                }
                            });
                        }else if(data.status === 3){
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
                        }else if(data.status ===4){
                            layer.open({
                                title: '提示',
                                shadeClose:true,//点击遮罩关闭
                                content: data.message,
                                yes:function(){
                                    layer.closeAll();
                                    window.location.href='/wap/home/index';
                                },
                                cancel: function(){
                                    //右上角关闭回调
                                    window.location.href='/wap/home/index';
                                }
                            });
                        }else if(data.status ===5){
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
                        }
                    }
                });
			}

		}
	</script>
@endsection
