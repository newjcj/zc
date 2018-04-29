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
	<title>@yield('title')</title>
	<link rel="shortcut icon" type="image/x-icon" href="/view/one/img/icon/favicon.ico">
	<link rel="stylesheet" type="text/css" href="/view/one/css/base.css">
	<link rel="stylesheet" type="text/css" href="/view/one/css/home.css">
	<script type="text/javascript" src="/view/one/js/jquery.js"></script>
	<script type="text/javascript" src="/view/one/js/index.js"></script>
	<script type="text/javascript" src="/view/one/js/modernizr-custom-v2.7.1.min.js"></script>
	<script type="text/javascript" src="/view/one/js/jquery.SuperSlide.js"></script>

	<script type="text/javascript" src="/admin/js/register.js"></script>
	<script type="text/javascript" src="/admin/js/epii.js"></script>

	<script src="/admin/layui/layui.all.js"></script>
	<script src="/view/js/min.js"></script>
	@yield('asset')
	<script>
         window._token="{{csrf_token()}}";
	</script>
</head>
<body>

<header id="pc-header">
	@include('view.master.top')
	<!--  顶部    start-->
		<!-- 导航   start  -->
		@include('view.master.category')
		<!-- 导航   end  -->

	<!--  顶部    end-->

</header>
@yield('content')

<footer>
	<div class="pc-footer-top">
		<div class="center">
			<ul class="clearfix">
				<li>
					<span>关于我们</span>
					<a href="#">关于我们</a>
					<a href="#">诚聘英才</a>
					<a href="#">用户服务协议</a>
					<a href="#">网站服务条款</a>
					<a href="#">联系我们</a>
				</li>
				<li class="lw">
					<span>购物指南</span>
					<a href="#">新手上路</a>
					<a href="#">订单查询</a>
					<a href="#">会员介绍</a>
					<a href="#">网站服务条款</a>
					<a href="#">帮助中心</a>
				</li>
				<li class="lw">
					<span>消费者保障</span>
					<a href="#">人工验货</a>
					<a href="#">退货退款政策</a>
					<a href="#">运费补贴卡</a>
					<a href="#">无忧售后</a>
					<a href="#">先行赔付</a>
				</li>
				<li class="lw">
					<span>商务合作</span>
					<a href="#">人工验货</a>
					<a href="#">退货退款政策</a>
					<a href="#">运费补贴卡</a>
					<a href="#">无忧售后</a>
					<a href="#">先行赔付</a>
				</li>
				<li class="lss">
					<span>下载手机版</span>
					<div class="clearfix lss-pa">
						<div class="fl lss-img"><img src="/view/one/img/icon/code.png" alt=""></div>
						<div class="fl" style="padding-left:20px">
							<h4>扫描下载云购APP</h4>
							<p>把优惠握在手心</p>
							<P>把潮流带在身边</P>
							<P></P>
						</div>
					</div>
				</li>
			</ul>
		</div>
		<div class="pc-footer-lin">
			<div class="center">
				<p>友情链接：
					卡宝宝信用卡
					梦芭莎网上购物
					手游交易平台
					法律咨询
					深圳地图
					P2P网贷导航
					名鞋库
					万表网
					叮当音乐网
					114票务网
					儿歌视频大全
				</p>
				<p>
					京ICP证1900075号  京ICP备20051110号-5  京公网安备110104734773474323  统一社会信用代码 91113443434371298269B  食品流通许可证SP1101435445645645640352397
				</p>
				<p style="padding-bottom:30px">版物经营许可证 新出发京零字第朝160018号  Copyright©2011-2015 版权所有 ZHE800.COM </p>
			</div>
		</div>
	</div>
</footer>
@yield('script')
<script>
	@if(Request::is('view/home/car'))
    $('.pullDownList').mouseleave().css({display:'none'});
    @endif
</script>
</body>
</html>