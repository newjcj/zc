@extends('wap.master.index')
@section('title','瑞克斯商城首页')
@section('head')
	<link rel="stylesheet" type="text/css" href="/wap/css/base.css"/>
	<link rel="stylesheet" type="text/css" href="/wap/css/index.css"/>
	<link rel="stylesheet" type="text/css" href="/wap/css/mui.min.css"/>
	<link rel="stylesheet" type="text/css" href="/wap/css/loaders.min.css"/>
	<link rel="stylesheet" type="text/css" href="/wap/css/loading.css"/>
	<link rel="stylesheet" href="/wap/css/swiper.min.css">
	<script src="/wap/js/rem.js"></script>
	<script src="/wap/js/jquery.min.js" type="text/javascript"></script>
	<script src="/wap/js/others.js"></script>
	<script src="/wap/js/swiper.jquery.min.js"></script>
	<style>
		.goodslist{
			clear:both;width:100%;overflow-x:auto;height:200px;
			display:flex;
			flex-wrap:wrap;
			justify-content:center;
		}
		.goodbox{
			/*margin-left:5px;*/
		}
	</style>
	<script type="text/javascript">
        $(window).load(function(){
            $(".loading").addClass("loader-chanage")
            $(".loading").fadeOut(300)
        })
	</script>
@endsection

@section('content')
	<div id="main" class="clearfloat ">
		<div class="mui-content">
			<!--banner开始-->
			<div class="banner swiper-container">
				<div class="swiper-wrapper">
					<div class="swiper-slide"><a href="javascript:void(0)"><img class="swiper-lazy" height="150" data-src="/wap/images/banner02.jpg" alt=""  onclick="location.href='/wap/goods/detail?id=433';" ></a></div>
					<div class="swiper-slide"><a href="javascript:void(0)"><img class="swiper-lazy" height="150"  data-src="/wap/images/banner01.jpg" alt="" onclick="location.href='/wap/goods/detail?id=288';"></a></div>
					<div class="swiper-slide"><a href="javascript:void(0)"><img class="swiper-lazy" height="150"  data-src="/wap/images/banner03.jpg" alt="" onclick="location.href='/wap/goods/detail?id=293';"></a></div>
					<div class="swiper-slide"><a href="javascript:void(0)"><img class="swiper-lazy" height="150" data-src="/wap/images/banner04.jpg" alt=""  onclick="location.href='/wap/goods/detail?id=272';"></a></div>
				</div>
			</div>
			<!--第一栏分类开始-->
			<div class="cation clearfloat box-s">
				<ul>
					<li>
						<a href="/wap/goods/alllist">
							<img src="/wap/images/shangping.png" style=" width: 60px;"/>
							<p><font size="-0.8">全部商品</font></p>
						</a>
					</li>
					<li>
						<a href="/wap/goods/list?id=185" >
							<img src="/wap/images/libao.png" style=" width: 60px;"/>
							<p><font size="-0.8">会员礼包</font></p>
						</a>
					</li>
					<li>
						<a href="/wap/user/myteam">
							<img src="/wap/images/tuandui.png" style=" width: 60px;"/>
							<p><font size="-0.8">我的团队</font></p>
						</a>
					</li>
					<li>
						<a href="/wap/user/center">
							<img src="/wap/images/zhongxin.png" style=" width: 60px;"/>
							<p><font size="-0.8">用户中心</font></p>
						</a>
					</li>
				</ul>
			</div>
			<div class="index_box_top" style="background:url(/wap/images/index_box_top.png) no-repeat #fff;width:100%;height:220px;background-size:100% 100%;"  onclick="location.href='/wap/goods/list?id=191';">
				&nbsp;
			</div>
			<style>
				.index_box{float:left;position:relative;width:49%;background:url(/wap/images/index_box1.png) no-repeat #fff;min-height:120px;background-size:100% 100%;margin-bottom:10px;}
				.r{float:right;}
			</style>
			<div class="index_box_body" style="background:url(/wap/images/index_box_bg3.png) no-repeat #fff;width:100%;min-height:400px;background-size:100% 100%;padding:0 2%;">
				<div class="index_box" style="background:url(/wap/images/index_box1.png) no-repeat #fff;background-size:100% 100%;" onclick="location.href='/wap/goods/list?id=210';">
					<div style="margin:20px 5px 0 10px;font-size:0.4rem;font-weight:700;color:#fff;">时尚达人</div>
					<div style="margin-left:10px;font-size:0.2rem;color:#fff;">潮男潮女，说的就是你</div>
					<img src="/images/index_home/a5.png" style="width:35%;position:absolute;bottom:10px;right:20px;" >
				</div>
				<div class="index_box r" style="background:url(/wap/images/index_box2.png) no-repeat #fff;background-size:100% 100%;" onclick="location.href='/wap/goods/list?id=219';">
					<div style="margin:20px 5px 0 10px;font-size:0.4rem;font-weight:700;color:#fff;">时尚眼镜</div>
					<div style="margin-left:10px;font-size:0.2rem;color:#fff;">关爱眼睛，更关心你！</div>
					<img src="/images/index_home/a4.png" style="width:45%;position:absolute;bottom:10px;right:20px;">
				</div>

				<div class="index_box" style="background:url(/wap/images/index_box3.png) no-repeat #fff;background-size:100% 100%;" onclick="location.href='/wap/goods/list?id=216';">
					<div style="margin:20px 5px 0 10px;font-size:0.4rem;font-weight:700;color:#fff;">珠宝首饰</div>
					<div style="margin-left:10px;font-size:0.2rem;color:#fff;">你不是最好的，但却是我最珍贵的！</div>
					<img src="/images/index_home/a6.png" style="width:35%;position:absolute;bottom:10px;right:20px;">
				</div>
				<div class="index_box r" style="background:url(/wap/images/index_box4.png) no-repeat #fff;background-size:100% 100%;" onclick="location.href='/wap/goods/list?id=234';">
					<div style="margin:20px 5px 0 10px;font-size:0.4rem;font-weight:700;color:#fff;">护肤美妆</div>
					<div style="margin-left:10px;font-size:0.2rem;color:#fff;">爱惜你，从关爱你的皮肤开始！</div>
					<img src="/images/index_home/a01.png" style="width:35%;position:absolute;bottom:10px;right:20px;">
				</div>

				<div class="index_box" style="background:url(/wap/images/index_box5.png) no-repeat #fff;background-size:100% 100%;" onclick="location.href='/wap/goods/list?id=196';">
					<div style="margin:20px 5px 0 10px;font-size:0.4rem;font-weight:700;color:#fff;">精品外设</div>
					<div style="margin-left:10px;font-size:0.2rem;color:#fff;">吃鸡神器，你值得拥有！</div>
					<img src="/images/index_home/a2.png" style="width:45%;position:absolute;bottom:10px;right:20px;">
				</div>
				<div class="index_box r" style="background:url(/wap/images/index_box6.png) no-repeat #fff;background-size:100% 100%;" onclick="location.href='/wap/goods/list?id=183';">
					<div style="margin:20px 5px 0 10px;font-size:0.4rem;font-weight:700;color:#fff;">高档红酒</div>
					<div style="margin-left:10px;font-size:0.2rem;color:#fff;">让贪杯的你欲罢不能~</div>
					<img src="/images/index_home/aa3.png" style="width:45%;position:absolute;bottom:10px;right:20px;">
				</div>

				<div class="index_box" style="width:100%;background:url(/wap/images/index_box_bottom.png) no-repeat #fff;background-size:100% 100%;" onclick="location.href='/wap/goods/alllist';">
					<div style="margin:20px 5px 0 30px;font-size:0.4rem;font-weight:700;color:yellow;">新年迎新，饰品专区爆款促销</div>
					<div style="margin-left:30px;font-size:0.2rem;color:#fff;">手镯，手链，项链，男女手表，应有尽有！</div>
					<img src="/images/index_home/a7.png" style="width:25%;position:absolute;bottom:10px;right:20px;">
				</div>

			</div>

			<style>
				.goodslist{overflow-y:hidden;}
				.goodbox{width:24%;height:180px;border-radius:5px;float:left;margin:10px;background-size:100% 100%;padding:10px;position:relative;box-shadow: 0 0 5px #888;}
			</style>
			<div class="index_cat" style="margin-top:10px;background:url(/wap/images/index_cat2.png) no-repeat #fff;width:100%;height:220px;background-size:100% 100%;"  onclick="location.href='/wap/goods/list?id=189';">
				&nbsp;
			</div>
			@if($catgoods1)
			<div class="goodslist" style="">
				@foreach($catgoods1 as $item)
					<div class="goodbox" style="background:url({{(\App\Models\Goods::getGoodsimages($item))[0]}}) no-repeat;background-size:100% 100%;" onclick="location.href='/wap/goods/detail?id={{$item->id}}';">
						<div class="good_info_bg" style="position:absolute;margin-top:60%;background:#fff;filter:alpha(Opacity=70);-moz-opacity:0.7;opacity: 0.7;height:30%;width:75%">
							&nbsp;
						</div>
						<div style="position:absolute;top:68%;font-size:0.1rem;text-align:center;">
							￥<b style="font-size:0.3rem;">{{$item->price}}</b><br>店主赚<b style="font-size:0.3rem">{{$item->gain_price!=''?$item->gain_price:'0'}}</b>元
						</div>

					</div>
				@endforeach
			</div>
			@endif
			<div class="index_cat" style="margin-top:10px;background:url(/wap/images/index_cat1.png) no-repeat #fff;width:100%;height:220px;background-size:100% 100%;"  onclick="location.href='/wap/goods/list?id=185';">
				&nbsp;
			</div>
			@if($catgoods2)
			<div class="goodslist" style="">
				@foreach($catgoods2 as $item)
					<div class="goodbox" style="background:url({{(\App\Models\Goods::getGoodsimages($item))[0]}}) no-repeat;background-size:100% 100%;" onclick="location.href='/wap/goods/detail?id={{$item->id}}';">
						<div class="good_info_bg" style="position:absolute;margin-top:60%;background:#fff;filter:alpha(Opacity=70);-moz-opacity:0.7;opacity: 0.7;height:30%;width:75%">
							&nbsp;
						</div>
						<div style="position:absolute;top:68%;font-size:0.1rem;text-align:center;">
							￥<b style="font-size:0.3rem;">{{$item->price}}</b><br>店主赚<b style="font-size:0.3rem">{{$item->gain_price!=''?$item->gain_price:'0'}}</b>元
						</div>

					</div>
				@endforeach
			</div>
			@endif
			<div class="index_cat" style="margin-top:10px;background:url(/wap/images/index_cat3.png) no-repeat #fff;width:100%;height:220px;background-size:100% 100%;"  onclick="location.href='/wap/goods/list?id=209';">
				&nbsp;
			</div>
			@if($catgoods3)
			<div class="goodslist" style="">
				@foreach($catgoods3 as $item)
					<div class="goodbox" style="background:url({{(\App\Models\Goods::getGoodsimages($item))[0]}}) no-repeat;background-size:100% 100%;" onclick="location.href='/wap/goods/detail?id={{$item->id}}';">
						<div class="good_info_bg" style="position:absolute;margin-top:60%;background:#fff;filter:alpha(Opacity=70);-moz-opacity:0.7;opacity: 0.7;height:30%;width:75%">
							&nbsp;
						</div>
						<div style="position:absolute;top:68%;font-size:0.1rem;text-align:center;">
							￥<b style="font-size:0.3rem;">{{$item->price}}</b><br>店主赚<b style="font-size:0.3rem">{{$item->gain_price!=''?$item->gain_price:'0'}}</b>元
						</div>

					</div>
				@endforeach
			</div>
			@endif
			<div class="index_cat" style="margin-top:10px;background:url(/wap/images/index_cat4.png) no-repeat #fff;width:100%;height:220px;background-size:100% 100%;" onclick="location.href='/wap/goods/list?id=234';">
				&nbsp;
			</div>
			@if($catgoods4)
			<div class="goodslist" style="">
				@foreach($catgoods4 as $item)
					<div class="goodbox" style="background:url({{(\App\Models\Goods::getGoodsimages($item))[0]}}) no-repeat;background-size:100% 100%;" onclick="location.href='/wap/goods/detail?id={{$item->id}}';">
						<div class="good_info_bg" style="position:absolute;margin-top:60%;background:#fff;filter:alpha(Opacity=70);-moz-opacity:0.7;opacity: 0.7;height:30%;width:75%">
							&nbsp;
						</div>
						<div style="position:absolute;top:68%;font-size:0.1rem;text-align:center;">
							￥<b style="font-size:0.3rem;">{{$item->price}}</b><br>店主赚<b style="font-size:0.3rem">{{$item->gain_price!=''?$item->gain_price:'0'}}</b>元
						</div>

					</div>
				@endforeach
			</div>
			@endif
			<div class="index_cat5" style="margin-top:10px;background:url(/wap/images/index_cat5.png) no-repeat #fff;width:100%;height:40px;background-size:100% 100%;">
				&nbsp;
			</div>
			@if($catgoods5)
			<div class="goodslist" style="">
				@foreach($catgoods5 as $item)
					<div class="goodbox" style="background:url({{(\App\Models\Goods::getGoodsimages($item))[0]}}) no-repeat;background-size:100% 100%;" onclick="location.href='/wap/goods/detail?id={{$item->id}}';">
						<div class="good_info_bg" style="position:absolute;margin-top:60%;background:#fff;filter:alpha(Opacity=70);-moz-opacity:0.7;opacity: 0.7;height:30%;width:75%">
							&nbsp;
						</div>
						<div style="position:absolute;top:68%;font-size:0.1rem;text-align:center;">
							￥<b style="font-size:0.3rem;">{{$item->price}}</b><br>店主赚<b style="font-size:0.3rem">{{$item->gain_price!=''?$item->gain_price:'0'}}</b>元
						</div>

					</div>
				@endforeach
			</div>
			@endif
			<script>
                //动态计算高度，防止图片拉伸变形
                b=476/1244;//top原始图片的长宽比
                $(".index_box_top").height($(".index_box_top").width()*b);
                b=300/582;//box原始图片长宽比
                $(".index_box").height($(".index_box").width()*b);
                $(".index_box_body").height($(".index_box").height()*4+35);
                b=462/1245;//cat原始图片的长宽比
                $(".index_cat").height($(".index_cat").width()*b);
                $(".index_cat5").height($(".index_cat5").width()*0.1);
                $(".goodbox").height($(".goodbox").width()*1.1);
                $(".goodslist").height($(".goodbox").height()*1.45);
                $(".good_info_bg").width($(".goodbox").width());

			</script>
		</div>
	</div>
	<div class="blank" style="height:100px;">&nbsp;</div>
@endsection

@section('script')

@endsection