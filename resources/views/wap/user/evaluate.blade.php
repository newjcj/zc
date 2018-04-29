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
    <header id="header" style=" background-color: #f5655c;">
        <div class="topbar" style=" background-color: #f5655c;">
            <a href="javascript:history.back();" class="back_btn"><i class="iconfont">ş</i></a>
            <h1 class="page_title" style="text-align: center;">评价中心</h1>
        </div>
    </header>
    <!-- 会员俱乐部 -->
    <input type="hidden" id="a" value="{{$a}}">
    <div class="vip-club border_top_bottom vip-account">
        <div class="vip-club-title border_bottom">
            <span style="width:45%;display:inline-block;text-align:center;color:red;" id="span1" onclick="move(1);">待评价({{$dpjnum}})</span>

            <span style="width:45%;display:inline-block;text-align:center;" id="span2" onclick="move(2);" >已评价({{$ypjnum}})</span>
        </div>
        {{--待评价--}}
       <div id="div1">


                @if(count($orders)>0)
                    @foreach($orders as $item)
                        @if($item->status==4)
                            @if(count($item->goodss))
                                @foreach($item->goodss as $good)
                                    @if($good->pivot->evaluate_status==1)
                                       <div class="vip-club border_top_bottom" >
                                           <ul>
                                               <li style="float:left; margin-left: 20px; margin-top: 20px;"><img src="{{ \App\Models\Goods::getGoodsimages($good)[0] }}" width="120" onclick="location.href='/wap/goods/detail?id={{$good->id}}'"/></li>
                                               <li style=" float: left; margin-left: 50px; margin-top: 20px; "><font color="#a52a2a"><?php echo mb_substr($good->name,0,10,'utf-8')."..."?></font></li>
                                               <li  style="line-height:120px;text-align:right;margin-right:20px;">
                                                   <button class="sub"  onclick="_f({{$item->id}},{{$good->id}})" style="line-height:30px;border:solid 1px #f9682f;background:white;color:#f9682f;width:80px;"><font color="#f9682f"><b>评价晒单</b></font></button>
                                               </li>
                                           </ul>
                                       </div>
                                    @endif
                                @endforeach
                            @endif
                        @endif
                    @endforeach
                @endif



        </div>



        {{--已评价--}}
        <div id="div2" style=" display: none;">

                    @if(count($orders)>0)
                        @foreach($orders as $item)
                            @if($item->status==4)
                                @if(count($item->goodss))
                                    @foreach($item->goodss as $good)
                                        @if($good->pivot->evaluate_status==3)
                                            <div class="vip-club border_top_bottom" >
                                                <ul>
                                                    <li style="float:left; margin-left: 20px; margin-top: 20px;"><img src="{{ \App\Models\Goods::getGoodsimages($good)[0] }}" width="120" onclick="location.href='/wap/goods/detail?id={{$good->id}}'"/></li>
                                                    <li style=" float: left; margin-left: 50px; margin-top: 20px; "><font color="#a52a2a"><font color="#a52a2a"><?php echo mb_substr($good->name,0,10,'utf-8')."..."?></font></li>
                                                    <li style="line-height:120px;text-align:right;margin-right:20px;">
                                                        <button class="sub"  onclick="show({{$item->id}},{{$good->id}})"  style="line-height:30px;border:solid 1px #f9682f;background:white;color:#f9682f;width:80px;"><font color="#f9682f" ><b>查看评价</b></font></button>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            @endif
                        @endforeach
                    @endif

        </div>



    </div>
    <br><br><br><br><br><br>
@endsection

@section('script')
    <script>

        function show(orderid,goodid){
            //alert(orderid);alert(goodid);
            location.href="/wap/user/showeval?orderid="+orderid+"&goodid="+goodid;
        }

         $(function (){
             var a = $("#a").val();
            if(a==1){
                $("#div1").show();$("#span1").css("color","red");
                $("#div2").hide();$("#span2").css("color","black");
            }else if(a==2){
                $("#div2").show();$("#span2").css("color","red");
                $("#div1").hide();$("#span1").css("color","black");
            }
         });

        function _f(orderid,goodid){
            location.href="/wap/user/overeval?orderid="+orderid+"&goodid="+goodid;
            // window.location.reload();
        }


         function move(id){
             if(id==1){
                 $("#div1").show();$("#span1").css("color","red");
                 $("#div2").hide();$("#span2").css("color","black");
                 $("#div3").hide();$("#span3").css("color","black");
             }else if(id==2){
                 $("#div2").show();$("#span2").css("color","red");
                 $("#div1").hide();$("#span1").css("color","black");
                 $("#div3").hide();$("#span3").css("color","black");
             }else{
                 $("#div3").show();$("#span3").css("color","red");
                 $("#div1").hide();$("#span1").css("color","black");
                 $("#div2").hide();$("#span2").css("color","black");
             }
         }

    </script>
@endsection