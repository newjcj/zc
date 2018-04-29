@extends('wap.master.index')
@section('title','确认订单')
@section('head')
    <link rel="stylesheet" type="text/css" href="/wap/css/base.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/confirm.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/mui.min.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/loaders.min.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/loading.css"/>
    <script src="/wap/js/rem.js"></script>
    <script src="/wap/js/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        sessionStorage.url = "confirm";
        $(window).load(function () {
            $(".loading").addClass("loader-chanage")
            $(".loading").fadeOut(300)
        })
    </script>
@endsection

@section('title1',222)

@section('content')
    <header class="mui-bar mui-bar-nav" id="header">
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
            <div class="add clearfloat box-s">
                <a href="address.html">
                    <div class="left clearfloat fl">
                        <i class="iconfont icon-dizhi1"></i>
                    </div>
                    <div class="middle clearfloat fl">
                        <p class="tit">
                            收货人：小王&nbsp;&nbsp;&nbsp;&nbsp;1580888888
                        </p>
                        <p class="fu-tit over2">
                            收货地址：湖南省长沙市高新区拓基城市广场金座A2002
                        </p>
                    </div>
                    <div class="left clearfloat fr">
                        <i class="iconfont icon-jiantou1"></i>
                    </div>
                </a>
            </div>
            @if($order)
                    <div class="gmshu clearfloat box-s fl">
                        <div class="gcontent clearfloat">
                            <p class="fl">订单号</p>
                            <div class="you clearfloat fr">
                                <p>{{ $order->orderuuid}}</p>
                            </div>
                        </div>
                    </div>
                    @foreach($order->goodss as $goods)
                        <div class="lie clearfloat">
                            <a href="detail.html">
                                <div class="tu clearfloat fl">
                                    <img src="{{ \App\Models\Goods::getGoodsimages($goods)[0] }}"/>
                                </div>
                            </a>
                            <div class="right clearfloat fl">
                                <a href="detail.html">
                                    <p class="tit over">{{ $goods->name }}</p>
                                    {{--<p class="fu-tit">颜色：蓝色 内存：120G</p>--}}
                                </a>
                                <div class="xia clearfloat">
                                    <a href="detail.html">
                                        <p class="jifen fl over">{{ $goods->price }} 元</p>
                                    </a>
                                    <span class="fr db">×{{ $goods->pivot->num }}</span>
                                </div>
                            </div>
                        </div>
                @endforeach
            @endif
            {{--<div class="gmshu clearfloat box-s fl">--}}
                {{--<div class="gcontent clearfloat">--}}
                    {{--<p class="fl">购买数量</p>--}}
                    {{--<div class="you clearfloat fr">--}}
                        {{--<ul>--}}
                            {{--<li><img src="/wap/images/jian.jpg"/></li>--}}
                            {{--<li>1</li>--}}
                            {{--<li><img src="/wap/images/jia.jpg"/></li>--}}
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
                            {{--<div class="radiotwo">--}}
                                {{--<label>--}}
                                    {{--<input type="radio" name="fapiao" value="" checked/>--}}
                                    {{--<div class="option"></div>--}}
                                    {{--<span class="opt-text">需要发票</span>--}}
                                {{--</label>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="xuan clearfloat">--}}
                            {{--<div class="radiotwo">--}}
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
            <div class="gmshu gmshuthree clearfloat box-s fl">
                <div class="gcontent clearfloat">
                    <p class="fl">买家留言</p>
                    <div class="you clearfloat fl">
                        <input type="text" name="" id="" value="" class="text" placeholder="选填 对本次交易需求给商家留言"/>
                    </div>
                </div>
            </div>
            <div class="gmshu clearfloat box-s fl">
                <p class="fr">共1件商品 合计<samp>{{ $order->price}}元</samp></p>
            </div>

        </div>
    </div>

    <!--settlement star-->
    <div class="settlement clearfloat">
        <div class="zuo clearfloat fl box-s">
            共<span>1</span>件 总积分：<span>{{ $order->num }}</span>
        </div>
        <a href="zhifu.html" class="fl db">
            提交订单
        </a>
    </div>
@endsection

@section('script')

@endsection