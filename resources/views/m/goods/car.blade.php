@extends('wap.master.index')
@section('title','购物车')
@section('head')

@endsection
@section('content')
    <link rel="stylesheet" type="text/css" href="/wap/css/base.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/shopcar.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/mui.min.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/loaders.min.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/loading.css"/>
    {{--<link rel="stylesheet" type="text/css" href="/wap/sourse/layer/mobile/need/layer.css">--}}
    <script src="/wap/js/rem.js"></script>
    <script src="/wap/js/jquery.min.js" type="text/javascript"></script>
    {{--<script src="/wap/sourse/layer/mobile/layer.js"></script>--}}
    <script type="text/javascript">
        $(window).load(function () {
            $(".loading").addClass("loader-chanage")
            $(".loading").fadeOut(300)
        })
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
        <h4>购物车</h4>
    </header>
    <!--header end-->

    <div class="warp warptwo clearfloat">
        <div class="shopcar clearfloat">
            @if(count($carts))
                @foreach($carts as $cart)
                    <div class="list clearfloat fl" data-id="{{$cart['goods']->id}}">
                        <div class="xuan clearfloat fl">
                            <div class="radio" >
                                <label>
                                    <input type="checkbox" name="sex" value="" />
                                </label>
                            </div>
                        </div>
                        <a href="javascript:void(0)">
                            <div class="tu clearfloat fl">
                                <span></span>
                                <img src="{{ \App\Models\Goods::getGoodsimages($cart['goods'])[0] }}"/>
                            </div>
                            <div class="right clearfloat fl">
                                <p class="tit over">{{ $cart['goods']->name }}</p>
                                {{--<p class="fu-tit over">颜色：蓝色  内存：120G</p>--}}
                                <p class="jifen over">{{ $cart['goods']->price }} 元</p>
                                <div class="bottom clearfloat">
                                    <div class="zuo clearfloat fl">
                                        <ul>
                                            <li><img src="/wap/images/jian.jpg"/></li>
                                            <li class="count">{{ $cart['num'] }}</li>
                                            <li><img src="/wap/images/jia.jpg"/></li>
                                        </ul>
                                    </div>
                                    <i class="iconfont icon-lajixiang fr"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <!--settlement star-->
    <div class="settlement clearfloat" style="bottom:0em;">
        <div class="zuo clearfloat fl box-s">
            合计：<span></span>
        </div>
        <a href="javascript:_pay(this)" class="fl db">
            立即结算
        </a>
    </div>
    <!--settlement end-->

    @endsection
    @section('script')
        <script type="text/javascript">
            $('input[type="checkbox"]').click(function () { // 找到勾选按钮，绑定事件
                tatol();
            });
            $('.list ul img').click(function () { // 找到加减按钮，绑定点击事件
                var val = $(this).parent().parent().children().eq(1);
                if ($(this).parent().index()) {
                    val.html(parseInt(val.html()) + 1);
                } else {
                    val.html(val.html() > 1 ? parseInt(val.html()) - 1 : 1);
                }
                tatol();
            });
            $('.icon-lajixiang').click(function () { // 找到删除按钮，绑定点击事件
                var self = this;
                layer.open({
                    content: '确定删除？',
                    btn: ['确定', '取消'],
                    yes: function (index) {
                        $(self).parent().parent().parent().parent().remove();
                        layer.closeAll();
                        tatol();
                    }
                });
            });
            var tatol = function () { // 计算总积分
                var count = 0;
                $('.list').map(function (index, item) {
                    var $el = $(item);
                    if ($el.find('input[type="checkbox"]').is(":checked")) {
                        count += parseFloat($el.find('.jifen').html()) * parseInt($el.find('.zuo li').eq(1).html());
                    }
                });
                if (count > 0) {
                    $('.settlement span').html(count + '元');
                    return true;
                }else{
                    $('.settlement span').html(0 + '元');
                    return false;
                }
            }
        </script>
        <script>
            //付款
            function _pay(obj){
                //判断有没有选择商品
                if( !tatol() ){
                    layer.open({
                        title: '提示',
                        shadeClose:true,//点击遮罩关闭
                        content: '没有先择商品',
                        yes:function(){
                            layer.closeAll();
                        },
                        cancel: function(){
                        }
                    });
                }else{
                    var goodss = '';
                    $('.list').each(function(i,obj){
                        var id = $(obj).data('id');
                        var shulobj = $(obj).find('.count').text();
                        goodss+= id+':'+shulobj+',';
                    });
                    $.ajax({
                        url: '/view/home/addorders',
                        data: {
                            goodsids:goodss,
                            _token: "{{csrf_token()}}"
                        },
                        type: 'post',
                        dataType: 'json',
                        async:false,
                        success: function (data) {
                            if(data.status === 1){
                                layer.open({
                                    title: '提示',
                                    shadeClose:true,//点击遮罩关闭
                                    content: data.message,
                                    yes:function(){
                                        layer.closeAll();
                                         window.location.href='/wap/order/carttoorder';
                                    },
                                    cancel: function(){
                                        //右上角关闭回调
                                         window.location.href='/wap/order/carttoorder';
                                    }
                                });
                            }else if(data.status === 3){
                                //购物车数据更新到session  没有登录
                                layer.open({
                                    title: '提示',
                                    shadeClose:true,//点击遮罩关闭
                                    content: data.message,
                                    yes:function(){
                                        layer.closeAll();
                                        window.location.href='/wap/login/login';
                                    },
                                    cancel: function(){
                                        //右上角关闭回调
                                        window.location.href='/wap/login/login';
                                    }
                                });
                            }
                        }
                    });
                }
            }
        </script>

@endsection
