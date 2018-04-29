@extends('wap.master.index')
@section('title','确认订单')
@section('head')

@endsection
@section('content')
    <link rel="stylesheet" type="text/css" href="/wap/css/base.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/confirm.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/mui.min.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/loaders.min.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/loading.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/sourse/layer/mobile/need/layer.css">
    <script src="/wap/js/rem.js"></script>
    <script src="/wap/js/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(window).load(function () {
            $(".loading").addClass("loader-chanage")
            $(".loading").fadeOut(300)
        })
    </script>
    <header class="mui-bar mui-bar-nav" id="header" style=" background-color: #f5655c;">
        <a class="btn" href="javascript:history.go(-1)">
            <i class="iconfont icon-fanhui"></i>
        </a>
        <div class="top-sch-box top-sch-boxtwo flex-col">
            确认订单
        </div>
    </header>
    <!--header end-->
    <div class="warp warptwo clearfloat">
        <div class="confirm clearfloat">
            @if($useraddress)
                <div class="add clearfloat box-s" id="address" data-status="1">
                    <a href="/wap/user/address?ordersid={{$ordersid}}">
                        <div class="left clearfloat fl">
                            <i class="iconfont icon-dizhi1"></i>
                        </div>
                        <div class="middle clearfloat fl">
                            <p class="tit">
                                收货人：{{ $useraddress->addressname }}&nbsp;&nbsp;&nbsp;&nbsp;{{ $useraddress->phone }}
                            </p>
                            <p class="fu-tit over2">
                                收货地址：{{ $useraddress->region_id.$useraddress->address }}
                            </p>
                        </div>
                        <div class="left clearfloat fr">
                            <i class="iconfont icon-jiantou1"></i>
                        </div>
                    </a>
                </div>
            @else
                <div class="lie clearfloat" id="address" data-status="0" >
                    <div class="gmshu clearfloat box-s fl" style="text-align:left;">
                        <a href="/wap/user/addaddress?ordersid={{$ordersid}}"><p class="fr" style="margin-right:2rem;">您还没有设置收货地址，点击添加</p></a>
                    </div>
                </div>
            @endif

            <div class="lie clearfloat" >
                @if(count($orders))
                    @foreach($orders as $order)
                        @foreach($order->goodss as $goods)
                            <a href="/wap/goods/detail?id={{ $goods->id }}">
                                <div class="tu clearfloat fl">
                                    <img src="{{ \App\Models\Goods::getGoodsimages($goods)[0] }}"/>
                                </div>
                            </a>
                        @endforeach
                    @endforeach
                @endif

                {{--<div class="right clearfloat fl">
                    <a href="detail.html">
                        <p class="tit over">单反相机，彰显你的风格</p>
                        <p class="fu-tit">颜色：蓝色  内存：120G</p>
                    </a>
                    <div class="xia clearfloat">
                        <a href="detail.html">
                            <p class="jifen fl over">100000积分</p>
                        </a>
                        <span class="fr db">×1</span>
                    </div>
                </div>--}}
            </div>
            {{--<div class="gmshu clearfloat box-s fl">--}}
            {{--<div class="gcontent clearfloat">--}}
            {{--<p class="fl">购买数量</p>--}}
            {{--<div class="you clearfloat fr">--}}
            {{--<ul>--}}
            {{--<li><img src="images/jian.jpg"/></li>--}}
            {{--<li>1</li>--}}
            {{--<li><img src="images/jia.jpg"/></li>--}}
            {{--</ul>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<div class="gmshu gmshutwo clearfloat box-s fl">--}}
            {{--<div class="gcontent clearfloat">--}}
            {{--<p class="fl">配送方式</p>--}}
            {{--<div class="you clearfloat fr">--}}
            {{--<span>快递 免邮</span>--}}
            {{--<i class="iconfont icon-jiantou1"></i>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<div class="gmshu gmshutwo clearfloat box-s fl">--}}
            {{--<div class="gcontent clearfloat">--}}
            {{--<p class="fl">发票信息</p>--}}
            {{--<div class="you clearfloat fr">--}}
            {{--<div class="xuan clearfloat">--}}
            {{--<div class="radiotwo" >--}}
            {{--<label>--}}
            {{--<input type="radio" name="fapiao" value="" checked/>--}}
            {{--<div class="option"></div>--}}
            {{--<span class="opt-text">需要发票</span>--}}
            {{--</label>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<div class="xuan clearfloat">--}}
            {{--<div class="radiotwo" >--}}
            {{--<label>--}}
            {{--<input type="radio" name="fapiao" value=""/>--}}
            {{--<div class="option"></div>--}}
            {{--<span class="opt-text">不需要发票</span>--}}
            {{--</label>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<div class="gmshu gmshuthree clearfloat box-s fl">--}}
            {{--<div class="gcontent clearfloat">--}}
            {{--<p class="fl">买家留言</p>--}}
            {{--<div class="you clearfloat fl">--}}
            {{--<input type="text" name="" id="" value="" class="text" placeholder="选填 对本次交易需求给商家留言" />--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            <div class="gmshu clearfloat box-s fl">
                <p class="fr">共{{ count($orders) }}件商品   合计<samp> {{ \App\Models\Order::getOrderTotalPrice($ordersarr)/100 }} 元</samp></p>
            </div>

        </div>
    </div>

    <!--settlement star-->
    <div class="settlement clearfloat">
        <div class="zuo clearfloat fl box-s">
            共<span>{{ count($orders) }}</span>件  总价格：<span>{{ \App\Models\Order::getOrderTotalPrice($ordersarr) /100 }} 元 </span>
        </div>
        <a href="javascript:_isgreater()" class="fl db" style=" background-color: #f5655c;">
            提交订单<input id="ordersid" value="{{$ordersid}}" type="hidden">
        </a>
    </div>
    <!--settlement end-->

@endsection
@section('script')
    <script>

        function _isgreater(){
            if($('#address').data('status') !== 1){
                layer.msg('请设置默认收货地址',{time:2000});
                return false;
            }
            $.ajax({
                url: '/wap/order/isgreater',
                data: {
                    orders:"{{ implode(',',$ordersarr) }}",
                    _token:'{{ csrf_token() }}'
                },
                type: 'post',
                dataType: 'json',
                async:false,
                success: function (data) {
                    if(data.status !== 1){
                        layer.msg('用户等级小于礼包等级',{time:1500},function(){
                            window.location.href='/wap/home/index';
                        });
                    }else{
                        window.location.href="/wap/order/payway?orders={{ implode(',',$ordersarr) }}";
                    }
                }
            });
        }
    </script>

@endsection
