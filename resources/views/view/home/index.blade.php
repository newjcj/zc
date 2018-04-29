@extends('view.master.index')
@section('title','首页')
@section('cartnum',11)
@section('asset')
    <link rel="shortcut icon" type="image/x-icon" href="/view/one/img/icon/favicon.ico">
    <link rel="stylesheet" type="text/css" href="/view/one/css/base.css">
    <link rel="stylesheet" type="text/css" href="/view/one/css/home.css">
    <script type="text/javascript" src="/view/one/js/jquery.js"></script>
    <script type="text/javascript" src="/view/one/js/index.js"></script>
    <script type="text/javascript">

        var intDiff = parseInt(90000);//倒计时总秒数量
        function timer(intDiff) {
            window.setInterval(function () {
                var day = 0,
                    hour = 0,
                    minute = 0,
                    second = 0;//时间默认值
                if (intDiff > 0) {
                    day = Math.floor(intDiff / (60 * 60 * 24));
                    hour = Math.floor(intDiff / (60 * 60)) - (day * 24);
                    minute = Math.floor(intDiff / 60) - (day * 24 * 60) - (hour * 60);
                    second = Math.floor(intDiff) - (day * 24 * 60 * 60) - (hour * 60 * 60) - (minute * 60);
                }
                if (minute <= 9) minute = '0' + minute;
                if (second <= 9) second = '0' + second;
                $('#day_show').html(day + "天");
                $('#hour_show').html('<s id="h"></s>' + hour + '时');
                $('#minute_show').html('<s></s>' + minute + '分');
                $('#second_show').html('<s></s>' + second + '秒');
                intDiff--;
            }, 1000);
        }

        $(function () {
            timer(intDiff);
        });//倒计时结束

        $(function () {
            /*======右按钮======*/
            $(".you").click(function () {
                nextscroll();
            });

            function nextscroll() {
                var vcon = $(".v_cont");
                var offset = ($(".v_cont li").width()) * -1;
                vcon.stop().animate({marginLeft: offset}, "slow", function () {
                    var firstItem = $(".v_cont ul li").first();
                    vcon.find(".flder").append(firstItem);
                    $(this).css("margin-left", "0px");
                });
            };
            /*========左按钮=========*/
            $(".zuo").click(function () {
                var vcon = $(".v_cont");
                var offset = ($(".v_cont li").width() * -1);
                var lastItem = $(".v_cont ul li").last();
                vcon.find(".flder").prepend(lastItem);
                vcon.css("margin-left", offset);
                vcon.animate({marginLeft: "0px"}, "slow")
            });
        });

    </script>
@endsection
@section('content')
    <!-- banner  -->
    <div class="yBanner">
        <div class="yBannerList">
            <div class="yBannerListIn">
                <a href=""><img class="ymainBanner" src="/view/one/images/banner1.jpg" width="100%"></a>
                <div class="yBannerListInRight">
                    <a href=""><img src="/view/one/images/BR2.png" width="100%"/></a>
                    <a href=""><img src="/view/one/images/BR3.png" width="100%"/></a>
                </div>
            </div>
        </div>

        <div class="yBannerList ybannerHide">
            <div class="yBannerListIn">
                <a href=""><img class="ymainBanner" src="/view/one/images/banner1.jpg" width="100%"></a>
                <div class="yBannerListInRight">
                    <a href=""><img src="/view/one/images/BR6.png" width="100%"/></a>
                    <a href=""><img src="/view/one/images/BR4.png" width="100%"/></a>
                </div>
            </div>
        </div>

        <div class="yBannerList ybannerHide">
            <div class="yBannerListIn">
                <a href=""><img class="ymainBanner" src="/view/one/images/banner1.jpg" width="100%"></a>
                <div class="yBannerListInRight">
                    <a href=""><img src="/view/one/images/BR7.png" width="100%"/></a>
                    <a href=""><img src="/view/one/images/BR5.png" width="100%"/></a>
                </div>
            </div>
        </div>
    </div>
    <!-- banner end -->
    <section id="">
        <div class="center pc-ad-img clearfix">
            <div class="pc-center-img"><img src="/view/one/img/ad/ad1.jpg"></div>
            <div class="pc-center-img"><img src="/view/one/img/ad/ad2.jpg"></div>
            <div class="pc-center-img"><img src="/view/one/img/ad/ad3.jpg"></div>
            <div class="pc-center-img"><img src="/view/one/img/ad/ad4.jpg"></div>
            <div class="pc-center-img"><img src="/view/one/img/ad/ad5.jpg"></div>
        </div>
    </section>
    <section id="s">
        <div class="center pc-top-20">
            <div class="pc-center-he">
                <div class="pc-box-he pc-box-blue clearfix">
                    <div class="fl"><i class="pc-time-icon"></i></div>
                    <div class="fr pc-box-blue-link">
                        <a href="#">aaaaaa</a>
                        <a href="#">短裙</a>
                        <a href="#">牛仔裤</a>
                        <a href="#">短袖</a>
                        <a href="#">帽子</a>
                    </div>
                </div>
                @if(count($goods))
                    @foreach($goods as $v)
                        <div class="pc-list-goods">
                            <div class="xsq_deal_wrapper pc-deal-list clearfix">
                                @foreach($v as $vv)
                                    <a class="saleDeal" href="/view/home/page?id={{$vv->id}}" target="_blank">
                                        <div class="dealCon"><img class="dealImg"
                                                                  src="{{(\App\Models\Goods::getGoodsimages($vv))[0]}}"
                                                                  alt=""></div>
                                        <div class="title_new"><p class="word" title="{{$vv->name}}"><span
                                                        class="baoyouText">[包邮]</span>{{$vv->name}}</p></div>
                                        <div class="dealInfo"><span class="price">¥<em>{{$vv->price/100}}</em></span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <div style="height:100px"></div>
@endsection
@section('script')
    <script type="text/javascript">
        //hover 触发两个事件，鼠标移上去和移走
        //mousehover 只触发移上去事件
        $(".top-nav ul li").hover(function () {
            $(this).addClass("hover").siblings().removeClass("hover");
            $(this).find("li .nav a").addClass("hover");
            $(this).find(".con").show();
        }, function () {
            //$(this).css("background-color","#f5f5f5");
            $(this).find(".con").hide();
            //$(this).find(".nav a").removeClass("hover");
            $(this).removeClass("hover");
            $(this).find(".nav a").removeClass("hover");
        })
    </script>
@endsection