@extends('wap.master.index')
@section('title','瑞克斯商城首页')
@section('head')
    <link rel="stylesheet" type="text/css" href="/wap/css/base.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/index.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/mui.min.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/loaders.min.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/loading.css"/>
    <link rel="stylesheet" href="/wap/css/swiper.min.css">
    <script src="/wap/js/rem.js"></script>
    <script src="/wap/js/jquery.min.js" type="text/javascript"></script>
    <script src="/wap/js/others.js"></script>
    <script src="/wap/js/swiper.jquery.min.js"></script>
    <style>
        .goodslist{
            clear:both;width:100%;overflow-x:auto;height:200px;
            display:flex;
            flex-wrap:wrap;
            justify-content:center;
            overflow-y:hidden;
        }
        .goodbox{
            width:24%;height:180px;border-radius:5px;float:left;margin:10px;background-size:100% 100%;padding:10px;position:relative;box-shadow: 0 0 5px #888;
            /*margin-left:5px;*/
        }
    </style>
    <script type="text/javascript">
        $(window).load(function(){
            $(".loading").addClass("loader-chanage")
            $(".loading").fadeOut(300)
        })
    </script>
@endsection

@section('content')
    <div id="main" class="clearfloat ">
        <div class="mui-content">
            @if(count($allgoods))
                <div class="goodslist" style="">
                    @foreach($allgoods as $goods)
                        <div class="goodbox" style="background:url({{(\App\Models\Goods::getGoodsimages($goods))[0]}}) no-repeat;background-size:100% 100%;" onclick="location.href='/wap/goods/detail?id={{$goods->id}}';">
                            <div class="good_info_bg" style="position:absolute;margin-top:60%;background:#fff;filter:alpha(Opacity=70);-moz-opacity:0.7;opacity: 0.7;height:30%;width:75%">
                                &nbsp;
                            </div>
                            <div style="position:absolute;top:68%;font-size:0.1rem;text-align:center;">
                                ￥<b style="font-size:0.3rem;">{{$goods->price}}</b><br>店主赚<b style="font-size:0.3rem">{{ $goods->gain_price ?:0 }}</b>元
                            </div>

                        </div>
                    @endforeach
                </div>
            @endif

            <script>
                //动态计算高度，防止图片拉伸变形
                b=476/1244;//top原始图片的长宽比
                $(".index_box_top").height($(".index_box_top").width()*b);
                b=300/582;//box原始图片长宽比
                $(".index_box").height($(".index_box").width()*b);
                $(".index_box_body").height($(".index_box").height()*4+35);
                b=462/1245;//cat原始图片的长宽比
                $(".index_cat").height($(".index_cat").width()*b);
                $(".index_cat5").height($(".index_cat5").width()*0.1);
                $(".goodbox").height($(".goodbox").width()*1.1);
                $(".goodslist").height($(".goodbox").height()*1.3);
                $(".good_info_bg").width($(".goodbox").width());

            </script>
        </div>
    </div>
    <div class="blank" style="height:100px;">&nbsp;</div>
@endsection

@section('script')

@endsection