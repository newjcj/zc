@extends('view.master.index')
@section('title','首页')
@section('cartnum',11)
@section('asset')
    <link rel="shortcut icon" type="image/x-icon" href="/view/one/img/icon/favicon.ico">
    <link rel="stylesheet" type="text/css" href="/view/one/css/base.css">
    <link rel="stylesheet" type="text/css" href="/view/one/css/home.css">
    <link rel="stylesheet" type="text/css" href="/view/one/css/member.css">
    <script type="text/javascript" src="/view/one/js/jquery.js"></script>
    <script type="text/javascript" src="/view/one/js/index.js"></script>
    <script type="text/javascript" src="/view/one/js/modernizr-custom-v2.7.1.min.js"></script>
    <script type="text/javascript" src="/view/one/js/jquery.SuperSlide.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="/view/one/img/icon/favicon.ico">
    <link rel="stylesheet" type="text/css" href="/view/one/css/base.css">
    <link rel="stylesheet" type="text/css" href="/view/one/css/home.css">
    <link rel="stylesheet" type="text/css" href="/view/one/css/member.css">
    <script type="text/javascript" src="/view/one/js/jquery.js"></script>
    <script type="text/javascript" src="/view/one/js/index.js"></script>
    <script type="text/javascript" src="/view/one/js/modernizr-custom-v2.7.1.min.js"></script>
    <script type="text/javascript" src="/view/one/js/jquery.SuperSlide.js"></script>
    <script type="text/javascript">
        var intDiff = parseInt(90000);//倒计时总秒数量
        function timer(intDiff){
            window.setInterval(function(){
                var day=0,
                    hour=0,
                    minute=0,
                    second=0;//时间默认值
                if(intDiff > 0){
                    day = Math.floor(intDiff / (60 * 60 * 24));
                    hour = Math.floor(intDiff / (60 * 60)) - (day * 24);
                    minute = Math.floor(intDiff / 60) - (day * 24 * 60) - (hour * 60);
                    second = Math.floor(intDiff) - (day * 24 * 60 * 60) - (hour * 60 * 60) - (minute * 60);
                }
                if (minute <= 9) minute = '0' + minute;
                if (second <= 9) second = '0' + second;
                $('#day_show').html(day+"天");
                $('#hour_show').html('<s id="h"></s>'+hour+'时');
                $('#minute_show').html('<s></s>'+minute+'分');
                $('#second_show').html('<s></s>'+second+'秒');
                intDiff--;
            }, 1000);
        }

        $(function(){
            timer(intDiff);
        });//倒计时结束

        $(function(){
            /*======右按钮======*/
            $(".you").click(function(){
                nextscroll();
            });
            function nextscroll(){
                var vcon = $(".v_cont");
                var offset = ($(".v_cont li").width())*-1;
                vcon.stop().animate({marginLeft:offset},"slow",function(){
                    var firstItem = $(".v_cont ul li").first();
                    vcon.find(".flder").append(firstItem);
                    $(this).css("margin-left","0px");
                });
            };
            /*========左按钮=========*/
            $(".zuo").click(function(){
                var vcon = $(".v_cont");
                var offset = ($(".v_cont li").width()*-1);
                var lastItem = $(".v_cont ul li").last();
                vcon.find(".flder").prepend(lastItem);
                vcon.css("margin-left",offset);
                vcon.animate({marginLeft:"0px"},"slow")
            });
        });

    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            var $miaobian=$('.Xcontent08>div');
            var $huantu=$('.Xcontent06>img');
            var $miaobian1=$('.Xcontent26>div');
            $miaobian.mousemove(function(){miaobian(this);});
            $miaobian1.click(function(){miaobian1(this);});
            function miaobian(thisMb){
                for(var i=0; i<$miaobian.length; i++){
                    $miaobian[i].style.borderColor = '#dedede';
                }
                thisMb.style.borderColor = '#cd2426';

                $huantu[0].src = thisMb.children[0].src;
            }
            function miaobian1(thisMb1){
                for(var i=0; i<$miaobian1.length; i++){
                    $miaobian1[i].style.borderColor = '#dedede';
                }
//		thisMb.style.borderColor = '#cd2426';
                $miaobian.css('border-color','#dedede');
                thisMb1.style.borderColor = '#cd2426';
                $huantu[0].src = thisMb1.children[0].src;
            }
            $(".Xcontent33").click(function(){
                var value=parseInt($('.input').val())+1;
                $('.input').val(value);
            })

            $(".Xcontent32").click(function(){
                var num = $(".input").val();
                if(num>0){
                    $(".input").val(num-1);
                }

            })

        })
    </script>

@endsection
@section('content')
    <div class="containers center"><div class="pc-nav-item"><a href="#">首页</a> &gt; <a href="#">会员中心 </a> &gt; <a href="#">商城快讯</a></div></div>
    <section id="member">
        <div class="member-center clearfix">
            <div class="member-left fl">
                <div class="member-apart clearfix">
                    <div class="fl"><a href="#"><img src="img/mem.png"></a></div>
                    <div class="fl">
                        <p>用户名：</p>
                        <p><a href="#">亚里士多德</a></p>
                        <p>搜悦号：</p>
                        <p>389323080</p>
                    </div>
                </div>
                <div class="member-lists">
                    <dl>
                        <dt>我的商城</dt>
                        <dd><a href="/view/member/order">我的订单</a></dd>
                        <dd><a href="#">我的收藏</a></dd>
                        <dd><a href="#">账户安全</a></dd>
                        <dd><a href="#">我的评价</a></dd>
                        <dd><a href="#">地址管理</a></dd>
                    </dl>
                    <dl>
                        <dt>客户服务</dt>
                        <dd class="cur"><a href="/view/member/rejectorder">退货申请</a></dd>
                        <dd><a href="#">退货/退款记录</a></dd>
                    </dl>
                    <dl>
                        <dt>我的消息</dt>
                        <dd><a href="#">商城快讯</a></dd>
                        <dd><a href="#">帮助中心</a></dd>
                    </dl>
                </div>
            </div>
            <div class="member-right fr">
                <div class="member-head">
                    <div class="member-heels fl"><h2>退货申请</h2></div>
                    <div class="member-backs member-icons fr"><a href="#">搜索</a></div>
                    <div class="member-about fr"><input placeholder="商品名称/商品编号/订单编号" type="text"></div>
                </div>
                @if(count($order)>0)
                    @foreach($order as $item)
                        @if(count($item->goodss))
                <div class="member-border" id="div1">
                    <div class="member-newly"><span><b>订单号：</b>{{$item->orderuuid}}</span> <span><b>订单状态：</b><i class="reds">已完成</i></span></div>
                    <div class="member-cargo">
                        <h3>收货人信息：</h3>
                        <p>{{$item->useraddress->addressname}}</p>
                        <p>{{$item->useraddress->phone}}</p>
                        <p>{{$item->useraddress->address}}</p>
                    </div>
                    <div class="member-cargo">
                        <h3>商品信息：</h3>
                        {{--不知道怎么遍历shopname<p>{{($item->user->shop)[0]->name}}</p>--}}
                    </div>
                    <div class="member-sheet clearfix">
                        <ul>
                            <li>
                                <div class="member-circle clearfix">

                                @foreach($item->goodss as $good)
                                   @if($good->pivot->status==2)
                                    <div class="member-apply clearfix" name="alldiv">
                                        <div class="ap1 fl">
                                            <span class="gr1"><a href="#"><img about="" title="" src="{{ \App\Models\Goods::getGoodsimages($good)[0] }}" width="60" height="60"></a></span>
                                            <span class="gr2"><a href="#">{{ $good->name }}</a></span>
                                            <span class="gr3">X{{ $good->pivot->num }}</span>

                                        </div>
                                        {{--<div class="ap2 fl"><a href="#">查看订单</a> </div>--}}
                                        <div class="ap3 fl"><a onclick="show({{$good->pivot->id}});">申请退款</a> </div>
                                    </div>
                                   @endif
                                @endforeach

                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="member-modes clearfix">
                        <p class="clearfix"><b>支付方式：</b><em>块钱</em></p>
                        <p class="clearfix"><b>发票信息：</b><em>无发票</em></p>
                    </div>
                    <div class="member-modes clearfix">
                        <p class="clearfix"><b>配送方式：</b><em> 顺丰快递</em></p>
                    </div>
                    <div class="member-modes clearfix">
                        <p class="clearfix"><b>商品金额：</b><em><span name="price">{{$item->price}}</span>元</em></p>
                        <p class="clearfix"><b>运费：无</b><em></em></p>
                    </div>
                    <div class="member-modes clearfix">
                        <p class="clearfix"><b>订单合计金额：</b><em> <span name="price1">{{$item->price}}</span>元</em></p>
                    </div>
                </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </section>


    <div style="height:100px"></div>

@endsection
@section('script')
    <script type="text/javascript">
        function show(id) {
            // alert(id);
            // return;
            if (confirm("确定要申请退款吗？")) {
                $.ajax({
                    url: '/view/member/delete1',
                    data: {
                        id:id,
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    type: 'post',
                    dataType: 'json',
                    async:false,
                    success: function (data) {
                        console.log(data.status);
                        if(data.status === 1){
                            alert("申请成功，请等待审核。。。");
                        }else{
                            alert("申请失败，请联系管理员！");
                        }
                        // if(data.status === 1){
                        //     info.html('用户已经存在');
                        // }else{
                        //     status=true;
                        //     info.css({display:'none'});
                        // }
                    }
                });
               window.location.reload();
            }
        }

        //hover 触发两个事件，鼠标移上去和移走
        //mousehover 只触发移上去事件
        $(".top-nav ul li").hover(function () {
            $(this).addClass("hover").siblings().removeClass("hover");
            $(this).find("li .nav a").addClass("hover");
            $(this).find(".con").show();
        }, function () {
            //$(this).css("background-color","#f5f5f5");
            $(this).find(".con").hide();
            //$(this).find(".nav a").removeClass("hover");
            $(this).removeClass("hover");
            $(this).find(".nav a").removeClass("hover");
        })
    </script>
@endsection