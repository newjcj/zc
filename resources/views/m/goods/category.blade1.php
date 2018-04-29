@extends('wap.master.weui')
@section('title','商品分类')
@section('head')
    {{--<link rel="stylesheet" type="text/css" href="/wap/css/center.css" />--}}
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
    <div class="container" id="container">
        <div class="page searchbar js_show">
            {{--product--}}
            <div class="weui-grids">
                @foreach($allgoods as $goods)
                    <a href="/wap/goods/detail?id={{$goods->id}}" class="weui-grid-jcj" style="border-left: 0px solid #C7C7C7;border-bottom: 0px solid #C7C7C7;">
                        <div class="weui-grid__icon-jcj">
                            <img src="{{ $goods->first_img }}" alt="">
                        </div>
                        <p class="weui-grid__label-jcj"><?php echo strlen($goods->name) > 15 ? substr($goods->name,0,15)."..." : $goods->name;?></p>
                        <span style="float:right;color:red;background:#a0a6ad;font-size:11px;margin-top:18px;padding-right:5px;">￥{{$goods->price}}</span>
                        <br>
                        {{--<p class="weui-grid__label-jcj" style="margin-top:2px;margin-right:150px;">Progress<span style="color:red">1%</span></p>--}}

                    </a>
                @endforeach
            </div>
            {{--Blank space--}}
            <div style="height:50px;"></div>
        </div>
    </div>
@endsection

@section('script')

@endsection