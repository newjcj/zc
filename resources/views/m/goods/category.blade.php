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
            $(".loading").addClass("loader-chanage");
            $(".loading").fadeOut(300)
        })
    </script>

    <style>

    </style>

@endsection

@section('content')
    <header id="header" style="">
        <div class="topbar" style=" background-color: #f5655c;">
            <a href="javascript:history.back();" class="back_btn" ><i class="iconfont">ş</i></a>
            <h1 class="page_title">分类</h1>
        </div>
    </header>
    <!-- 会员俱乐部 -->
    <div style=" margin-top: 0px;  margin-left: -10px; position:absolute; z-index: -1;"><img src="/wap/images/search.png" width="438"></div>
    <div style=" float: left; margin-top: 10px; margin-left: 35px; position:absolute; z-index: 1;"><input type="text" id="good" name="good" placeholder="&nbsp;&nbsp;商品搜索" style=" width: 355px; height: 18px; border: 0px;" >&nbsp;&nbsp;&nbsp;<img src="/wap/images/shuqi.png" width="20" height="20" onclick="find();"></div>
    <div style=" float: left; margin-top: 45px; width: 140px; height: 490px; ">
        <ul style=" text-align: center;">
            @if(count($category))
                @foreach($category as $item)
                    <li id="col_{{$i}}" class="col" onclick="show({{$i}},{{$item->id}});" style=" background-color: #ededed; height: 35px; text-align: center;"><p align="center" style=" padding-top: 5px;"><font id="span_{{$i}}" class="span" color="#5d5d5d" >{{$item->name}}&nbsp;&nbsp;&nbsp;<img class="img" id="img_{{$i}}" width="20" height="20" src="{{$item->image}}"><img class="img2" id="img2_{{$i}}" width="20" style=" display: none;" height="20" src="{{$item->image2}}"></font></p></li>
                    <span style=" display: none;">{{$i++}}</span>
                @endforeach
            @endif
        </ul>
    </div>
    <div style=" float: left;  width: 260px; height: 200px; margin-top: -490px; margin-left: 150px; border: #0c0c0c 0px solid;" >
        @if(count($category))
            @foreach($category as $item)
                @if(count($re[$item->id]))
                    <div id="div_{{$item->id}}" class="good" style="border: #0c0c0c solid 0px; width: 100px; height: 200px; margin-top: 0px;">
                        @foreach($re[$item->id] as $cate)
                            <div style="width: 260px; height: 180px; margin-top: 0px; "><b>{{$cate->name}}</b><a style=" float: right; text-decoration: aqua;" href="/wap/goods/list?id={{$cate->id}}"><font color="#acacac" size="-2">查看更多<<&nbsp;&nbsp;</font></a><br><br>
                                @if(count($good[$cate->id]))
                                    <span style=" display: none;">{{$k=1}}</span>
                                    @foreach($good[$cate->id] as $go)
                                        <div style=" float: left" onclick="findgood({{$go->id}});">{{ '   ' }}
                                            <img src="{{ \App\Models\Goods::getGoodsimages($go)[0] }}" width="80" height="100"/>{{ '   ' }}<br>
                                            <span>{{mb_strlen($go->name,"UTF8")<=4 ? $go->name : substr($go->name,0,9).'..'}}</span>
                                        </div>
                                        @if($k==3)
                                            @break
                                        @endif
                                        <span style=" display: none;">{{$k++}}</span>
                                    @endforeach
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <br>
                @endif
            @endforeach
        @endif
    </div>

    <script src='/wap/js/jquery.js'></script>
    <script src="/wap/js/index.js"></script>
@endsection

@section('script')
    <script type="text/javascript">
        function find() {
            location.href="/wap/goods/alllist?name="+$("#good").val();
        }

        function findgood(id) {
            location.href='/wap/goods/detail?id='+id;
        }

        function show(i,id) {
            $(".img").show();
            $(".img2").hide();
            $(".col").css('backgroundColor','#ededed');
            $(".span").css('color','#5d5d5d');
            $("#col_"+i).css('backgroundColor','white');
            $("#span_"+i).css('color','#e32424');
            $(".good").hide();
            $("#div_"+id).show();
            $("#img_"+i).hide();
            $("#img2_"+i).show();
        }

        $(function(){
            $("#col_0").css('backgroundColor','white');
            $("#span_0").css('color','#e32424');
            $(".good").hide();
            $("#div_56").show();
            $("#img_0").hide();
            $("#img2_0").show();
        });

    </script>
@endsection