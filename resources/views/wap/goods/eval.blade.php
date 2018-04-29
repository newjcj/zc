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
			<h1 class="page_title">商品评价</h1>
		</div>
	</header>
	<!-- 会员俱乐部 -->
	<div class="vip-club border_top_bottom vip-account"><span style="display: none;">{{$i=0}}</span>
        @if(count($ordergoods))
            @foreach($ordergoods as $item)
			<div class="vip-club border_top_bottom" style=" height: 130px;"  >
              <div style=" width: 40px; height: 40px; border-radius: 20px; border: #0E1112 0px solid; position: absolute; margin-left: 10px; margin-top: 5px;">
                 <img src="{{$re[$item->id]['headimage']!='' ? $re[$item->id]['headimage']:'/wap/images/login1.png'}}" style="width: 40px; height: 40px; border-radius: 20px;">

			  </div>
              <div style=" float: left; width: 50px; height: 15px; border: #0E1112 0px solid; position: absolute; margin-left: 55px; margin-top: 5px;">
                  {{--{{$re[$item->id]['name']!='' ? substr($re[$item->id]['name'],0,2).'**':''}}--}}
                  <span style=" display: inline-block; width: 30px; line-height: 20px; height: 20px; overflow: hidden;">{{$re[$item->id]['name']}}</span>**
              </div>
              <div style=" float: left; width: 120px; height: 15px; border: #0E1112 0px solid; position: absolute; margin-left: 55px; margin-top: 28px;">
                  <input name='count' value="{{$item->evaluate_rank}}" type="hidden" ><span id="span_{{$i}}"></span>
                  {{--<img src="/wap/images/star.png" width="20"   id="star1" />--}}
                  {{--<img src="/wap/images/star1.png" width="20"  id="star2" style=" display: none;" name="rank"/>--}}
                  {{--<img src="/wap/images/star.png" width="20"   id="star3" />--}}
                  {{--<img src="/wap/images/star1.png" width="20"  id="star4" style=" display: none;" name="rank"/>--}}
                  {{--<img src="/wap/images/star.png" width="20"   id="star5" />--}}
                  {{--<img src="/wap/images/star1.png" width="20"  id="star6" style=" display: none;" name="rank"/>--}}
                  {{--<img src="/wap/images/star.png" width="20"   id="star7" />--}}
                  {{--<img src="/wap/images/star1.png" width="20"  id="star8" style=" display: none;" name="rank"/>--}}
                  {{--<img src="/wap/images/star.png" width="20"   id="star9" />--}}
                  {{--<img src="/wap/images/star1.png" width="20"  id="star10" style=" display: none;" name="rank"/>--}}
                  <span style=" display: none;">{{$i++}}</span>
              </div>
              <div  style=" float: left; width: 80px; height: 15px; border: #0E1112 0px solid; position: absolute; margin-left: 270px;  margin-top: 15px;">
                  {{substr($item->created_at,0,10)}}

              </div>
              <div style=" float: left; width: 270px; height: 60px; border: #0E1112 0px solid; position: absolute; margin-left: 55px;  margin-top: 55px;">
                <textarea style=" width: 270px; height: 60px; background: none; border: 0px; " readonly="readonly">{{$item->evaluate}}</textarea>
              </div>
            </div>
            @endforeach
        @endif
	</div>

@endsection

@section('script')
	<script>
     $(function () {
          var star = document.getElementsByName("count");
          for(var i = 0; i<star.length;i++){
             var str ='';
             for(var k = 0; k<star[i].value;k++){
                 str=str+"<img src='/wap/images/star1.png' width='15'/>";
             }
              for(var k = 0; k<5-star[i].value;k++){
                  str=str+"<img src='/wap/images/star.png' width='15'/>";
              }
              $("#span_"+i).html(str);
          }
     });


	</script>
@endsection