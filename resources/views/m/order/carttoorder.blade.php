@extends('wap.master.index')
@section('title','我的订单')
@section('head')

@endsection
@section('content')
    <link rel="stylesheet" type="text/css" href="/wap/css/base.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/shopcar.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/mui.min.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/loaders.min.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/loading.css"/>
    {{--<link rel="stylesheet" type="text/css" href="/wap/sourse/layer/mobile/need/layer.css">--}}
    <style>

    </style>
    <script src="/wap/js/rem.js"></script>
    <script src="/wap/js/jquery.min.js" type="text/javascript"></script>
    {{--<script src="/wap/sourse/layer/mobile/layer.js"></script>--}}
    <script type="text/javascript">
        $(window).load(function () {
            $(".loading").addClass("loader-chanage")
            $(".loading").fadeOut(300)
        })
    </script>
    <style>
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
    <!--header star-->
    <header class="mui-bar mui-bar-nav" id="header" style=" background-color: #f5655c;">
        <a class="btn" href="javascript:history.go(-1)">
            <i class="iconfont icon-fanhui"></i>
        </a>
        <h4>我的订单</h4>
    </header>
    <!--header end-->

    <div class="warp warptwo clearfloat">
        <div class="shopcar clearfloat">
            @if(count($orders))
                @foreach($orders as $order)
                    <div class="plist">
                        <div class="list clearfloat fl alist" data-orderid="{{ $order->id }}" data-price="{{ \App\Models\Order::getOrderTotalPrice($order->id) }}" data-id="" style="height:1rem;font-size:-0.5rem;padding:0.1rem .2rem;margin-bottom:1%;margin-top:3%;">
                            <div class="xuan clearfloat fl" style="margin-top:0.3rem;">
                                <div class="radio">
                                    <label>
                                        <input type="checkbox" name="sex" value="">
                                    </label>
                                </div>
                            </div>
                            <div class="right clearfloat fl" style="width:72%">
                                <p class="tit over" style="font-size:0.4rem;line-height:0.9rem;"> 官方实体店 </p>
                                <div class="bottom clearfloat" style="margin-top:-0.7rem;margin-left:1.4rem;">
                                    <i class="iconfont icon-lajixiang fr"></i>
                                </div>
                            </div>
                        </div>
                        @foreach($order->goodss as $goods)
                            <div class="list clearfloat fl blist" data-id="" style="height:2rem;">
                                <div class="xuan clearfloat fl" style="margin-top:0.4rem;">
                                    {{--<div class="radio" >--}}
                                    {{--<label>--}}
                                    {{--<input type="checkbox" name="sex" value="" />--}}
                                    {{--</label>--}}
                                    {{--</div>--}}
                                </div>
                                <a href="javascript:void(0)">
                                    <div class="tu clearfloat fl" style="width:1.4rem;height:1.4rem;margin-left:-0.6rem;margin-top:-0.2rem;">
                                        <span></span>
                                        <img src="{{ \App\Models\Goods::getGoodsimages($goods)[0] }}" style="padding-top:0px;"/>
                                    </div>
                                    <div class="right clearfloat fl" style="width:72%">
                                        <p class="tit over" style="font-size:0.35rem;"> {{ $goods->name }} </p>
                                        {{--<p class="fu-tit over">颜色：蓝色  内存：120G</p>--}}
                                        <p class="price over" style="margin-top:-0.2rem;font-size:0.4rem;"> {{ $goods->price }}元</p>
                                        <div class="bottom clearfloat" style="margin-top:-0.7rem;margin-left:0.4rem;">
                                        {{--<div class="zuo clearfloat fl">--}}
                                        {{--<ul>--}}
                                        {{--<li><img src="/wap/images/jian.jpg"/></li>--}}
                                        {{--<li class="count"></li>--}}
                                        {{--<li><img src="/wap/images/jia.jpg"/></li>--}}
                                        {{--</ul>--}}
                                        {{--</div>--}}
                                            <span class="num fr" data-num="{{ $goods->pivot->num  }}">x{{ $goods->pivot->num }}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>

                @endforeach
            @endif
        </div>
    </div>

    <!--settlement star-->
    <div class="settlement clearfloat">
        <div class="zuo clearfloat fl box-s">
            合计：<span></span>
        </div>
        <a href="javascript:_pay(this)" class="fl db">
            立即结算
        </a>
    </div>
    <!--settlement end-->

    @endsection
    @section('script')
        <script type="text/javascript">
            $('input[type="checkbox"]').click(function () { // 找到勾选按钮，绑定事件
                tatol();
            });
            $('.list ul img').click(function () { // 找到加减按钮，绑定点击事件
                var val = $(this).parent().parent().children().eq(1);
                if ($(this).parent().index()) {
                    val.html(parseInt(val.html()) + 1);
                } else {
                    val.html(val.html() > 1 ? parseInt(val.html()) - 1 : 1);
                }
                tatol();
            });
            $('.icon-lajixiang').click(function () { // 找到删除按钮，绑定点击事件
                var self = this;
                layer.open({
                    content: '确定删除？',
                    btn: ['确定', '取消'],
                    yes: function (index) {
                        $(self).parent().parent().parent().parent().remove();
                        layer.closeAll();
                        tatol();
                    }
                });
            });
            //写入所有的订单
            var orders = '';
            var tatol = function () {
                // 计算总价格
                var count = 0;
                orders = '';
                $('.alist').map(function(index, item){
                    var $el = $(item);
                    if ($el.find('input[type="checkbox"]').is(":checked")) {
                        orders += $el.data('orderid')+',';
                        count += parseInt($el.data('price'));
                    }
                });
                if (count > 0) {
                    $('.settlement span').html(count + '元');
                    return true;
                }else{
                    $('.settlement span').html(0 + '元');
                    return false;
                }
            }
        </script>
        <script>
            //付款
            function _pay(obj){
                //判断有没有选择商品
                if( !tatol() ){
                    layer.open({
                        title: '提示',
                        shadeClose:true,//点击遮罩关闭
                        content: '没有先择商品',
                        yes:function(){
                            layer.closeAll();
                        },
                        cancel: function(){
                        }
                    });
                }else{
                    window.location.href='/wap/order/confirm?orders='+orders;
                }
            }
        </script>

@endsection
