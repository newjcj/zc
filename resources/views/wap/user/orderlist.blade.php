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
            <h1 class="page_title">订单列表</h1>
        </div>
    </header>
    <!-- 会员俱乐部 -->
    <div class="vip-club border_top_bottom vip-account">
        <div class="vip-club-title border_bottom">
            <span style="width:25%;display:inline-block;text-align:center;color:red;" id="span1" onclick="move(1);">全部订单({{$allnum}})</span>
            <span style="width:23%;display:inline-block;text-align:center;" id="span2" onclick="move(2);">待付款({{$fknum}})</span>
            <span style="width:23%;display:inline-block;text-align:center;" id="span4" onclick="move(4);">待发货({{$dfhnum}})</span>
            <span style="width:25%;display:inline-block;text-align:center;" id="span3" onclick="move(3);">待收货({{$dshnum}})</span>
        </div>
         <input type="hidden" id="a" value="{{$a}}">
        {{--全部订单--}}
        <div id="div1">
        @if(count($orders)>0)
            @foreach($orders as $item)
                @if($item->status!=4)
                    <div class="vip-club border_top_bottom" >
                        <div class="vip-club-title border_bottom">
                            <span>订单号:{{$item->orderuuid}}</span><br>
                            <span>时间:{{$item->created_at}}</span>
                            <a>
                                <font color="#dc143c">
                                    {{ $item->status==0?'待付款':'' }}
                                    {{ $item->status==1?'待发货':'' }}
                                    {{ $item->status==2?'已签收':'' }}
                                    {{ $item->status==3?'确认收货':'' }}
                                </font>
                            </a>
                        </div>
                        <ul>
                            @if(count($item->goodss))
                                @foreach($item->goodss as $good)
                            <li style="float:left; margin-left: 20px; margin-top: 20px;"><img src="{{ \App\Models\Goods::getGoodsimages($item->goodss[0])[0] }}" width="120"/></li>
                            <li style=" float: left; margin-left: 10px; margin-top: 20px; "><font color="#a52a2a"><?php echo mb_substr($item->goodss[0]->name,0,10,'utf-8')."..."?></font></li>
                            <li style="float:right;margin-top:40px;margin-right:20px;">共{{ $re[$item->id]['num'] }}件 </li>
                                @endforeach
                            @endif
                            <li class="border_bottom" style="line-height:45px;text-align:right;clear:both;margin-right:20px;font-size:16px;">
                                共{{$re[$item->id]['knum']}}款商品，合计：<b style="color:red">￥{{$re[$item->id]['totalprice']}}</b>
                            </li>
                            <li  style="line-height:45px;text-align:right;margin-right:20px;">
                                @if($item->status==0)
                                    <input type="button" class="sub" value="投诉" style="line-height:30px;border:solid 1px #ccc;background:#fff;color:#bbb;width:80px;">
                                    <input type="button" class="sub" value="查看详情" onclick="show({{$item->id}})" style="line-height:30px;border:solid 1px #ccc;background:#fff;color:#464646;width:80px;">
                                    <input type="button" class="sub" value="确认付款" style="line-height:30px;border:solid 1px #84c1ff;background:#1980e0;color:#fff;width:80px;" onclick="pay({{$item->id}});">
                                   @elseif($item->status==1)
                                    <input type="button" class="sub" value="投诉" style="line-height:30px;border:solid 1px #ccc;background:#fff;color:#bbb;width:80px;">
                                    <input type="button" class="sub" value="查看详情"  onclick="show({{$item->id}})"  style="line-height:30px;border:solid 1px #ccc;background:#fff;color:#464646;width:80px;">
                                    <input type="button" class="sub" value="确认收货" onclick="_f({{$item->id}});" style="line-height:30px;border:solid 1px #84c1ff;background:#e82c23;color:#fff;width:80px;">
                                   @else
                                    <input type="button" class="sub" value="投诉" style="line-height:30px;border:solid 1px #ccc;background:#fff;color:#bbb;width:80px;">
                                    <input type="button" class="sub" value="查看详情"  onclick="show({{$item->id}})"  style="line-height:30px;border:solid 1px #ccc;background:#fff;color:#464646;width:80px;">
                                    <input type="button" class="sub" value="查看物流"  onclick="show1({{$item->id}})"  style="line-height:30px;border:solid 1px #ccc;background:#fff;color:#464646;width:80px;">
                                    <input type="button" class="sub" value="确认收货" onclick="_f({{$item->id}});" style="line-height:30px;border:solid 1px #84c1ff;background:#e82c23;color:#fff;width:80px;">
                                @endif
                            </li>
                        </ul>
                    </div>
                @endif
            @endforeach
        @endif
        </div>

        {{--待付款--}}
        <div id="div2" style="display: none;">
        @if(count($orders)>0)
            @foreach($orders as $item)
                @if($item->status==0)
                <div class="vip-club border_top_bottom" >
                    <div class="vip-club-title border_bottom">
                        <span>订单号:{{$item->orderuuid}}</span><br>
                        <span>时间:{{$item->created_at}}</span>
                        <a>
                            <font color="#dc143c">
                                {{ $item->status==0?'待付款':'' }}
                                {{ $item->status==1?'待发货':'' }}
                                {{ $item->status==2?'已签收':'' }}
                                {{ $item->status==3?'确认收货':'' }}
                            </font>
                        </a>
                    </div>
                    <ul>
                        @if(count($item->goodss))
                        @foreach($item->goodss as $good)
                        <li style="float:left;  margin-left: 20px; margin-top: 20px;"><img src="{{ \App\Models\Goods::getGoodsimages($item->goodss[0])[0] }}" width="120"/></li>
                        <li style=" float: left; margin-left: 10px; margin-top: 20px; "><font color="#a52a2a"><?php echo mb_substr($item->goodss[0]->name,0,10,'utf-8')."..."?></font></li>
                        <li style="float:right;margin-top:40px;margin-right:20px;">共{{ $re[$item->id]['num'] }}件 </li>
                        @endforeach
                        @endif
                        <li class="border_bottom" style="line-height:45px;text-align:right;clear:both;margin-right:20px;font-size:16px;">
                            共{{$re[$item->id]['knum']}}款商品，合计：<b style="color:red">￥{{$re[$item->id]['totalprice']}}</b>
                        </li>
                        <li  style="line-height:45px;text-align:right;margin-right:20px;">
                            @if($item->status==0)
                                <input type="button" class="sub" value="投诉" style="line-height:30px;border:solid 1px #ccc;background:#fff;color:#bbb;width:80px;">
                                <input type="button" class="sub" value="查看详情" onclick="show({{$item->id}})" style="line-height:30px;border:solid 1px #ccc;background:#fff;color:#464646;width:80px;">
                                <input type="button" class="sub" value="确认付款" style="line-height:30px;border:solid 1px #84c1ff;background:#1980e0;color:#fff;width:80px;" onclick="pay({{$item->id}});">
                            @else
                                <input type="button" class="sub" value="投诉" style="line-height:30px;border:solid 1px #ccc;background:#fff;color:#bbb;width:80px;">
                                <input type="button" class="sub" value="查看详情" onclick="show({{$item->id}})" style="line-height:30px;border:solid 1px #ccc;background:#fff;color:#464646;width:80px;">
                                <input type="button" class="sub" value="查看物流"  onclick="show1({{$item->id}})"  style="line-height:30px;border:solid 1px #ccc;background:#fff;color:#464646;width:80px;">
                                <input type="button" class="sub" value="确认收货" style="line-height:30px;border:solid 1px #84c1ff;background:#e82c23;color:#fff;width:80px;" onclick="_f({{$item->id}});">

                            @endif
                        </li>
                    </ul>
                </div>
                @endif
            @endforeach
        @endif
        </div>


        {{--待收货--}}
        <div id="div3" style=" display: none;">
        @if(count($orders)>0)
            @foreach($orders as $item)
                @if($item->status==2||$item->status==3)
                    <div class="vip-club border_top_bottom" >
                        <div class="vip-club-title border_bottom">
                            <span>订单号:{{$item->orderuuid}}</span><br>
                            <span>时间:{{$item->created_at}}</span>
                            <a>
                                <font color="#dc143c">
                                    {{ $item->status==0?'待付款':'' }}
                                    {{ $item->status==1?'待发货':'' }}
                                    {{ $item->status==2?'待收货':'' }}
                                    {{ $item->status==3?'确认收货':'' }}
                                </font>
                            </a>
                        </div>
                        <ul>
                            @if(count($item->goodss))
                            @foreach($item->goodss as $good)
                            <li style="float:left;  margin-left: 20px; margin-top: 20px;"><img src="{{ \App\Models\Goods::getGoodsimages($item->goodss[0])[0] }}" width="120"/></li>
                            <li style=" float: left; margin-left: 10px; margin-top: 20px; "><font color="#a52a2a"><?php echo mb_substr($item->goodss[0]->name,0,10,'utf-8')."..."?></font></li>
                            <li style="float:right;margin-top:40px;margin-right:20px;">共{{ $re[$item->id]['num'] }}件  </li>
                            @endforeach
                            @endif
                            <li class="border_bottom" style="line-height:45px;text-align:right;clear:both;margin-right:20px;font-size:16px;">
                                共{{$re[$item->id]['knum']}}款商品，合计：<b style="color:red">￥{{$re[$item->id]['totalprice']}}</b>
                            </li>
                            <li  style="line-height:45px;text-align:right;margin-right:20px;">
                                @if($item->status==0)
                                    <input type="button" class="sub" value="投诉" style="line-height:30px;border:solid 1px #ccc;background:#fff;color:#bbb;width:80px;">
                                    <input type="button" class="sub" value="查看详情" onclick="show({{$item->id}})" style="line-height:30px;border:solid 1px #ccc;background:#fff;color:#464646;width:80px;">
                                    <input type="button" class="sub" value="确认付款" style="line-height:30px;border:solid 1px #84c1ff;background:#1980e0;color:#fff;width:80px;" onclick="pay({{$item->id}});">
                                @else
                                    <input type="button" class="sub" value="投诉" style="line-height:30px;border:solid 1px #ccc;background:#fff;color:#bbb;width:80px;">
                                    <input type="button" class="sub" value="查看详情" onclick="show({{$item->id}})" style="line-height:30px;border:solid 1px #ccc;background:#fff;color:#464646;width:80px;">
                                    <input type="button" class="sub" value="查看物流"  onclick="show1({{$item->id}})"  style="line-height:30px;border:solid 1px #ccc;background:#fff;color:#464646;width:80px;">
                                    <input type="button" class="sub" value="确认收货" style="line-height:30px;border:solid 1px #84c1ff;background:#e82c23;color:#fff;width:80px;" onclick="_f({{$item->id}});">

                                @endif
                            </li>
                        </ul>
                    </div>
                @endif
            @endforeach
        @endif
        </div>

        {{--待发货--}}
        <div id="div4" style=" display: none;">
            @if(count($orders)>0)
                @foreach($orders as $item)
                    @if($item->status==1)
                        <div class="vip-club border_top_bottom" >
                            <div class="vip-club-title border_bottom">
                                <span>订单号:{{$item->orderuuid}}</span><br>
                                <span>时间:{{$item->created_at}}</span>
                                <a>
                                    <font color="#dc143c">
                                        {{ $item->status==0?'待付款':'' }}
                                        {{ $item->status==1?'待发货':'' }}
                                        {{ $item->status==2?'已签收':'' }}
                                        {{ $item->status==3?'确认收货':'' }}
                                    </font>
                                </a>
                            </div>
                            <ul>
                                @if(count($item->goodss))
                                @foreach($item->goodss as $good)
                                <li style="float:left;  margin-left: 20px; margin-top: 20px;"><img src="{{ \App\Models\Goods::getGoodsimages($item->goodss[0])[0] }}" width="120"/></li>
                                <li style=" float: left; margin-left: 10px; margin-top: 20px; "><font color="#a52a2a"><?php echo mb_substr($item->goodss[0]->name,0,10,'utf-8')."..."?></font></li>
                                <li style="float:right;margin-top:40px;margin-right:20px;">共{{ $re[$item->id]['num'] }}件  </li>
                                @endforeach
                                @endif
                                <li class="border_bottom" style="line-height:45px;text-align:right;clear:both;margin-right:20px;font-size:16px;">
                                    共{{$re[$item->id]['knum']}}款商品，合计：<b style="color:red">￥{{$re[$item->id]['totalprice']}}</b>
                                </li>
                                <li  style="line-height:45px;text-align:right;margin-right:20px;">
                                    @if($item->status==0)
                                        <input type="button" class="sub" value="投诉" style="line-height:30px;border:solid 1px #ccc;background:#fff;color:#bbb;width:80px;">
                                        <input type="button" class="sub" value="查看详情" onclick="show({{$item->id}})" style="line-height:30px;border:solid 1px #ccc;background:#fff;color:#464646;width:80px;">
                                        <input type="button" class="sub" value="确认付款" style="line-height:30px;border:solid 1px #84c1ff;background:#1980e0;color:#fff;width:80px;" onclick="pay({{$item->id}});">
                                    @else
                                        <input type="button" class="sub" value="投诉" style="line-height:30px;border:solid 1px #ccc;background:#fff;color:#bbb;width:80px;">
                                        <input type="button" class="sub" value="查看详情" onclick="show({{$item->id}})" style="line-height:30px;border:solid 1px #ccc;background:#fff;color:#464646;width:80px;">
                                    @endif
                                </li>
                            </ul>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>

    </div>
    <br><br><br><br><br><br>
@endsection

@section('script')
    <script>
        {{--pay({{$item->id}});--}}
        //确认付款的验证
        function pay(id) {
            $.ajax({
                url: '/wap/user/checkaddress',
                data: {
                    orderid:id,
                    _token: "{{csrf_token()}}"
                },
                type: 'post',
                dataType: 'json',
                async:false,
                success: function (data) {
                    if(data.status === 1){
                        location.href='/wap/order/confirm?orders='+id;
                    }else{
                        alert("请选择地址再付款！");
                        location.href="/wap/user/address?a=1&order_id="+id;
                    }
                }
            });
        }

         $(function (){
             var a = $("#a").val();
            if(a==0){
                $("#div1").show();$("#span1").css("color","red");
                $("#div2").hide();$("#span2").css("color","black");
                $("#div3").hide();$("#span3").css("color","black");
                $("#div4").hide();$("#span4").css("color","black");
            }else if(a==1){
                $("#div2").show();$("#span2").css("color","red");
                $("#div1").hide();$("#span1").css("color","black");
                $("#div3").hide();$("#span3").css("color","black");
                $("#div4").hide();$("#span4").css("color","black");
            }else if(a==2){
                $("#div4").show();$("#span4").css("color","red");
                $("#div1").hide();$("#span1").css("color","black");
                $("#div3").hide();$("#span3").css("color","black");
                $("#div2").hide();$("#span2").css("color","black");
            }else if(a==3){
                $("#div3").show();$("#span3").css("color","red");
                $("#div1").hide();$("#span1").css("color","black");
                $("#div2").hide();$("#span2").css("color","black");
                $("#div4").hide();$("#span4").css("color","black");
            }
         });

        function _f(id){
            $.ajax({
                url: '/wap/user/orderreceive',
                data: {
                    id:id,
                    _token: "{{csrf_token()}}"
                },
                type: 'post',
                dataType: 'json',
                async:false,
                success: function (data) {
                    console.log(data.status);
                    if(data.status === 1){
                      alert("确认收货成功！");
                        window.location.href=data.returnurl;
                    }else{
                        alert("确认收货失败，请联系客服！");
                     }
                }
            });
            // window.location.reload();
        }

        function show1(id){
            location.href="/wap/user/logistics?id="+id;
        }

        function show(id) {
            location.href="/wap/user/orderinfo?id="+id;
        }

         function move(id){
             if(id==1){
                 $("#div1").show();$("#span1").css("color","red");
                 $("#div2").hide();$("#span2").css("color","black");
                 $("#div3").hide();$("#span3").css("color","black");
                 $("#div4").hide();$("#span4").css("color","black");
             }else if(id==2){
                 $("#div2").show();$("#span2").css("color","red");
                 $("#div1").hide();$("#span1").css("color","black");
                 $("#div3").hide();$("#span3").css("color","black");
                 $("#div4").hide();$("#span4").css("color","black");
             }else if(id==3){
                 $("#div3").show();$("#span3").css("color","red");
                 $("#div1").hide();$("#span1").css("color","black");
                 $("#div2").hide();$("#span2").css("color","black");
                 $("#div4").hide();$("#span4").css("color","black");
             }else{
                 $("#div4").show();$("#span4").css("color","red");
                 $("#div1").hide();$("#span1").css("color","black");
                 $("#div2").hide();$("#span2").css("color","black");
                 $("#div3").hide();$("#span3").css("color","black");
             }
         }

    </script>
@endsection