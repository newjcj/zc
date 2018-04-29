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
    <header id="header" style="" >
        <input type="hidden" value="{{$orderid}}" id="order">
        <input type="hidden" value="{{($order->goodss)[0]->pivot->evaluate_rank}}" id="rank">
        <input type="hidden" value="{{$goodid}}" id="good">
        <div class="topbar">
            <a href="javascript:history.back();" class="back_btn"><i class="iconfont">ş</i></a>
            {{--<div style=" float: right; padding-top:20px; padding-right: 20px; "><span id="span1"><font size="+1.2" color="white">提交</font></span></div>--}}
            <h1 class="page_title">查看评价</h1>

        </div>
    </header>
    <!-- 会员俱乐部1 -->

        {{--待评价--}}
       <div id="div1">

        <div class="vip-club border_top_bottom" style=" margin-top: 2px;" >
            <ul>
                <li style="float:left; margin-left: 20px; margin-top: 20px;"><img src="{{$img}}" width="120"/></li>
                <li style=" float: left; margin-left: 30px; margin-top: 20px; ">
                    <font color="#a52a2a">评分</font><br>

                    <img src="/wap/images/star1.png" width="20"  id="star1" style=" display: none;" name="rank"/>
                    <img src="/wap/images/star1.png" width="20"  id="star2" style=" display: none;" name="rank"/>
                    <img src="/wap/images/star1.png" width="20"  id="star3" style=" display: none;" name="rank"/>
                    <img src="/wap/images/star1.png" width="20"  id="star4" style=" display: none;" name="rank"/>
                    <img src="/wap/images/star1.png" width="20"  id="star5" style=" display: none;" name="rank"/>

                </li>
                <li  style=" float: left; padding-top: 10px;">&nbsp;&nbsp;
                    <textarea rows="10" cols="10" style=" width: 500px; font-size: larger; color: #0c0c0c; text-align: left;" id="content" placeholder=" 请填写您的评价：" readonly="readonly">{{ ($order->goodss)[0]->pivot->evaluate }}</textarea>
                </li>

            </ul>
        </div>

        </div>






    <br><br><br><br><br><br>
@endsection

@section('script')
    <script>
        $(function(){
           for(var i = 1;i<=$("#rank").val();i++){
               $("#star"+i).show();
            }

            $.trim($("#content").val());
        })





    </script>
@endsection