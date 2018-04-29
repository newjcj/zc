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
                    {{--<div class="fl"><a href="#"><img src="img/mem.png"></a></div>--}}
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
                        <dd class="cur"><a href="#">我的订单</a></dd>
                        <dd><a href="#">我的收藏</a></dd>
                        <dd><a href="#">账户安全</a></dd>
                        <dd><a href="#">我的评价</a></dd>
                        <dd><a href="#">地址管理</a></dd>
                    </dl>
                    <dl>
                        <dt>客户服务</dt>
                        <dd><a href="/view/member/rejectorder">退货申请</a></dd>
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
                    <div class="member-heels fl"><h2>我的订单</h2></div>
                    <div class="member-backs member-icons fr"><a href="#">搜索</a></div>
                    <div class="member-about fr"><input placeholder="商品名称/商品编号/订单编号" type="text"></div>
                </div>
                <div class="member-whole clearfix">
                    <ul id="H-table" class="H-table">
                        <li class="cur"><a href="/view/member/order">我的订单</a></li>
                        <li><a onclick="move1()">待付款<em>(44)</em></a></li>
                        <li><a onclick="move2()">待发货</a></li>
                        <li><a onclick="move3()">待收货</a></li>
                        <li><a onclick="move4()">交易完成</a></li>
                        <li><a onclick="move5()">订单信息</a></li>
                    </ul>
                </div>


                <div class="member-border">
                    <div class="member-return H-over" id="div1">
                        <div class="member-cancel clearfix">
                            <span class="be1">订单信息</span>
                            <span class="be2">收货人</span>
                            <span class="be2">订单金额</span>
                            <span class="be2">订单时间</span>
                            <span class="be2">订单状态</span>
                            <span class="be2">订单操作</span>
                        </div>
                        <div class="member-sheet clearfix" >
                            <ul>
                                 <input type="hidden" value="{{$order}}" id="order">
                                @if(count($order)>0)
                                    @foreach($order as $item)
                                <li>
                                    <div class="member-minute clearfix">
                                        <span>{{$item->created_at}}</span>
                                        <span>订单号：<em>{{$item->orderuuid}}</em></span>
                                        <span class="member-custom">客服电话：<em>010-6544-0986</em></span>
                                    </div>

                                    <div class="member-circle clearfix">
                                        <div class="ci1">
                                            @if(count($item->goodss))
                                                @foreach($item->goodss as $good)
                                            <div class="ci7 clearfix">
                                                <span class="gr1"><a href="#"><img src="{{ \App\Models\Goods::getGoodsimages($good)[0] }}" title="" about="" width="60" height="60"></a></span>
                                                <span class="gr2"><a href="#">{{ $good->name }}</a></span>
                                                <span class="gr3">X{{ $good->pivot->num }}</span>
                                            </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="ci2">{{$item->useraddress->addressname}}</div>
                                        <div class="ci3"><b>￥<span name="price">{{$item->price}}</span></b><p>货到付款</p><p class="iphone">手机订单</p></div>
                                        <div class="ci4"><p>{{$item->created_at}}</p></div>
                                        <div class="ci5"><p>等待付款</p> <p><a href="#">物流跟踪</a></p> <p><a href="#">订单详情</a></p></div>
                                        <div class="ci5 ci8">
                                            <p>
                                                <a href="#" class="member-touch">
                                                    <font color="#dc143c">
                                                        {{ $item->status==0?'提醒发货':'' }}
                                                        {{ $item->status==1?'已经发货':'' }}
                                                        {{ $item->status==2?'确认收货':'' }}
                                                        {{ $item->status==3?'已收货':'' }}
                                                        {{ $item->status==4?'退货':'' }}
                                                        {{ $item->status==5?'退货已发货':'' }}
                                                        {{ $item->status==6?'退货已收货':'' }}
                                                        {{ $item->status==7?'立即支付':'' }}
                                                    </font>
                                                </a>
                                            </p>
                                            <p><a id="cancel" onclick="cancel({{ $item->id}})">取消订单</a> </p>
                                        </div>
                                    </div>
                                </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>



                    </div>
                    <div class="H-over member-over" style="display:none;"><h2>待发货</h2></div>
                    <div class="H-over member-over" style="display:none;"><h2>待收货</h2></div>
                    <div class="H-over member-over" style="display:none;"><h2>交易完成</h2></div>
                    <div class="H-over member-over" style="display:none;"><h2>订单信息</h2></div>

                    <div class="clearfix" style="padding:30px 20px;">
                        <div class="fr pc-search-g pc-search-gs">
                            <a style="display:none" class="fl " href="#">上一页</a>
                            <a href="#" class="current">1</a>
                            <a href="javascript:;">2</a>
                            <a href="javascript:;">3</a>
                            <a href="javascript:;">4</a>
                            <a href="javascript:;">5</a>
                            <a href="javascript:;">6</a>
                            <a href="javascript:;">7</a>
                            <span class="pc-search-di">…</span>
                            <a href="javascript:;">1088</a>
                            <a title="使用方向键右键也可翻到下一页哦！" class="" href="javascript:;">下一页</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div style="height:100px"></div>
@endsection
@section('script')
    <script type="text/javascript">

        function cancel(id){
            if (confirm("确定要取消订单吗？")) {
                $.ajax({
                    url: '/view/member/delete',
                    data: {
                        id:id,
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    type: 'post',
                    dataType: 'json',
                    async:false,
                    success: function (data) {
                        console.log(data.status);
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
           // }
        }

        function move1(){
            $("#div1").hide();
            $("#div2").hide();
            $.ajax({
                url: '/view/member/index1',
                data: {
                    _token: "<?php echo e(csrf_token()); ?>"
                },
                type: 'post',
                dataType: 'json',
                async:false,
                success: function (data) {
                    console.log(data.data);
                    // if(data.status === 1){
                    //     info.html('用户已经存在');
                    // }else{
                    //     status=true;
                    //     info.css({display:'none'});
                    // }
                }
            });
        }

        $(function(){

        });
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