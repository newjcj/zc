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
    <header id="header" style="" style=" background-color: #f5655c;">
        <input type="hidden" value="{{$orderid}}" id="order">
        <input type="hidden" value="{{$goodid}}" id="good">
        <div class="topbar">
            <a href="javascript:history.back();" class="back_btn"><i class="iconfont">ş</i></a>
            <div style=" float: right; padding-top:20px; padding-right: 20px; "><span id="span1"><font size="+1.2" color="white">提交</font></span></div>
            <h1 class="page_title">评价晒单 </h1>

        </div>
    </header>
    <!-- 会员俱乐部 -->

        {{--待评价--}}
       <div id="div1">

        <div class="vip-club border_top_bottom" style=" margin-top: 2px;" >
            <ul>
                <li style="float:left; margin-left: 20px; margin-top: 20px;"><img src="{{$img}}" width="120"/></li>
                <li style=" float: left; margin-left: 30px; margin-top: 20px; ">
                    <font color="#a52a2a">评分</font><br>
                    <img src="/wap/images/star.png" width="20"  onclick="move1()"  id="star1" />
                    <img src="/wap/images/star1.png" width="20" onclick="move2()"  id="star2" style=" display: none;" name="rank"/>
                    <img src="/wap/images/star.png" width="20"  onclick="move3()"  id="star3" />
                    <img src="/wap/images/star1.png" width="20" onclick="move4()"  id="star4" style=" display: none;" name="rank"/>
                    <img src="/wap/images/star.png" width="20"  onclick="move5()"  id="star5" />
                    <img src="/wap/images/star1.png" width="20" onclick="move6()"  id="star6" style=" display: none;" name="rank"/>
                    <img src="/wap/images/star.png" width="20"  onclick="move7()"  id="star7" />
                    <img src="/wap/images/star1.png" width="20" onclick="move8()"  id="star8" style=" display: none;" name="rank"/>
                    <img src="/wap/images/star.png" width="20"  onclick="move9()"  id="star9" />
                    <img src="/wap/images/star1.png" width="20" onclick="move10()" id="star10" style=" display: none;" name="rank"/>
                </li>
                <li  style=" float: left; padding-top: 10px;">&nbsp;&nbsp;
                    <textarea rows="10" cols="10" style=" width: 500px;" id="content" placeholder=" 请填写您的评价：">

                    </textarea>
                </li>

            </ul>
        </div>

        </div>






    <br><br><br><br><br><br>
@endsection

@section('script')
    <script>
        $("#span1").click(function () {
            var rank = document.getElementsByName("rank");
            var count = 0;
            for(var i = 0; i<rank.length;i++){
              if(rank[i].style.display ==""){
                count++;
              }
            }
            var content = $("#content").val();
            $.ajax({
                url: '/wap/user/putevaluate',
                data: {
                    orderid:$("#order").val(),
                    goodid:$("#good").val(),
                    count:count,
                    content:content,
                    _token: "{{csrf_token()}}"
                },
                type: 'post',
                dataType: 'json',
                async:false,
                success: function (data) {
                    console.log(data.status);
                    if(data.status === 1){
                        alert("评价成功！");
                        window.location.href=data.returnurl;
                    }else{
                        alert("评价失败，请联系客服！");
                    }
                }
            });
        });

         function move1() {
             $("#star1").hide();
             $("#star2").show();
         }
         function move2() {
             $("#star2").hide();
             $("#star1").show();
         }
         function move3() {
             $("#star3").hide();
             $("#star4").show();
         }
         function move4() {
             $("#star4").hide();
             $("#star3").show();
         }
         function move5() {
             $("#star5").hide();
             $("#star6").show();
         }
         function move6() {
             $("#star6").hide();
             $("#star5").show();
         }
         function move7() {
             $("#star7").hide();
             $("#star8").show();
         }
         function move8() {
             $("#star8").hide();
             $("#star7").show();
         }
         function move9() {
             $("#star9").hide();
             $("#star10").show();
         }
         function move10() {
             $("#star10").hide();
             $("#star9").show();
         }





    </script>
@endsection