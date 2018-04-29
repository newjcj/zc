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
    <div style="background:url(../images/ccoinbg.png);width:100%;height:90px;background-size:100% 100%;">
        <img src="../images/ccoin.png" style="width:25%;position:absolute;left:16%;">
        <img src="../images/cget.png" style="width:25%;position:absolute;left:58%;">
        <div style="width:25%;position:absolute;left:16%;top:205px;color:red;font-size:0.8rem;text-align:center;">{{ $user->money }}</div>
        <div style="width:25%;position:absolute;left:58%;top:205px;color:red;font-size:0.8rem;text-align:center;">{{ $user->money }}</div>
    </div>
    <div style="width:100%;height:70px;margin-top:20px;">
        <img src="../images/cscore.png" style="width:20%;position:absolute;left:19%;">
        <img src="../images/cnum.png" style="width:20%;position:absolute;left:61%;">
        <div style="width:8%;position:absolute;left:7%;top:285px;"><img src="../images/cline.png" width="100%"></div>
        <div style="width:8%;position:absolute;left:46%;top:285px;"><img src="../images/cline.png" width="100%"></div>
        <div style="width:8%;position:absolute;left:87%;top:285px;"><img src="../images/cline.png" width="100%"></div>

        <div style="width:25%;position:absolute;left:16%;top:310px;color:#888;font-size:0.6rem;text-align:center;">{{ $user->shop_coin }}</div>
        <div style="width:25%;position:absolute;left:58%;top:310px;color:#888;font-size:0.6rem;text-align:center;">{{ $fannum }}</div>
    </div>
    <div style="background:#eee;height:7px;width:100%"></div>
    <div style="width:100%;height:80px;margin-top:15px;">
        <div style="float:left;width:33%;text-align:center"><a href="/wap/user/myad"><img src="../images/cfen.png" width="30%"><br>分享赚钱</a></div>
        <div style="float:left;width:33%;text-align:center"><img src="../images/cke.png" width="30%"><br>官方客服</div>
        <div style="float:left;width:33%;text-align:center"><img src="../images/cteam.png" width="30%"><br>我的粉丝</div>
    </div>
    <div style="background:#eee;height:7px;width:100%"></div>
    <div style="width:100%;height:105px;">
        <div style="width:100%;border-bottom:solid 1px #eee;height:30px;margin-bottom:10px;">
            <div style="float:left;line-height:30px;margin-left:5%;font-size:0.4rem;font-weight:700">我的订单</div>
            <div style="float:right;line-height:30px;margin-right:5%"><a href="/wap/user/orderlist?a=0">查看全部订单 <img src="../images/cright.png" height="10"></a></div>
        </div>
        <div style="float:left;width:25%;text-align:center"><a href="/wap/user/orderlist?a=1"><img src="../images/cfu.png" width="30%"><br>待付款({{$fknum}})</a></div>
        <div style="float:left;width:25%;text-align:center"><a href="/wap/user/orderlist?a=2"><img src="../images/cfa.png" width="30%"><br>待发货({{$dfhnum}})</a></div>
        <div style="float:left;width:25%;text-align:center"><a href="/wap/user/orderlist?a=3"><img src="../images/cshou.png" width="30%"><br>待收货({{$dshnum}})</a></div>
        <div style="float:left;width:25%;text-align:center"><a href="/wap/user/evaluate?a=1"><img src="../images/cping.png" width="30%"><br>待评价({{$eval}})</a></div>
    </div>
    <div style="background:#eee;height:7px;width:100%"></div>
    <div style="width:100%;height:210px;">
        <div style="width:100%;border-bottom:solid 1px #eee;height:30px;" onclick="location.href='/wap/user/myteam'">
            <div style="float:left;line-height:30px;margin-left:5%;"><a href="/wap/user/myteam">我的团队</a></div>
            <div style="float:right;line-height:30px;margin-right:5%"><img src="../images/cright.png" height="10"></div>
        </div>
        <div style="width:100%;border-bottom:solid 1px #eee;height:30px;" id="verfy" >
            {{--<div style="float:left;line-height:30px;margin-left:5%;"><a href="/wap/user/evaluate?a=2">我的评价</a></div>--}}
            @if($user->is_true==0)
                <div style="float:left;line-height:30px;margin-left:5%;"><a href="/wap/user/verify">申请实名认证</a></div>
                <div style="float:right;line-height:30px;margin-right:5%"><img src="../images/cright.png" height="10"></div>
            @elseif($user->is_true==3)
                <div style="float:left;line-height:30px;margin-left:5%;">实名审核中。。</div>
                {{--<div style="float:right;line-height:30px;margin-right:5%"><img src="../images/cright.png" height="10"></div>--}}
            @elseif($user->is_true==1)
                <div style="float:left;line-height:30px;margin-left:5%;">审核成功。</div>
                {{--<div style="float:right;line-height:30px;margin-right:5%"><img src="../images/cright.png" height="10"></div>--}}
            @elseif($user->is_true==2)
                <div style="float:left;line-height:30px;margin-left:5%;">实名已封禁</div>
                {{--<div style="float:right;line-height:30px;margin-right:5%"><img src="../images/cright.png" height="10"></div>--}}
                {{--<div style="float:right;line-height:30px;margin-right:5%"><img src="../images/cright.png" height="10"></div>--}}
            @endif

       </div>
       <div style="width:100%;border-bottom:solid 1px #eee;height:30px;" onclick="location.href='/wap/user/address'">
           <div style="float:left;line-height:30px;margin-left:5%;"><a href="/wap/user/address">收货地址</a></div>
           <div style="float:right;line-height:30px;margin-right:5%"><img src="../images/cright.png" height="10"></div>
       </div>
       <div style="width:100%;border-bottom:solid 1px #eee;height:30px;" id="ruzhu">
           @if($user->shop)
               @if($user->shop->certify==0)
                   <div style="float:left;line-height:30px;margin-left:5%;"><a href="/wap/user/shop">申请商家入驻</a></div>
                   <div style="float:right;line-height:30px;margin-right:5%"><img src="../images/cright.png" height="10"></div>
               @elseif($user->shop->certify==1)
                   <div style="float:left;line-height:30px;margin-left:5%;">入驻成功</div>
                   {{--<div style="float:right;line-height:30px;margin-right:5%"><img src="../images/cright.png" height="10"></div>--}}
                @elseif($user->shop->certify==3)
                    <div style="float:left;line-height:30px;margin-left:5%;">入驻失败</div>
                    {{--<div style="float:right;line-height:30px;margin-right:5%"><img src="../images/cright.png" height="10"></div>--}}
                @elseif($user->shop->certify==2)
                    <div style="float:left;line-height:30px;margin-left:5%;">入驻审批中</div>
                    {{--<div style="float:right;line-height:30px;margin-right:5%"><img src="../images/cright.png" height="10"></div>--}}
                @elseif($user->shop->certify==4)
                    <div style="float:left;line-height:30px;margin-left:5%;">不允许入驻</div>
                    {{--<div style="float:right;line-height:30px;margin-right:5%"><img src="../images/cright.png" height="10"></div>--}}
                @else
                @endif
            @else
                <div style="float:left;line-height:30px;margin-left:5%;"><a href="/wap/user/shop">商家入驻</a></div>
                <div style="float:right;line-height:30px;margin-right:5%"><img src="../images/cright.png" height="10"></div>
            @endif

        </div>
        <div style="width:100%;border-bottom:solid 1px #eee;height:30px;" onclick="location.href='/wap/user/deposit'" >
            <div style="float:left;line-height:30px;margin-left:5%;"> <a href="/wap/user/deposit">提现</a></div>
            <div style="float:right;line-height:30px;margin-right:5%"><img src="../images/cright.png" height="10"></div>
        </div>
        <div style="width:100%;border-bottom:solid 1px #eee;height:30px;" onclick="location.href='/wap/user/recommend'">
            <div style="float:left;line-height:30px;margin-left:5%;"> <a href="/wap/user/recommend">推荐会员</a></div>
            <div style="float:right;line-height:30px;margin-right:5%"><img src="../images/cright.png" height="10"></div>
        </div>
        <div style="width:100%;border-bottom:solid 1px #eee;height:30px;" onclick="location.href='/wap/user/recommendrex'">
            <div style="float:left;line-height:30px;margin-left:5%;"> <a href="/wap/user/recommendrex">推荐瑞达人</a></div>
            <div style="float:right;line-height:30px;margin-right:5%"><img src="../images/cright.png" height="10"></div>
        </div>
        <div style="width:100%;border-bottom:solid 1px #eee;height:30px; margin-bottom: 60px;" onclick="location.href='/wap/login/logout'">
            <div style="float:left;line-height:30px;margin-left:5%;"> <a href="/wap/login/logout">退出</a></div>
            <div style="float:right;line-height:30px;margin-right:5%"><img src="../images/cright.png" height="10"></div>
        </div>
    </div>










    {{--<!-- 会员俱乐部 -->--}}
    {{--<div class="vip-club border_top_bottom">--}}
        {{--<ul>--}}
            {{--<li><a href="/wap/user/orderlist?a=0"><i class="iconfont"></i><p>我的订单</p> </a></li>--}}
            {{--<li><a href="/wap/user/myad"><i class="iconfont"></i><p>我的推广注册</p> </a></li>--}}
            {{--<li><a href="/wap/user/deposit"><i class="iconfont" style="font-size: 28px;"></i><p>提现</p> </a></li>--}}
            {{--<li><a href="/wap/user/myteam"><i class="iconfont"></i><p>我的团队</p> </a></li>--}}
            {{--<li><a href="/wap/pay/order/pay"><i class="iconfont"></i><p>订单</p> </a></li>--}}
            {{--<li><a href="/wap/user/shop"><i class="iconfont"></i><p>商家入驻</p> </a></li>--}}
            {{--<li><a href="/wap/user/address"><i class="iconfont"></i><p>地址管理</p> </a></li>--}}
            {{--<li><a href="/wap/user/recommend"><i class="iconfont"></i><p>推荐会员</p> </a></li>--}}
            {{--<li><a href="/wap/user/recommendrex"><i class="iconfont"></i><p>推荐瑞达人</p> </a></li>--}}
            {{--<li><a href="https://itunes.apple.com/cn/app/id444934666" id='openqq'><i class="iconfont"></i><p>test</p> </a></li>--}}
            {{--<li><a href="mqq://" id='openqq'><i class="iconfont"></i><p>test1</p> </a></li>--}}
            {{--<script>--}}
                {{--$('#openqq').click(fucntion(){--}}

                {{--});--}}
            {{--</script>--}}
            {{--@if($user->shop)--}}
                {{--@if($user->shop->certify==0)--}}
                    {{--<li><a href="/wap/user/shop"><i class="iconfont"></i>--}}
                            {{--<p>申请商家入驻</p></a></li>--}}
                {{--@elseif($user->shop->certify==1)--}}
                    {{--<li><a href="#"><i class="iconfont"></i>--}}
                            {{--<p>入驻成功</p></a></li>--}}
                {{--@elseif($user->shop->certify==3)--}}
                    {{--<li><a href="#"><i class="iconfont"></i>--}}
                            {{--<p>入驻失败</p></a></li>--}}
                {{--@elseif($user->shop->certify==2)--}}
                    {{--<li><a href="#"><i class="iconfont"></i>--}}
                            {{--<p>入驻审批中</p></a></li>--}}
                {{--@elseif($user->shop->certify==4)--}}
                    {{--<li><a href="#"><i class="iconfont"></i>--}}
                            {{--<p>不允许入驻</p></a></li>--}}
                {{--@else--}}
                {{--@endif--}}
            {{--@else--}}
                {{--<li><a href="/wap/user/shop"><i class="iconfont"></i>--}}
                        {{--<p>商家入驻</p></a></li>--}}
            {{--@endif--}}
        {{--</ul>--}}
    {{--</div>--}}
    {{--<div class="vip-club border_top_bottom vip-account">--}}
        {{--<div class="vip-club-title border_bottom">--}}
        {{--<span><i class="iconfont"></i>我的账户</span>--}}
        {{--<a href="./index.html">积分兑换商品<i class="iconfont"></i></a>--}}
        {{--</div>--}}
        {{--<ul>--}}
            {{--<li><a href=""><i class="color_f44623">{{ $user->money }}</i>--}}
                    {{--<p>账户余额</p></a></li>--}}
            {{--<li><a href=""><i class="color_f4a425">{{ $user->shop_coin }}</i>--}}
                    {{--<p>我的积分</p></a></li>--}}
            {{--<li><a href=""><i class="color_45a1de">0</i><p>我的礼券</p> </a></li>--}}
            {{--<li><a href=""><p>退出</p> </a></li>--}}
        {{--</ul>--}}
    {{--</div>--}}
    {{--<div class="vip-list-icon border_top_bottom">--}}
        {{--<ul>--}}
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
            {{--<li>--}}
                {{--<a href="" class="border_right"><i class="iconfont"></i><em>我的咨询</em></a>--}}
                {{--<a href="/wap/login/logout"><i class="iconfont" style="font-size:23px;"></i><em>退出</em></a>--}}
            {{--</li>--}}
        {{--</ul>--}}
    {{--</div>--}}
    <input id="name" value="{{$realname}}" type="hidden">
    <input id="status" value="{{$status}}" type="hidden">
    <input id="istrue" value="{{$user->is_true}}" type="hidden">
    {{--<input id="inshop" value="{{$user->shop->certify}}" type="hidden">--}}
    <div id="zhaozhao"  style="position:absolute;top:0;left:0;width:100%;height:100%;background:#000;opacity:0.8;display:none">&nbsp;</div>
    <div id="div1" style=" background-color: #f2f2f2;   display: none;position:absolute;top:25%;width:80%;left:10%; border-radius: 6px;">
        <ul style=" padding-left: 25px; padding-top: 10px;">
            <li style="text-align:left;font-size:0.4rem;color:#f60; line-height: 40px; ">请输入邀请人手机号码：</li>
            <li style="height:40px;line-height: 40px;"><input style="float: left;" id="phone" type="text" name="phone"  ><input onclick="search();" style=" border: 0px; border-radius: 5px; float: right; margin-right: 20px; background-color: #f5655c; color: white;" type="button" value="确&nbsp;&nbsp;定"></li>
            <li style="text-align: right;font-size:0.4rem; color: red; padding-right: 10px; ">(系统检测到您没有邀请人！)</li>
        </ul>
    </div>

    <div id="div2" style=" background-color: #f2f2f2;   display: none;position:absolute;top:25%;width:80%;left:10%; border-radius: 6px;">
        <ul style=" padding-left: 55px; padding-top: 10px;">
            <li style="text-align:left;font-size:0.4rem;color:#f60; line-height: 40px; ">系统检测到您没有实名认证</li>
            <li style="height:40px;line-height: 40px;">
                <input onclick="location.href='/wap/user/verify'" style=" border: 0px; border-radius: 5px; float: right; margin-right: 90px; background-color: #f5655c; color: white;" type="button" value="去实名">
                <input onclick="ignore();" style=" border: 0px; border-radius: 5px; float: right; margin-right: 20px; background-color: #7e8691; color: white; opacity: 0.5" type="button" value="忽&nbsp;&nbsp;略">
            </li>
        </ul>
    </div>
@endsection

@section('script')
    <script>
      $(function () {

        if($("#name").val()==0){
            $("#realname").html("+&nbsp;&nbsp;邀请人");
        }else{
            $("#realname").html("邀请人："+$("#name").val());
        }

        if($("#status").val()==0){
            $("#zhaozhao").show();
            $("#div2").show();
        }


        if($("#istrue").val()==1){
           // alert('实名成功，可以去提现啦~');
            $("#verfy").hide();
        }

      if($("#inshop").val()==1){
         $("#ruzhu").hide();
      }

      });

      function ignore() {
          $.ajax({
              url: '/wap/user/ignoreverify',
              data: {
                  _token: "{{csrf_token()}}"
              },
              type: 'post',
              dataType: 'json',
              async: false,
              success: function (data) {
                  console.log(data.status);
                  if (data.status === 1) {
                      $("#zhaozhao").hide();
                      $("#div2").hide();
                  }else{
                      alert("忽略失败！");
                  }
              }
          });
      }

      $("#realname").click(function () {
          if($("#name").val()==0){
              $("#zhaozhao").show();
              $("#div1").show();
          }else{
            return;
          }
      });

      function search() {
          $.ajax({
              url: '/wap/user/checkinviter',
              data: {
                   phone: $("#phone").val(),
                  _token: "{{csrf_token()}}"
              },
              type: 'post',
              dataType: 'json',
              async: false,
              success: function (data) {
                  console.log(data.status);
                  if (data.status === 1) {
                     alert("保存成功！");
                     location.href="/wap/user/center"
                  } else if(data.status === 0) {
                     alert("没有该邀请人，请重新输入：");
                      $("#phone").val("");
                  }else{
                      alert("不允许变更邀请人！");
                      $("#phone").val("");
                  }
              }
          });
      }

      $("#zhaozhao").click(function(){
          $("#zhaozhao").hide();
          $("#div1").hide();
      });
    </script>
@endsection