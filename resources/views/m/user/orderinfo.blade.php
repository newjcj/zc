@extends('wap.master.index')
@section('title','订单详情')
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
            $(".loading").addClass("loader-chanage")
            $(".loading").fadeOut(300)
        })
    </script>
@endsection

@section('content')
    <header id="header" style="">
        <div class="topbar" style=" background-color: #f5655c;">
            <a href="javascript:history.back();" class="back_btn"><i class="iconfont">ş</i></a>
            <h1 class="page_title">订单详情</h1>
        </div>
    </header>
    <!-- 会员俱乐部 -->
    <div class="vip-club border_top_bottom vip-account">
        <div class="vip-club-title" onclick="check();">
            <span style="width:40px;display:inline-block;line-height:40px;"><img src="../images/dizhi.jpg" width="80%"></span>
            <input type="hidden" id="add_zt" value="{{$orders->status}}">
            <input type="hidden" id="orderid" value="{{$orders->id}}">
            @if(count($orders->useraddress))
            <span style="display:inline-block;text-align:left;line-height:22px;color:#888;font-size:16px;">{{$orders->useraddress->addressname}}  {{$orders->useraddress->phone}}<br>
                <span style="color:#ddd;font-size:12px;">{{$orders->useraddress->region_id }}&nbsp;&nbsp;{{$orders->useraddress->address }}</span>
            </span>
            @endif
            <div style="width:100%;background:url(../images/flow_check_03.png);background-size:20%;height:5px;clear:both;"></div>
        </div>

        <div class="vip-club border_top_bottom">
            <div class="vip-club-title border_bottom">
                <span>订单号:{{$orders->orderuuid}}</span>
                <a>
                    {{ $orders->status==0?'待付款':'' }}
                    {{ $orders->status==1?'待发货':'' }}
                    {{ $orders->status==2?'已签收':'' }}
                    {{ $orders->status==3?'确认收货':'' }}
                </a>
            </div>
            @if(count($orders->goodss))
                @foreach($orders->goodss as $good)
            <ul class="border_bottom" style="clear:both;">
                <li style="float:left;"><img src="{{ \App\Models\Goods::getGoodsimages($good)[0] }}" width="80"/></li>
                <li style="float:left;margin-left:20px;margin-right:20px;font-size:18px;">{{ $good->name }}<br><span style="color:red">￥{{ $good->price /100 }}</span></li>
                <li style="float:right;margin-top:40px;margin-right:20px;font-size:16px;">x{{ $good->pivot->num }}</li>
                <input type="hidden" name="shuqi" value="{{ $good->pivot->num * $good->price  }}">
            </ul>
                @endforeach
            @endif
            <ul class="border_bottom" style="clear:both;padding-top:10px;">
                <li style="float:left;margin-left:20px;margin-right:20px;font-size:18px;">订单总额</li>
                <li style="float:right;margin-right:20px;font-size:16px;color:red">￥<span id="sum"></span></li>
            </ul>
            <ul style="clear:both;">
                <li  style="line-height:45px;text-align:right;margin-right:20px;">
                    @if($orders->status==0)
                    <input type="button" class="sub" value="投诉" style="line-height:30px;border:solid 1px #ccc;background:#fff;color:#bbb;width:80px;">
                    <input type="button" class="sub" value="确认付款" style="line-height:30px;border:solid 1px #84c1ff;background:#1980e0;color:#fff;width:80px;">
                    @else
                        <input type="button" class="sub" value="投诉" style="line-height:30px;border:solid 1px #ccc;background:#fff;color:#bbb;width:80px;">
                        <input type="button" class="sub" value="确认收货" style="line-height:30px;border:solid 1px #84c1ff;background:#e82c23;color:#fff;width:80px;" onclick="_f({{$orders->id}});">
                    @endif
                </li>
            </ul>
        </div>

    </div>
@endsection

@section('script')
    <script>
        function check() {
            if($("#add_zt").val()==0){
                location.href="/wap/user/address?a=1&orderid="+$("#orderid").val();
            }else{
                return;
            }

        }

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
        }
        $(function () {

           var price = document.getElementsByName("shuqi");
           var money = 0;
           for(var i = 0;i<price.length;i++){
               money = money+"+"+price[i].value;
           }

           $("#sum").html(parseFloat(eval(money)/100));
        });


        $('form').submit(function () {
            return false;
        });
        //登录
        jcj_validate($('.loginform'),function(data){
            if(data.status === 1){
                //提示
                setTimeout(function(){
                    window.location.href=data.returnurl;
                },100)
            }else{
                layer.open({
                    content: data.message
                    ,skin: 'msg'
                    ,time: 2000 //2秒后自动关闭
                });
                setTimeout(function(){
                    window.location.reload();
                },1000)
            }
        });
    </script>
@endsection