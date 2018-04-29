@extends('wap.master.index')
@section('title','会员中心')
@section('head')
    <link rel="stylesheet" type="text/css" href="/wap/css/center.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/loaders.min.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/loading.css"/>
    <script src="/wap/js/rem.js"></script>
    <script src="/wap/js/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/admin/js/register.js"></script>
    <script type="text/javascript">
        sessionStorage.url = "confirm";
        $(window).load(function () {
            $(".loading").addClass("loader-chanage");
            $(".loading").fadeOut(300);
        })
    </script>
@endsection

@section('content')

    @include('wap.user.master.center')
    <!-- 会员俱乐部 -->
    <div class="vip-club border_top_bottom">
        {{--<div class="vip-club-title border_bottom">--}}
        {{--<span><i class="iconfont"></i>会员俱乐部</span>--}}
        {{--<a href="">每日签到领积分<i class="iconfont"></i></a>--}}
        {{--</div>--}}
        <ul>
            <li><a href="/wap/user/orderlist?a=0"><i class="iconfont"></i><p>我的订单</p> </a></li>
            <li><a href="/wap/user/myad"><i class="iconfont"></i><p>我的推广注册</p> </a></li>
            <li><a href="/wap/user/deposit"><i class="iconfont" style="font-size: 28px;"></i><p>提现</p> </a></li>
            <li><a href="/wap/user/myteam"><i class="iconfont"></i><p>我的团队</p> </a></li>
            {{--<li><a href="/wap/user/shop"><i class="iconfont"></i><p>商家入驻</p> </a></li>--}}
            <li><a href="/wap/user/address"><i class="iconfont"></i><p>地址管理</p> </a></li>

            @if($user->shop)
                @if($user->shop->certify==0)
                    <li><a href="/wap/user/shop"><i class="iconfont"></i>
                            <p>商家入驻</p></a></li>
                @elseif($user->shop->certify==1)
                    <li><a href="#"><i class="iconfont"></i>
                            <p>入驻成功</p></a></li>
                @elseif($user->shop->certify==3)
                    <li><a href="#"><i class="iconfont"></i>
                            <p>入驻失败</p></a></li>
                @elseif($user->shop->certify==4)
                    <li><a href="#"><i class="iconfont"></i>
                            <p>不允许入驻</p></a></li>
                @else
                @endif
                @else
                <li><a href="/wap/user/shop"><i class="iconfont"></i>
                        <p>商家入驻</p></a></li>
            @endif
        </ul>
    </div>
    <div class="vip-club border_top_bottom vip-account">
        {{--<div class="vip-club-title border_bottom">--}}
        {{--<span><i class="iconfont"></i>我的账户</span>--}}
        {{--<a href="./index.html">积分兑换商品<i class="iconfont"></i></a>--}}
        {{--</div>--}}
        <ul>
            <li><a href=""><i class="color_f44623">{{ $user->money }}</i>
                    <p>账户余额</p></a></li>
            <li><a href=""><i class="color_f4a425">{{ $user->shop_coin }}</i>
                    <p>我的积分</p></a></li>
            {{--<li><a href=""><i class="color_45a1de">0</i><p>我的礼券</p> </a></li>--}}
            {{--<li><a href=""><p>退出</p> </a></li>--}}
        </ul>
    </div>
    <div class="vip-list-icon border_top_bottom">
        <ul>
            {{--<li class="border_bottom">--}}
            {{--<a href="" class="border_right"><i class="iconfont icon-sousuo"></i><em>维修查询</em></a>--}}
            {{--<a href=""><i class="iconfont" style="font-size:24px;"></i><em>报修退换</em></a>--}}
            {{--</li>--}}
            {{--<li class="border_bottom">--}}
            {{--<a href="" class="border_right"><i class="iconfont" style="font-size:24px;"></i><em>物流查询</em></a>--}}
            {{--<a href="/wap/user/address"><i class="iconfont icon-dizhi1"></i><em>收货地址</em></a>--}}
            {{--</li>--}}
            {{--<li class="border_bottom">--}}
            {{--<a href="" class="border_right"><i class="iconfont"></i><em>评价晒单</em></a>--}}
            {{--<a href=""><i class="iconfont" style="font-size:20px; text-indent:2px;"></i><em>我的投诉</em></a>--}}
            {{--</li>--}}
            <li>
                {{--<a href="" class="border_right"><i class="iconfont"></i><em>我的咨询</em></a>--}}
                <a href="/wap/login/logout"><i class="iconfont" style="font-size:23px;"></i><em>退出</em></a>
            </li>
        </ul>
    </div>
    <div style=" float: left; width: 80px; height: 28px; border: #0c0c0c 0px solid; margin-top: 45px; margin-left: 100px; position: absolute; z-index: 2; ">
       <p><font size="+1" color="#53484a" ><strong>{{$user->name}}</strong></font></p>
    </div>

    <div style=" float: left; width: 50px; height: 28px; border: #0c0c0c 0px solid; margin-top: 45px; margin-left: 375px; position: absolute; z-index: 2; ">
        <p><strong><a href="/wap/user/deposit"><font size="+1" color="white" >提&nbsp;&nbsp;现</font></a></strong></p>
    </div>

    <div style=" float: left; width: 50px; height: 18px; border: #0c0c0c 0px solid; margin-top: 94.5px; margin-left: 155px; position: absolute; z-index: 2; ">
        <p><font size="" color="#3c3c3c" style=" opacity: 0.4; " >邀请人</font></p>
    </div>

    <div style=" float: left; width: 65px; height: 20px; border: #0c0c0c 0px solid; margin-top: 385px; margin-left: 57px; position: absolute; z-index: 2; ">
        <p><font size="" color="black"  >分享赚钱</font></p>
    </div>

    <div style=" float: left; width: 65px; height: 20px; border: #0c0c0c 0px solid; margin-top: 385px; margin-left: 188px; position: absolute; z-index: 2; ">
        <p><font size="" color="black"  >官方客服</font></p>
    </div>

    <div style=" float: left; width: 65px; height: 20px; border: #0c0c0c 0px solid; margin-top: 385px; margin-left: 325px; position: absolute; z-index: 2;  position: absolute;">
        <p><font size="" color="black"  >我的粉丝</font></p>
    </div>

    <div style=" float: left; width: 65px; height: 20px; border: #0c0c0c 0px solid; margin-top: 420px; margin-left: 20px; position: absolute; z-index: 2; position: absolute; ">
        <p><font size="" color="black"  ><b>我的订单</b></font></p>
    </div>

    <div style=" float: left; width: 90px; height: 20px; border: #0c0c0c 0px solid; margin-top: 420px; margin-left: 310px; position: absolute; z-index: 2; position: absolute; ">
        <p><font size="" color="#3c3c3c" style=" opacity: 0.4; "  ><b><a href="/wap/user/orderlist?a=0">查看全部订单</a></b></font></p>
    </div>

    <div style=" float: left; width: 80px; height: 20px; border: #0c0c0c 0px solid; margin-top: 490px; margin-left: 18px; position: absolute; z-index: 2; position: absolute; ">
        <p><font size="" color=""  ><b><a href="/wap/user/orderlist?a=1">代付款（{{$fknum}}）</a></b></font></p>
    </div>

    <div style=" float: left; width: 80px; height: 20px; border: #0c0c0c 0px solid; margin-top: 490px; margin-left: 132px; position: absolute; z-index: 2; position: absolute; ">
        <p><font size="" color=""  ><b>代发货（）</b></font></p>
    </div>

    <div style=" float: left; width: 80px; height: 20px; border: #0c0c0c 0px solid; margin-top: 490px; margin-left: 240px; position: absolute; z-index: 2; position: absolute; ">
        <p><font size="" color=""  ><b><a href="/wap/user/orderlist?a=2">代收货（{{$dshnum}}）</a></b></font></p>
    </div>

    <div style=" float: left; width: 80px; height: 20px; border: #0c0c0c 0px solid; margin-top: 490px; margin-left: 354px; position: absolute; z-index: 2; position: absolute; ">
        <p><font size="" color=""  ><b><a href="/wap/user/evaluate?a=1">代评价（{{$eval}}）</a></b></font></p>
    </div>

    <div style=" float: left; width: 100px; height: 20px; border: #0c0c0c 0px solid; margin-top: 530px; margin-left: 18px; position: absolute; z-index: 2; position: absolute; ">
        <p><font size="+0.8" color="#3c3c3c"  ><b><a href="/wap/user/myad">我的推广注册</a></b></font></p>
    </div>

    <div style=" float: left; width: 70px; height: 20px; border: #0c0c0c 0px solid; margin-top: 565px; margin-left: 18px; position: absolute; z-index: 2; position: absolute; ">
        <p><font size="+0.8" color="#3c3c3c"  ><b><a href="/wap/user/address">收货地址</a></b></font></p>
    </div>

    <div style=" float: left; width: 70px; height: 20px; border: #0c0c0c 0px solid; margin-top: 600px; margin-left: 18px; position: absolute; z-index: 2; position: absolute; ">
        <font size="+0.8" color="#3c3c3c"  ><b>
                    @if($user->shop)
                        @if($user->shop->certify==0)
                                <a href="/wap/user/shop"><p>商家入驻</p></a>
                            @elseif($user->shop->certify==1)
                                <a href="#"><p>入驻成功</p></a>
                            @elseif($user->shop->certify==3)
                                <a href="#"><p>入驻失败</p></a>
                            @elseif($user->shop->certify==4)
                                <a href="#"><p>不允许入驻</p></a>
                        @endif
                    @endif
        </b></font>
    </div>

    <div style=" float: left; width: 70px; height: 20px; border: #0c0c0c 0px solid; margin-top: 635px; margin-left: 18px; position: absolute; z-index: 2; position: absolute; ">
        <p><font size="+0.8" color="#3c3c3c"  ><b><a href="/wap/login/logout">退出</a></b></font></p>
    </div>


@endsection

@section('script')
    <script>
        $('form').submit(function () {
            return false;
        });
        //登录
        jcj_validate($('.loginform'), function (data) {
            if (data.status === 1) {
                //提示
                setTimeout(function () {
                    window.location.href = data.returnurl;
                }, 100)
            } else {
                layer.open({
                    content: data.message
                    , skin: 'msg'
                    , time: 2000 //2秒后自动关闭
                });
                setTimeout(function () {
                    window.location.reload();
                }, 1000)
            }
        });
    </script>
@endsection