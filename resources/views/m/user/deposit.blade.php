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
			<p>提现申请</p>
	    </header>
	    <div id="main" class="mui-clearfix contaniner sorder">	    	
	    	<div class="warning clearfloat box-s">
    			可提现金额：{{ $user->money - $user->frozen_money }}元  &nbsp;&nbsp;&nbsp;&nbsp;冻结金额：{{ $user->frozen_money?:0 }} 元
    		</div>
    		<div class="pay-method clearfloat">
    			<ul>
    				<li>
    					<div style="height: 1rem">
    						
	    					<label>请输入提现金额：</label>
	    					<input type="number" name="price">
    					</div>
    				</li>
    			</ul>
    		</div>

	    	<a href="javascript:_deposit()" class="address-add fl">
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
