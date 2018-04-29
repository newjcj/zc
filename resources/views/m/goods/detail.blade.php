@extends('wap.master.index')
@section('title','详情页')
@section('head')

@endsection
@section('content')
    <link rel="stylesheet" type="text/css" href="/wap/css/base.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/detail.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/mui.min.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/loaders.min.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/loading.css"/>
    <link rel="stylesheet" href="/wap/css/swiper.min.css">
    <script src="/wap/js/rem.js"></script>
    <script src="/wap/js/jquery.min.js" type="text/javascript"></script>
    <script src="/wap/js/others.js"></script>
    <script src="/wap/js/swiper.jquery.min.js"></script>
    <script type="text/javascript">
        $(window).load(function(){
            $(".loading").addClass("loader-chanage")
            $(".loading").fadeOut(300)
        })
        function toshare(){
            $(".am-share").addClass("am-modal-active");
            if($(".sharebg").length>0){
                $(".sharebg").addClass("sharebg-active");
            }else{
                $("body").append('<div class="sharebg"></div>');
                $(".sharebg").addClass("sharebg-active");
            }
            $(".sharebg-active,.share_btn").click(function(){
                $(".am-share").removeClass("am-modal-active");
                setTimeout(function(){
                    $(".sharebg-active").removeClass("sharebg-active");
                    $(".sharebg").remove();
                },300);
            })
        }
    </script>
</head>
<!--loading页开始-->
<div class="loading">
    <div class="loader">
        <div class="loader-inner pacman">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
</div>
<!--loading页结束-->
<body>
<!--header star-->
<header class="mui-bar mui-bar-nav" id="header" style=" background-color: #f5655c;">
    <a class="btn" href="javascript:history.go(-1)">
        <i class="iconfont icon-fanhui"></i>
    </a>
    <h4>商品详情</h4>
</header>
<!--header end-->

<div class="warp warptwo clearfloat">
    <div class="detail clearfloat">
        <!--banner star-->
        <div class="banner swiper-container">
            <div class="swiper-wrapper">

                @foreach(explode(',',($goods->goodsimage)[0]->image) as $image)
                    <div class="swiper-slide"><a href="javascript:void(0)"><img class="swiper-lazy" data-src="{{$image}}"></a></div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
        <!--banner end-->
        <div class="top clearfloat box-s">
            <div class="shang clearfloat">
                <div class="zuo clearfloat fl over2 box-s">
                    {{$goods->name}}
                </div>
                <div class="you clearfloat fr">
                    <i class="iconfont icon-fenxiang"></i>
                    <p>分享</p>
                </div>
            </div>
            <div class="xia clearfloat">
                <p class="jifen fl box-s">价格<samp>{{$goods->price/100}}(可赚{{ $goods->gain_price/100 }}元) </samp></p>
                <span class="fr">销量8件</span>
            </div>
        </div>
        <div class="middle clearfloat box-s">
            <a href="#">
                <span class="fl">商品详情</span>
                <i class="iconfont icon-jiantou2 fr"></i>
            </a>
        </div>
        <div class="clearfloat infobox">
            {!!$goods->content!!}
        </div>
        <div class="middle clearfloat box-s">
            <a href="#">
                <span class="fl">商品评价</span>
                <i class="iconfont icon-jiantou1 fr"></i>
            </a>
        </div>
    </div>
</div>

<!--footerone star-->
<div class="footerone clearfloat" style="bottom:0em;">
    <div class="left clearfloat fl">
        <ul>
            <li style="display: flex;justify-content: center; align-items: center;padding-top: 0;">
                <div>
                    <a href="#">
                        <i class="iconfont icon-shangcheng"></i>
                        <p>商城</p>
                    </a>
                </div>
            </li>
            <li style="display: flex;justify-content: center; align-items: center;padding-top: 0;">
                <div>
                    <a href="#">
                        <i class="iconfont icon-kefu1"></i>
                        <p>客服</p>
                    </a>
                </div>
            </li>
        </ul>
    </div>
    <div class="right clearfloat fl">
        <span class="btn fl" onClick="toshare()">加入购物车</span>
        <a href="/wap/order/confirm1?goodsid={{ $goods->id }}" class="btn btnone fl">立即购买</a>
    </div>
</div>
<!--footerone end-->

<!--弹出购物车内容-->
<div class="am-share">
    <div class="am-share-footer">
        <button class="share_btn"><img src="/wap/images/chahao.png" /></button>
    </div>
    <div class="am-share-sns box-s">
        <div class="sdetail clearfloat">
            <div class="top clearfloat">
                <div class="tu clearfloat fl">
                    <span></span>
                    <img src="{{\App\Models\Goods::getGoodsimages($goods)[0]}}" />
                </div>
                <div class="you clearfloat fl">
                    <p class="tit">{{$goods->name}}</p>
                    <span>100000积分</span>
                </div>
            </div>
            {{--<div class="middle clearfloat">--}}
                {{--<p>颜色分类</p>--}}
                {{--<div class="xia clearfloat">--}}
                    {{--<ul>--}}
                        {{--<li class="ra3 cur">蓝色</li>--}}
                        {{--<li class="ra3">白色</li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="middle clearfloat">--}}
                {{--<p>机身内存</p>--}}
                {{--<div class="xia clearfloat">--}}
                    {{--<ul>--}}
                        {{--<li class="ra3 cur">120G</li>--}}
                        {{--<li class="ra3">60G</li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</div>--}}
            <div class="bottom clearfloat">
                <p class="fl">购买数量</p>
                <div class="you clearfloat fr">
                    <ul>
                        <li id="down"><img src="/wap/images/jian.jpg" /></li>
                        <li id="count">{{$num?:1}}</li>
                        <li onclick="document.getElementById('count').innerHTML++"><img src="/wap/images/jia.jpg" /></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <a href="javascript:" class="shop-btn db">确定</a>
</div>
<script type="text/javascript">
    var down = document.getElementById("down");
    var count = document.getElementById("count");
    window.onload = function(){
        down.onclick = function(){
            if(count.innerHTML > 1){
                count.innerHTML--;
            }else{
                count.innerHTML = 1;
            }
        }
        $(".middle .xia li").click(function() {
            $(this).addClass('cur').siblings().removeClass('cur');
        });

    }
</script>

<script>
    $('.shop-btn').click(function(){
        $.ajax({
            url: '/view/home/addcart',
            data: {
                'goodsid':'{{$goods->id}}',
                'num':$('#count').text(),
                _token: "{{csrf_token()}}"
            },
            type: 'post',
            dataType: 'json',
            async:false,
            success: function (data) {
                if(data.status===1){
                    layer.open({
                        title: '提示',
                        shadeClose:true,//点击遮罩关闭
                        content: data.message,
                        yes:function(){
                            layer.closeAll();
                            $('img').click();
                            // window.location.href='/admin/goods/goods/index';
                        },
                        cancel: function(){
                            //右上角关闭回调
                            $('img').click();
                            // window.location.href='/admin/goods/goods/index';
                        }
                    });
                }
            }
        });
    });

</script>
@endsection

