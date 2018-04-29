@extends('wap.master.index')
@section('title','订单列表')
@section('head')
    <link rel="stylesheet" type="text/css" href="/wap/css/base.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/address.css" />
    <link rel="stylesheet" type="text/css" href="/wap/css/loaders.min.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/loading.css"/>

    <script src="/wap/js/jquery.min.js" type="text/javascript"></script>
    <script src="/wap/sourse/layer/mobile/layer.js"></script>
    <script type="text/javascript">
        $(window).load(function(){
            $(".loading").addClass("loader-chanage")
            $(".loading").fadeOut(300);
        })
    </script>
@endsection

@section('content')
    <header class="mui-bar mui-bar-nav" id="header" style=" background-color: #f5655c;">
        <a class="btn" href="javascript:history.go(-1);">
            <i class="iconfont icon-fanhui" style="color: #fff"></i>
        </a>
        <p>管理收货地址</p>
    </header>
    <input id="orderid" value="{{$orderid}}" type="hidden">
    <input id="ordersid" value="{{$ordersid}}" type="hidden">
    <input id="order_id" value="{{$order_id}}" type="hidden">
    <div style=" float: left; margin-left: 300px; margin-top: -35px;"><span onclick="_add();"><font color="#f0ffff" size="+0.9">增加</font></span></div>
    <ul class="address-list">
        @if(count($useraddress)>0)
            @foreach($useraddress as $item)
            <li>
                <p>收货人：{{$item->addressname}}&nbsp;&nbsp;{{$item->phone}} </p>
                <p class="order-add1">收货地址：{{$item->region_id }}&nbsp;&nbsp;{{$item->address}}</p>
                <hr />
                <div class="address-cz">
                    <label class="am-radio am-warning">
                        <input type="radio" name="radio3" id="rad_{{$item->id}}" onclick="check1({{$item->id}});" value="" {{ $item->is_choice==1? "checked":''}} /><span  onclick="check({{$item->id}});"> <font class="span1" id="span_{{$item->id}}" color="{{ $item->is_choice==1? "red":''}}">设为默认</font></span>
                    </label>
                    <a class="editButton"  onclick="show({{$item->id}})"><img src="/wap/images/bj.png" width="18" />&nbsp;编辑</a>
                    <a class="deleteButton" onclick="_del({{$item->id}});">删除</a>
                </div>
            </li>
            @endforeach
        @endif
    </ul>
    @if($orderid>0)
        <div style=" float: left; margin-top: -30px; margin-left: 180px;"><input id="save" type="button" class="sub"  onclick="save();" value="保存并使用" style=" border-radius: 5px; border:solid 0px #84c1ff;background-color: #f5655c;color:#fff;width:80px; height: 35px;"></div>
    @endif

    @if($ordersid>0)
        <div style=" float: left; margin-top: -30px; margin-left: 180px;"><input id="save1" type="button" class="sub"  onclick="save1();" value="保存并使用" style=" border: solid 0px #84c1ff; border-radius: 5px; background-color: #f5655c;color:#fff;width:80px; height: 35px;"></div>
    @endif

    @if($order_id>0)
        <div style=" float: left; margin-top: -30px; margin-left: 180px;"><input id="save2" type="button" class="sub"  onclick="save2();" value="保存并使用" style=" border: solid 0px #84c1ff; border-radius: 5px; background-color: #f5655c;color:#fff;width:80px; height: 35px;"></div>
    @endif
    <div id="zhaozhao"  style="position:absolute;top:0;left:0;width:100%;height:100%;background:#000;opacity:0.5;display:none">&nbsp;</div>
    <div id="div1" style=" background-color: #f2f2f2;   display: none;position:absolute;top:25%;width:70%;left:15%; border-radius: 6px; height: 80px;">
        <ul style=" padding-left: 25px; padding-top: 10px;">
            <li style="text-align:center;font-size:17px;color:#f60; line-height: 40px; ">你确定要删除吗？</li><span id="id" style=" display: none;"></span>
            <li style="height:40px;line-height: 40px;"><input style="float: left; margin-left: 80px;   background-color: #f5655c; color: white; width: 50px; border: 0px; border-radius: 5px;" id="ignore" type="button" name="ignore" value="取&nbsp;&nbsp;消" /><input onclick="search();" style=" border: 0px; border-radius: 5px; float: right; margin-right: 30px; background-color: #f5655c; color: white; width: 50px;" type="button" value="确&nbsp;&nbsp;定"></li>
        </ul>
    </div>
@endsection

@section('script')
    <script type="text/javascript">

        function  save() {
            $.ajax({
                url: '/wap/user/saveaddress',
                data: {
                    orderid:$("#orderid").val(),
                    _token: "{{csrf_token()}}"
                },
                type: 'post',
                dataType: 'json',
                async:false,
                success: function (data) {
                    if(data.status === 1){
                        alert("保存成功！");
                        window.location.href=data.returnurl;
                    }else{
                        alert("保存失败，请联系管理员！");
                    }
                }
            });
        }

        function  save1() {
            $.ajax({
                url: '/wap/user/save1address',
                data: {
                    ordersid:$("#ordersid").val(),
                    _token: "{{csrf_token()}}"
                },
                type: 'post',
                dataType: 'json',
                async:false,
                success: function (data) {
                    if(data.status === 1){
                        //alert("保存成功！");
                        //window.location.href=data.returnurl;
                    }else{
                        //alert("保存失败，请联系管理员！");
                    }
                }
            });
            location.href="/wap/order/confirm?orders="+$("#ordersid").val()
        }

        function  save2() {
            $.ajax({
                url: '/wap/user/save2address',
                data: {
                    order_id:$("#order_id").val(),
                    _token: "{{csrf_token()}}"
                },
                type: 'post',
                dataType: 'json',
                async:false,
                success: function (data) {
                    if(data.status === 1){
                        //alert("保存成功！");
                        //window.location.href=data.returnurl;
                    }else{
                        //alert("保存失败，请联系管理员！");
                    }
                }
            });
            location.href="/wap/order/confirm?orders="+$("#order_id").val();
        }

        function  _add() {
           location.href="/wap/user/addaddress?orderid="+$("#orderid").val()+"&ordersid="+$("#ordersid").val()+"&order_id="+$("#order_id").val();
        }

        function _del(id) {
            $("#zhaozhao").show();
            $("#div1").show();
            $("#id").html(id);
        }

        function search() {
            $.ajax({
                url: '/wap/user/deladdress',
                data: {
                id:  $("#id").html(),
                orderid: $("#orderid").val(),
                ordersid: $("#ordersid").val(),
                order_id: $("#order_id").val(),
                _token: "{{csrf_token()}}"
            },
                type: 'post',
                dataType: 'json',
                async: false,
                success: function (data) {
                    console.log(data.status);
                    if (data.status === 1) {
                        window.location.href = data.returnurl;
                    }
                }
            });
        }

        $("#ignore").click(function () {
            $("#zhaozhao").hide();
            $("#div1").hide();
        });

        $("#zhaozhao").click(function(){
            $("#zhaozhao").hide();
            $("#div1").hide();
        });

        function check1(id){
            $("#rad_"+id).prop("checked","checked");
            $("#rad_"+id).val(1);
            $(".span1").css("color","#b4bac1");
            $("#span_"+id).css("color","red");
            $.ajax({
                url: '/wap/user/choice',
                data: {
                    choice:$("#rad_"+id).val(),
                    id:id,
                    _token: "{{csrf_token()}}"
                },
                type: 'post',
                dataType: 'json',
                async:false,
                success: function (data) {
                    console.log(data.status);
                    if(data.status === 1){
                        // window.location.href=data.returnurl;
                    }else{
                    }
                }
            });
        }

        function check(id){
          $("#rad_"+id).prop("checked","checked");
          $("#rad_"+id).val(1);
          $(".span1").css("color","#b4bac1");
          $("#span_"+id).css("color","red");
            $.ajax({
                url: '/wap/user/choice',
                data: {
                    choice:$("#rad_"+id).val(),
                    id:id,
                    _token: "{{csrf_token()}}"
                },
                type: 'post',
                dataType: 'json',
                async:false,
                success: function (data) {
                    console.log(data.status);
                    if(data.status === 1){
                       // window.location.href=data.returnurl;
                    }else{
                    }
                }
            });
        }

        function show(id) {
              //alert(id);
            location.href="/wap/user/editaddress?id="+id+"&orderid="+$("#orderid").val()+"&ordersid="+$("#ordersid").val()+"&order_id="+$("#order_id").val();
        }

        /**********************/
        window.onload = function() {
            $(".address-list > li > p").click(function(e) {
                $(this).parent().addClass("curr").siblings().removeClass("curr");

            });
        }
    </script>
@endsection
