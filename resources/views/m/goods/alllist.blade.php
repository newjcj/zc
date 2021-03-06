@extends('wap.master.index')
@section('title','订单列表')
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
            $(".loading").addClass("loader-chanage");
            $(".loading").fadeOut(300)
        })
	</script>
@endsection

@section('content')
	<header id="header" style="">
		<div class="topbar" style=" background-color: #f5655c;">
			<a href="javascript:history.back();" class="back_btn"><i class="iconfont">ş</i></a>
			<h1 class="page_title"><input type="text"  id="good" value="{{$name}}" placeholder="商品搜索" style=" border: 0px; width: 300px; height: 25px; padding-left: 20px;"><span id="find" onclick="find();"><font size="-1">&nbsp;搜索</font></span></h1>
		</div>
	</header>
	<!-- 会员俱乐部 -->
	<div class="vip-club border_top_bottom vip-account">
		<div class="vip-club-title border_bottom">
			<span style="width:23%;display:inline-block;text-align:center;color:red;" id="span1" >综合</span>
			<span style="width:23%;display:inline-block;text-align:center;" id="span2" >新品</span>
			<span style="width:23%;display:inline-block;text-align:center;" id="span3" >销量</span>
			<span style="width:23%;display:inline-block;text-align:center;" id="span4" >价格<div  style=" width: 25px; height: 25px; float: right; margin-top: -3px; margin-right: 35px; border: #0c0c0c 0px solid;"><img onclick="up();"  width="20" height="20" src="/wap/images/up.png"></div><div style=" width: 25px; height: 20px; float: right; border: #0c0c0c 0px solid; margin-top: -30px; margin-right: 35px;"  ><img onclick="down()" width="20" height="20" src="/wap/images/down.png"></div></span>
		</div>
		{{--全部订单--}}
		<div id="div1">
			<div class="vip-club border_top_bottom" >

				<ul>
					@if(count($goods))
					@foreach($goods as $item)
						<li style="float:left; margin-left: 20px; margin-top: 20px;" onclick="location.href='/wap/goods/detail?id={{$item->id}}'"> <img src="{{ \App\Models\Goods::getGoodsimages($item)[0] }}" width="80" height="100"/></li>
							<li style=" float: left; margin-left: 5px; margin-top: 20px; "><font >{{mb_strlen($item->name,"UTF8")<=4 ? $item->name : substr($item->name,0,15).'..'}}</font></li>
							<li style="float:right;  margin-top: 20px; margin-right: 20px; "><font color="#a52a2a"><b>￥{{$item->price}}</b></font> </li>
							<li class="border_bottom" style="line-height:20px;text-align:right;clear:both;margin-right:20px;font-size:16px;">
								<img src="/wap/images/car.png" onClick="toshare({{$item->id}})">
							</li>
					@endforeach
					@endif
				</ul>
			</div>
		</div>

	</div>
	<br><br><br><br><br><br>
@endsection

@section('script')
	<script>

		function up() {
            location.href="/wap/goods/alllist?up=1&name="+$("#good").val();
        }

        function down() {
            location.href="/wap/goods/alllist?down=1&name="+$("#good").val();
        }

		function find() {
			location.href="/wap/goods/alllist?name="+$("#good").val();
        }

     function  toshare(id) {
         $.ajax({
             url: '/view/home/addcart',
             data: {
                 'goodsid':id,
                 'num':'1',
                 _token: "{{csrf_token()}}"
             },
             type: 'post',
             dataType: 'json',
             async:false,
             success: function (data) {
                 if(data.status===1){
                     window.location.href='/wap/goods/car';
                     layer.open({
                         title: '提示',
                         shadeClose:true,//点击遮罩关闭
                         content: data.message,
                         yes:function(){
                             layer.closeAll();

                         },
                         cancel: function(){
                             //右上角关闭回调
                             // window.location.href='/admin/goods/goods/index';
                         }
                     });
                 }
             }
         });
     }


	</script>
@endsection