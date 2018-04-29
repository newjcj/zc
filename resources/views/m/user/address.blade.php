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
        <a class="btn" href="javascript:history.go(-1)">
            <i class="iconfont icon-fanhui" style="color: #fff"></i>
        </a>
        <p>管理收货地址</p>
    </header>
    <input id="orderid" value="{{$orderid}}" type="hidden">
    <div style=" float: left; margin-left: 450px; margin-top: -35px;"><span onclick="_add();"><font color="#f0ffff" size="+0.9">增加</font></span></div>
    <ul class="address-list">
        @if(count($useraddress)>0)
            @foreach($useraddress as $item)
            <li>
                <p>收货人：{{$item->addressname}}&nbsp;&nbsp;{{$item->phone}}</p>
                <p class="order-add1">收货地址：{{$item->region_id }}&nbsp;&nbsp;{{$item->address}}</p>
                <hr />
                <div class="address-cz">
                    <label class="am-radio am-warning">
                        <input type="radio" name="radio3" id="rad_{{$item->id}}" value="" {{ $item->is_choice==1? "checked":''}}><span  onclick="check({{$item->id}});"> 设为默认</span>
                    </label>
                    <a class="editButton"  onclick="show({{$item->id}})"><img src="/wap/images/bj.png" width="18" />&nbsp;编辑</a>
                    <a href="" class="deleteButton" onclick="_del({{$item->id}});">删除</a>
                </div>
            </li>
            @endforeach
        @endif
    </ul>
    @if(count($orderid)>0)
      <div style=" float: left; margin-top: -30px; margin-left: 180px;"><input id="save" type="button" class="sub"  onclick="save();" value="保存并使用" style=" border:solid 1px #84c1ff;background:#1980e0;color:#fff;width:80px; height: 35px;"></div>
    @endif
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

        function  _add() {
           location.href="/wap/user/addaddress?orderid="+$("#orderid").val();
        }

        function _del(id) {
           // alert(id);
            $.ajax({
                url: '/wap/user/deladdress',
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
                        window.location.href=data.returnurl;
                    }else{
                    }
                }
            });
        }

        function check(id){
          $("#rad_"+id).prop("checked","checked");
          $("#rad_"+id).val(1);
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
            location.href="/wap/user/editaddress?id="+id+"&orderid="+$("#orderid").val();
        }

        /**********************/
        window.onload = function() {
            $(".address-list > li > p").click(function(e) {
                $(this).parent().addClass("curr").siblings().removeClass("curr");

            });
        }
    </script>
@endsection
