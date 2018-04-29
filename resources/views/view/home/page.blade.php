@extends('view.master.index')
@section('title','商品列表')
@section('cartnum',2)
@section('asset')
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
    <script type="text/javascript">
        $(document).ready(function () {
            var $miaobian = $('.Xcontent08>div');
            var $huantu = $('.Xcontent06>img');
            var $miaobian1 = $('.Xcontent26>div');
            $miaobian.mousemove(function () {
                miaobian(this);
            });
            $miaobian1.click(function () {
                miaobian1(this);
            });

            function miaobian(thisMb) {
                for (var i = 0; i < $miaobian.length; i++) {
                    $miaobian[i].style.borderColor = '#dedede';
                }
                thisMb.style.borderColor = '#cd2426';

                $huantu[0].src = thisMb.children[0].src;
            }

            function miaobian1(thisMb1) {
                for (var i = 0; i < $miaobian1.length; i++) {
                    $miaobian1[i].style.borderColor = '#dedede';
                }
//		thisMb.style.borderColor = '#cd2426';
                $miaobian.css('border-color', '#dedede');
                thisMb1.style.borderColor = '#cd2426';
                $huantu[0].src = thisMb1.children[0].src;
            }

            $(".Xcontent33").click(function () {
                var value = parseInt($('.input').val()) + 1;
                $('.input').val(value);
            })

            $(".Xcontent32").click(function () {
                var num = $(".input").val()
                if (num > 0) {
                    $(".input").val(num - 1);
                }

            })

        })
    </script>
    <style>
        .li-ul-ss l {
            width: 200px;
        }
    </style>
@endsection
@section('content')
    <div class="Xcontent">
        <ul class="Xcontent01">
            <div class="Xcontent06"><img src="{{ explode(',',($goods->goodsimage)[0]->image)[0] }}"></div>
            <ol class="Xcontent08">
                @foreach(explode(',',($goods->goodsimage)[0]->image) as $image)
                <div class="Xcontent07"><img src="{{$image}}"></div>
                    @endforeach
            </ol>
            <ol class="Xcontent13 clearfix">
                <div class="Xcontent14 clearfix"><a href="#"><p>{{$goods->name}} </p></a></div>
                <div class="Xcontent15 clearfix red fl" style="margin-top:2px">新品上架</div>
                <div class="Xcontent16 clearfix"><p style="margin:0">美妆护肤放肆购，你值得拥有！更多惊喜</p></div>
                <div class="Xcontent17">
                    <p class="Xcontent18">售价</p>
                    <p class="Xcontent19">￥<span>{{$goods->price/100}}</span></p>
                    <div class="Xcontent20" style="display:none">
                        <p class="Xcontent21">促销</p>
                        <img src="/view/one/images/shangpinxiangqing/X12.png">
                        <p class="Xcontent22">领610元新年礼券，满再赠好礼</p>
                    </div>
                    <div class="Xcontent23" style="display:none">
                        <p class="Xcontent24">服务</p>
                        <p class="Xcontent25">30天无忧退货&nbsp;&nbsp;&nbsp;&nbsp;       48小时快速退款 &nbsp;&nbsp;&nbsp;&nbsp;        满88元免邮</p>
                    </div>

                </div>
                <div class="Xcontent26">
                    <p class="Xcontent27">颜色</p>
                    <div class="Xcontent28"><img  src="/view/one/images/shangpinxiangqing/X14.png"></div>
                    <div class="Xcontent29"><img  src="/view/one/images/shangpinxiangqing/X1.png"></div>
                </div>
                <div class="Xcontent30">
                    <p class="Xcontent31">数量</p>
                    <div class="Xcontent32"><img src="/view/one/images/shangpinxiangqing/X15.png"></div>
                    <form>
                        <input class="input" value="1"></form>
                    <div class="Xcontent33"><img src="/view/one/images/shangpinxiangqing/16.png"></div>

                </div>
                <div class="Xcontent34"><a href="#">立即购买</a></div>
                <div class="Xcontent35"><a href="javascript:min.addcart({{$goods->id}})">加入购物车</a></div>

            </ol>



        </ul>
    </div>
    <div class="center" style="background:#fff">
        <div class="tabox">
            <div class="hd">
                <ul class="li-ul-ss">
                    <li class=" " style="width:233px">疯狂抢购1</li>
                    <li class=" ">猜您喜欢</li>
                    <li class=" ">热卖商品</li>
                    <li class=" ">热评商品</li>
                    <li class="">新品上架</li></ul>
            </div>
            <div class="bd">
                <ul class="lh" style="display: none;">
                    <li>
                        <div class="p-img ld">
                            <a href="">
                                <img src="/view/one/images/shangpinxiangqing/X-1.png"></a>
                        </div>
                        <div class="p-name">
                            <a href="#">艾家纺全棉加厚磨毛四件套</a></div>
                        <div class="p-price">京东价：
                            <strong>￥399.00</strong></div>
                    </li>
                    <li>
                        <div class="p-img ld">
                            <a href="#">
                                <img src="/view/one/images/shangpinxiangqing/X-1.png"></a>
                        </div>
                        <div class="p-name">
                            <a href="#">优曼真丝提花奢华四件套</a></div>
                        <div class="p-price">京东价：
                            <strong>￥1299.00</strong></div>
                    </li>
                    <li>
                        <div class="p-img ld">
                            <a href="#">
                                <img src="/view/one/images/shangpinxiangqing/X1.png"></a>
                        </div>
                        <div class="p-name">
                            <a href="#">3999！大金1.5匹变频空调更安静！</a></div>
                        <div class="p-price">京东价：
                            <strong>￥3999.00</strong></div>
                    </li>
                    <li>
                        <div class="p-img ld">
                            <a href="#">
                                <img src="/view/one/images/shangpinxiangqing/X2.png"></a>
                        </div>
                        <div class="p-name">
                            <a href="#">爸爸爱喜禾（犬子在，不远游！感动无数读者的电子书</a></div>
                        <div class="p-price">京东价：
                            <strong>￥1.00</strong></div>
                    </li>
                    <li>
                        <div class="p-img ld">
                            <a href="#">
                                <img src="/view/one/images/shangpinxiangqing/X3.png"></a>
                        </div>
                        <div class="p-name">
                            <a href="#">【超值】飞利浦21.5英寸LED背光宽屏液晶显示</a></div>
                        <div class="p-price">京东价：
                            <strong>￥809.00</strong></div>
                    </li>
                    <li>
                        <div class="p-img ld">
                            <a href="#">
                                <img src="/view/one/images/shangpinxiangqing/X4.png"></a>
                        </div>
                        <div class="p-name">
                            <a href="#">爸爸爱喜禾（犬子在，不远游！感动无数读者的电子书</a></div>
                        <div class="p-price">京东价：
                            <strong>￥1.00</strong></div>
                    </li>
                    <li>
                        <div class="p-img ld">
                            <a href="#">
                                <img src="/view/one/images/shangpinxiangqing/X5.png"></a>
                        </div>
                        <div class="p-name">
                            <a href="#">【超值】飞利浦21.5英寸LED背光宽屏液晶显示</a></div>
                        <div class="p-price">京东价：
                            <strong>￥809.00</strong></div>
                    </li>
                </ul>
                <ul class="lh" style="display: none;">
                    <li>
                        <div class="p-img ld">
                            <a href="#">
                                <img src="/view/one/images/shangpinxiangqing/X-1.png"></a>
                        </div>
                        <div class="p-name">
                            <a href="#">安钛克（Antec）VP 550P 额定550W 120mm静音风扇 主动PFC 黑化外型设计电源</a></div>
                        <div class="p-price">京东价：
                            <strong>￥399.00</strong></div>
                    </li>
                    <li>
                        <div class="p-img ld">
                            <a href="#">
                                <img src="/view/one/images/2.2.jpg"></a>
                        </div>
                        <div class="p-name">
                            <a href="#">G.SKILL（芝奇）RipjawsX DDR3 1600 8G(4G×2条)台式机内存(F3-12800CL9D-8GBXL )</a></div>
                        <div class="p-price">京东价：
                            <strong>￥235.00</strong></div>
                    </li>
                    <li>
                        <div class="p-img ld">
                            <a href="#">
                                <img src="/view/one/images/2.3.jpg"></a>
                        </div>
                        <div class="p-name">
                            <a href="#">希捷（Seagate）1TB ST1000DM003 7200转64M SATA 6Gb/秒 台式机硬盘 建达蓝德 盒装正品</a></div>
                        <div class="p-price">京东价：
                            <strong>￥438.00</strong></div>
                    </li>
                    <li>
                        <div class="p-img ld">
                            <a href="#">
                                <img src="/view/one/images/2.4.jpg"></a>
                        </div>
                        <div class="p-name">
                            <a href="#">华硕(ASUS)P8Z77-V LK主板(Intel Z77/LGA 1155)</a></div>
                        <div class="p-price">京东价：
                            <strong>￥899.00</strong></div>
                    </li>
                    <li>
                        <div class="p-img ld">
                            <a href="#">
                                <img src="/view/one/images/2.5.jpg"></a>
                        </div>
                        <div class="p-name">
                            <a href="#">大水牛（BUBALUS）电脑机箱 经典-A1008 灰黑色（不含电源）</a></div>
                        <div class="p-price">京东价：
                            <strong>￥112.00</strong></div>
                    </li>
                </ul>
                <ul class="lh" style="display: none;">
                    <li>
                        <div class="p-img ld">
                            <a href="#">
                                <img src="/view/one/images/3.1.jpg"></a>
                        </div>
                        <div class="p-name">
                            <a href="#">冬季健身TOP1！瑞亚特仰卧板加送俯卧撑架</a></div>
                        <div class="p-price">京东价：
                            <strong>￥187.00</strong></div>
                    </li>
                    <li>
                        <div class="p-img ld">
                            <a href="#">
                                <img src="/view/one/images/3.2.jpg"></a>
                        </div>
                        <div class="p-name">
                            <a href="#">HTC Z715e!双核！魔音耳机！</a></div>
                        <div class="p-price">京东价：
                            <strong>￥2399.00</strong></div>
                    </li>
                    <li>
                        <div class="p-img ld">
                            <a href="#">
                                <img src="/view/one/images/3.3.jpg"></a>
                        </div>
                        <div class="p-name">
                            <a href="#">下单返现150元！格力9片电油汀</a></div>
                        <div class="p-price">京东价：
                            <strong>￥449.00</strong></div>
                    </li>
                    <li>
                        <div class="p-img ld">
                            <a href="#">
                                <img src="/view/one/images/3.4.jpg"></a>
                        </div>
                        <div class="p-name">
                            <a href="#">绿之源净味宝2居室除味超值套装 4000克</a></div>
                        <div class="p-price">京东价：
                            <strong>￥449.00</strong></div>
                    </li>
                    <li>
                        <div class="p-img ld">
                            <a href="#">
                                <img src="/view/one/images/3.5.jpg"></a>
                        </div>
                        <div class="p-name">
                            <a href="#">宏碁i5 4G GT630M 1G独显 月销量破</a></div>
                        <div class="p-price">京东价：
                            <strong>￥3599.00</strong></div>
                    </li>
                </ul>
                <ul class="lh" style="display: none;">
                    <li>
                        <div class="p-img ld">
                            <a href="#">
                                <img src="/view/one/images/2.3.jpg"></a>
                        </div>
                        <div class="p-name">
                            <a href="#">希捷（Seagate）1TB ST1000DM003 7200转64M SATA 6Gb/秒 台式机硬盘 建达蓝德 盒装正品</a></div>
                        <div class="p-price">京东价：
                            <strong>￥438.00</strong></div>
                    </li>
                    <li>
                        <div class="p-img ld">
                            <a href="#">
                                <img src="/view/one/images/2.3.jpg"></a>
                        </div>
                        <div class="p-name">
                            <a href="#">希捷（Seagate）1TB ST1000DM003 7200转64M SATA 6Gb/秒 台式机硬盘 建达蓝德 盒装正品</a></div>
                        <div class="p-price">京东价：
                            <strong>￥438.00</strong></div>
                    </li>
                    <li>
                        <div class="p-img ld">
                            <a href="#">
                                <img src="/view/one/images/2.3.jpg"></a>
                        </div>
                        <div class="p-name">
                            <a href="#">希捷（Seagate）1TB ST1000DM003 7200转64M SATA 6Gb/秒 台式机硬盘 建达蓝德 盒装正品</a></div>
                        <div class="p-price">京东价：
                            <strong>￥438.00</strong></div>
                    </li>
                    <li>
                        <div class="p-img ld">
                            <a href="#">
                                <img src="/view/one/images/2.3.jpg"></a>
                        </div>
                        <div class="p-name">
                            <a href="#">希捷（Seagate）1TB ST1000DM003 7200转64M SATA 6Gb/秒 台式机硬盘 建达蓝德 盒装正品</a></div>
                        <div class="p-price">京东价：
                            <strong>￥438.00</strong></div>
                    </li>
                    <li>
                        <div class="p-img ld">
                            <a href="#">
                                <img src="/view/one/images/2.3.jpg"></a>
                        </div>
                        <div class="p-name">
                            <a href="#">希捷（Seagate）1TB ST1000DM003 7200转64M SATA 6Gb/秒 台式机硬盘 建达蓝德 盒装正品</a></div>
                        <div class="p-price">京东价：
                            <strong>￥438.00</strong></div>
                    </li>
                </ul>
                <ul class="lh" style="display: block;">
                    <li>
                        <div class="p-img ld">
                            <a href="#">
                                <img src="/view/one/images/2.5.jpg"></a>
                        </div>
                        <div class="p-name">
                            <a href="#">大水牛（BUBALUS）电脑机箱 经典-A1008 灰黑色（不含电源）</a></div>
                        <div class="p-price">京东价：
                            <strong>￥112.00</strong></div>
                    </li>
                    <li>
                        <div class="p-img ld">
                            <a href="#">
                                <img src="/view/one/images/2.5.jpg"></a>
                        </div>
                        <div class="p-name">
                            <a href="#">大水牛（BUBALUS）电脑机箱 经典-A1008 灰黑色（不含电源）</a></div>
                        <div class="p-price">京东价：
                            <strong>￥112.00</strong></div>
                    </li>
                    <li>
                        <div class="p-img ld">
                            <a href="#">
                                <img src="/view/one/images/2.5.jpg"></a>
                        </div>
                        <div class="p-name">
                            <a href="#">大水牛（BUBALUS）电脑机箱 经典-A1008 灰黑色（不含电源）</a></div>
                        <div class="p-price">京东价：
                            <strong>￥112.00</strong></div>
                    </li>
                    <li>
                        <div class="p-img ld">
                            <a href="#">
                                <img src="/view/one/images/2.5.jpg"></a>
                        </div>
                        <div class="p-name">
                            <a href="#">大水牛（BUBALUS）电脑机箱 经典-A1008 灰黑色（不含电源）</a></div>
                        <div class="p-price">京东价：
                            <strong>￥112.00</strong></div>
                    </li>
                    <li>
                        <div class="p-img ld">
                            <a href="#">
                                <img src="/view/one/images/2.5.jpg"></a>
                        </div>
                        <div class="p-name">
                            <a href="#">大水牛（BUBALUS）电脑机箱 经典-A1008 灰黑色（不含电源）</a></div>
                        <div class="p-price">京东价：
                            <strong>￥112.00</strong></div>
                    </li>
                </ul>
            </div>
        </div>
        <script type="text/javascript">
            jQuery(".tabox").slide({delayTime: 0});
        </script>

    </div>
    <div class="containers center clearfix" style="margin-top:20px; background:#fff;">
        <div class="fl" style="padding-left:10px; padding-top:20px">
            <div class="pc-menu-in">
                <h2>店内搜索</h2>
                <form>
                    <p>关键词:<input type="text" class="pc-input1"></p>
                    <p>价  格：<input class="pc-input2"> 到 <input class="pc-input2"></p>
                    <p><a href="#">搜索</a> </p>
                </form>
            </div>
            <div class="menu_list" id="firstpane">
                <h2>店内分类</h2>
                <h3 class="menu_head current">电玩</h3>
                <div class="menu_body" style="">
                    <a href="#">耳机耳麦</a>
                    <a href="#">游戏机</a>
                </div>
                <h3 class="menu_head">手机</h3>
                <div class="menu_body" style="display: none;">
                    <a href="#">手机</a>
                    <a href="#">手机</a>
                    <a href="#">手机</a>
                </div>

                <h3 class="menu_head">耳机耳麦</h3>
                <div class="menu_body" style="display: none;">
                    <a href="#">耳机耳麦</a>
                    <a href="#">耳机耳麦</a>
                    <a href="#">耳机耳麦</a>
                    <a href="#">耳机耳麦</a>
                </div>
            </div>
        </div syu>
        <div class="pc-info fr" style="padding-left:10px; padding-top:20px">
            <div class="pc-overall">
                <ul id="H-table1" class="brand-tab H-table1 H-table-shop clearfix ">
                    <li class="cur"><a href="javascript:void(0);">商品介绍</a></li>
                    {{--<li><a href="javascript:void(0);">商品评价<em class="reds">(91)</em></a></li>--}}
                    {{--<li><a href="javascript:void(0);">售后保障</a></li>--}}
                </ul>
                <div class="pc-term clearfix">
                    <div class="H-over1 pc-text-word clearfix">
                        {{--<ul class="clearfix">--}}
                            {{--<li>--}}
                                {{--<p>屏幕尺寸：4.8英寸</p>--}}
                                {{--<p>分辨率：1280×720(HD,720P) </p>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<p>后置摄像头：800万像素</p>--}}
                                {{--<p>分辨率：1280×720(HD,720P) </p>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<p>前置摄像头：190万像素</p>--}}
                                {{--<p>分辨率：1280×720(HD,720P) </p>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<p>3G：电信(CDMA2000)</p>--}}
                                {{--<p>2G：移动/联通(GSM)/电信(CDMA </p>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                        {{--<div class="pc-line"></div>--}}
                        {{--<ul class="clearfix">--}}
                            {{--<li>--}}
                                {{--<p>商品名称：三星I939I</p>--}}
                                {{--<p>商品毛重：360.00g </p>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<p>商品编号：1089266</p>--}}
                                {{--<p>商品产地：中国大陆</p>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<p>品牌： 三星（SAMSUNG）</p>--}}
                                {{--<p>系统：安卓（Android </p>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<p>上架时间：2015-03-30 09:07:18</p>--}}
                                {{--<p>机身颜色：白色</p>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                        <div style="overflow: hidden;">
                            {!!$goods->content!!}
                        </div>
                    </div>
                    <div class="H-over1" style="display:none">
                        <div class="pc-comment fl"><strong>86<span>%</span></strong><br> <span>好评度</span></div>
                        <div class="pc-percent fl">
                            <dl>
                                <dt>好评<span>(86%)</span></dt>
                                <dd><div style="width:86px"></div></dd>
                            </dl>
                            <dl>
                                <dt>中评<span>(86%)</span></dt>
                                <dd><div style="width:86px"></div></dd>
                            </dl>
                            <dl>
                                <dt>好评<span>(86%)</span></dt>
                                <dd><div style="width:86px"></div></dd>
                            </dl>
                        </div>
                    </div>
                    <div class="H-over1 pc-text-title" style="display:none">
                        <p>本产品全国联保，享受三包服务，质保期为：一年质保
                            如因质量问题或故障，凭厂商维修中心或特约维修点的质量检测证明，享受7日内退货，15日内换货，15日以上在质保期内享受免费保修等三包服务！
                            (注:如厂家在商品介绍中有售后保障的说明,则此商品按照厂家说明执行售后保障服务。) 您可以查询本品牌在各地售后服务中心的联系方式，请点击这儿查询......</p>
                        <div class="pc-line"></div>
                    </div>
                </div>
            </div>
            <div class="pc-overall">
                {{--<ul class="brand-tab H-table H-table-shop clearfix " id="H-table" style="margin-left:0;">--}}
                    {{--<li class="cur"><a href="javascript:void(0);">全部评价（199）</a></li>--}}
                    {{--<li><a href="javascript:void(0);">好评<em class="reds">（33）</em></a></li>--}}
                    {{--<li><a href="javascript:void(0);">中评<em class="reds">（02）</em></a></li>--}}
                    {{--<li><a href="javascript:void(0);">差评<em class="reds">（01）</em></a></li>--}}
                {{--</ul>--}}
                {{--<div class="pc-term clearfix">--}}
                    {{--<div class="pc-column">--}}
                        {{--<span class="column1">评价心得</span>--}}
                        {{--<span class="column2">顾客满意度</span>--}}
                        {{--<span class="column3">购买信息</span>--}}
                        {{--<span class="column4">评论者</span>--}}
                    {{--</div>--}}
                    {{--<div class="H-over  pc-comments clearfix">--}}
                        {{--<ul class="clearfix">--}}
                            {{--<li class="clearfix">--}}
                                {{--<div class="column1">--}}
                                    {{--<p class="clearfix"><a href="#">回复<em>（90）</em></a> <a href="#">赞<em>（90）</em></a> </p>--}}
                                    {{--<p>一次用三星，不是很顺手，但咨询客服后终于上手了，感觉性价比相当不错，值得购买。但最想说的是京东客服更好，产品信得过，正品行货，买的放心。</p>--}}
                                    {{--<p class="column5">2014-11-25 14:32</p>--}}
                                {{--</div>--}}
                                {{--<div class="column2"><img src="/view/one/img/icon/star.png"></div>--}}
                                {{--<div class="column3">颜色：云石白</div>--}}
                                {{--<div class="column4">--}}
                                    {{--<p><img src="/view/one/img/icon/user.png"></p>--}}
                                    {{--<p>2014-11-23 22:37 购买</p>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                            {{--<li class="clearfix">--}}
                                {{--<div class="column1">--}}
                                    {{--<p class="clearfix"><a href="#">回复<em>（90）</em></a> <a href="#">赞<em>（90）</em></a> </p>--}}
                                    {{--<p>一次用三星，不是很顺手，但咨询客服后终于上手了，感觉性价比相当不错，值得购买。但最想说的是京东客服更好，产品信得过，正品行货，买的放心。</p>--}}
                                    {{--<p class="column5">2014-11-25 14:32</p>--}}
                                {{--</div>--}}
                                {{--<div class="column2"><img src="/view/one/img/icon/star.png"></div>--}}
                                {{--<div class="column3">颜色：云石白</div>--}}
                                {{--<div class="column4">--}}
                                    {{--<p><img src="/view/one/img/icon/user.png"></p>--}}
                                    {{--<p>2014-11-23 22:37 购买</p>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                            {{--<li class="clearfix">--}}
                                {{--<div class="column1">--}}
                                    {{--<p class="clearfix"><a href="#">回复<em>（90）</em></a> <a href="#">赞<em>（90）</em></a> </p>--}}
                                    {{--<p>一次用三星，不是很顺手，但咨询客服后终于上手了，感觉性价比相当不错，值得购买。但最想说的是京东客服更好，产品信得过，正品行货，买的放心。</p>--}}
                                    {{--<p class="column5">2014-11-25 14:32</p>--}}
                                {{--</div>--}}
                                {{--<div class="column2"><img src="/view/one/img/icon/star.png"></div>--}}
                                {{--<div class="column3">颜色：云石白</div>--}}
                                {{--<div class="column4">--}}
                                    {{--<p><img src="/view/one/img/icon/user.png"></p>--}}
                                    {{--<p>2014-11-23 22:37 购买</p>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                            {{--<li class="clearfix">--}}
                                {{--<div class="column1">--}}
                                    {{--<p class="clearfix"><a href="#">回复<em>（90）</em></a> <a href="#">赞<em>（90）</em></a> </p>--}}
                                    {{--<p>一次用三星，不是很顺手，但咨询客服后终于上手了，感觉性价比相当不错，值得购买。但最想说的是京东客服更好，产品信得过，正品行货，买的放心。</p>--}}
                                    {{--<p class="column5">2014-11-25 14:32</p>--}}
                                {{--</div>--}}
                                {{--<div class="column2"><img src="/view/one/img/icon/star.png"></div>--}}
                                {{--<div class="column3">颜色：云石白</div>--}}
                                {{--<div class="column4">--}}
                                    {{--<p><img src="/view/one/img/icon/user.png"></p>--}}
                                    {{--<p>2014-11-23 22:37 购买</p>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                            {{--<li class="clearfix">--}}
                                {{--<div class="column1">--}}
                                    {{--<p class="clearfix"><a href="#">回复<em>（90）</em></a> <a href="#">赞<em>（90）</em></a> </p>--}}
                                    {{--<p>一次用三星，不是很顺手，但咨询客服后终于上手了，感觉性价比相当不错，值得购买。但最想说的是京东客服更好，产品信得过，正品行货，买的放心。</p>--}}
                                    {{--<p class="column5">2014-11-25 14:32</p>--}}
                                {{--</div>--}}
                                {{--<div class="column2"><img src="/view/one/img/icon/star.png"></div>--}}
                                {{--<div class="column3">颜色：云石白</div>--}}
                                {{--<div class="column4">--}}
                                    {{--<p><img src="/view/one/img/icon/user.png"></p>--}}
                                    {{--<p>2014-11-23 22:37 购买</p>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                            {{--<li class="clearfix">--}}
                                {{--<div class="column1">--}}
                                    {{--<p class="clearfix"><a href="#">回复<em>（90）</em></a> <a href="#">赞<em>（90）</em></a> </p>--}}
                                    {{--<p>一次用三星，不是很顺手，但咨询客服后终于上手了，感觉性价比相当不错，值得购买。但最想说的是京东客服更好，产品信得过，正品行货，买的放心。</p>--}}
                                    {{--<p class="column5">2014-11-25 14:32</p>--}}
                                {{--</div>--}}
                                {{--<div class="column2"><img src="/view/one/img/icon/star.png"></div>--}}
                                {{--<div class="column3">颜色：云石白</div>--}}
                                {{--<div class="column4">--}}
                                    {{--<p><img src="/view/one/img/icon/user.png"></p>--}}
                                    {{--<p>2014-11-23 22:37 购买</p>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                    {{--<div style="display:none" class="H-over pc-comments">--}}
                        {{--<ul class="clearfix">--}}
                            {{--<li class="clearfix">--}}
                                {{--<div class="column1">--}}
                                    {{--<p class="clearfix"><a href="#">回复<em>（90）</em></a> <a href="#">赞<em>（90）</em></a> </p>--}}
                                    {{--<p>一次用三星，不是很顺手，但咨询客服后终于上手了，感觉性价比相当不错，值得购买。但最想说的是京东客服更好，产品信得过，正品行货，买的放心。</p>--}}
                                    {{--<p class="column5">2014-11-25 14:32</p>--}}
                                {{--</div>--}}
                                {{--<div class="column2"><img src="/view/one/img/icon/star.png"></div>--}}
                                {{--<div class="column3">颜色：云石白</div>--}}
                                {{--<div class="column4">--}}
                                    {{--<p><img src="/view/one/img/icon/user.png"></p>--}}
                                    {{--<p>2014-11-23 22:37 购买</p>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                            {{--<li class="clearfix">--}}
                                {{--<div class="column1">--}}
                                    {{--<p class="clearfix"><a href="#">回复<em>（90）</em></a> <a href="#">赞<em>（90）</em></a> </p>--}}
                                    {{--<p>一次用三星，不是很顺手，但咨询客服后终于上手了，感觉性价比相当不错，值得购买。但最想说的是京东客服更好，产品信得过，正品行货，买的放心。</p>--}}
                                    {{--<p class="column5">2014-11-25 14:32</p>--}}
                                {{--</div>--}}
                                {{--<div class="column2"><img src="/view/one/img/icon/star.png"></div>--}}
                                {{--<div class="column3">颜色：云石白</div>--}}
                                {{--<div class="column4">--}}
                                    {{--<p><img src="/view/one/img/icon/user.png"></p>--}}
                                    {{--<p>2014-11-23 22:37 购买</p>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                            {{--<li class="clearfix">--}}
                                {{--<div class="column1">--}}
                                    {{--<p class="clearfix"><a href="#">回复<em>（90）</em></a> <a href="#">赞<em>（90）</em></a> </p>--}}
                                    {{--<p>一次用三星，不是很顺手，但咨询客服后终于上手了，感觉性价比相当不错，值得购买。但最想说的是京东客服更好，产品信得过，正品行货，买的放心。</p>--}}
                                    {{--<p class="column5">2014-11-25 14:32</p>--}}
                                {{--</div>--}}
                                {{--<div class="column2"><img src="/view/one/img/icon/star.png"></div>--}}
                                {{--<div class="column3">颜色：云石白</div>--}}
                                {{--<div class="column4">--}}
                                    {{--<p><img src="/view/one/img/icon/user.png"></p>--}}
                                    {{--<p>2014-11-23 22:37 购买</p>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                            {{--<li class="clearfix">--}}
                                {{--<div class="column1">--}}
                                    {{--<p class="clearfix"><a href="#">回复<em>（90）</em></a> <a href="#">赞<em>（90）</em></a> </p>--}}
                                    {{--<p>一次用三星，不是很顺手，但咨询客服后终于上手了，感觉性价比相当不错，值得购买。但最想说的是京东客服更好，产品信得过，正品行货，买的放心。</p>--}}
                                    {{--<p class="column5">2014-11-25 14:32</p>--}}
                                {{--</div>--}}
                                {{--<div class="column2"><img src="/view/one/img/icon/star.png"></div>--}}
                                {{--<div class="column3">颜色：云石白</div>--}}
                                {{--<div class="column4">--}}
                                    {{--<p><img src="/view/one/img/icon/user.png"></p>--}}
                                    {{--<p>2014-11-23 22:37 购买</p>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                            {{--<li class="clearfix">--}}
                                {{--<div class="column1">--}}
                                    {{--<p class="clearfix"><a href="#">回复<em>（90）</em></a> <a href="#">赞<em>（90）</em></a> </p>--}}
                                    {{--<p>一次用三星，不是很顺手，但咨询客服后终于上手了，感觉性价比相当不错，值得购买。但最想说的是京东客服更好，产品信得过，正品行货，买的放心。</p>--}}
                                    {{--<p class="column5">2014-11-25 14:32</p>--}}
                                {{--</div>--}}
                                {{--<div class="column2"><img src="/view/one/img/icon/star.png"></div>--}}
                                {{--<div class="column3">颜色：云石白</div>--}}
                                {{--<div class="column4">--}}
                                    {{--<p><img src="/view/one/img/icon/user.png"></p>--}}
                                    {{--<p>2014-11-23 22:37 购买</p>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                            {{--<li class="clearfix">--}}
                                {{--<div class="column1">--}}
                                    {{--<p class="clearfix"><a href="#">回复<em>（90）</em></a> <a href="#">赞<em>（90）</em></a> </p>--}}
                                    {{--<p>一次用三星，不是很顺手，但咨询客服后终于上手了，感觉性价比相当不错，值得购买。但最想说的是京东客服更好，产品信得过，正品行货，买的放心。</p>--}}
                                    {{--<p class="column5">2014-11-25 14:32</p>--}}
                                {{--</div>--}}
                                {{--<div class="column2"><img src="/view/one/img/icon/star.png"></div>--}}
                                {{--<div class="column3">颜色：云石白</div>--}}
                                {{--<div class="column4">--}}
                                    {{--<p><img src="/view/one/img/icon/user.png"></p>--}}
                                    {{--<p>2014-11-23 22:37 购买</p>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                    {{--<div style="display:none" class="H-over pc-comments">--}}
                        {{--<ul class="clearfix">--}}
                            {{--<li class="clearfix">--}}
                                {{--<div class="column1">--}}
                                    {{--<p class="clearfix"><a href="#">回复<em>（90）</em></a> <a href="#">赞<em>（90）</em></a> </p>--}}
                                    {{--<p>一次用三星，不是很顺手，但咨询客服后终于上手了，感觉性价比相当不错，值得购买。但最想说的是京东客服更好，产品信得过，正品行货，买的放心。</p>--}}
                                    {{--<p class="column5">2014-11-25 14:32</p>--}}
                                {{--</div>--}}
                                {{--<div class="column2"><img src="/view/one/img/icon/star.png"></div>--}}
                                {{--<div class="column3">颜色：云石白</div>--}}
                                {{--<div class="column4">--}}
                                    {{--<p><img src="/view/one/img/icon/user.png"></p>--}}
                                    {{--<p>2014-11-23 22:37 购买</p>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                            {{--<li class="clearfix">--}}
                                {{--<div class="column1">--}}
                                    {{--<p class="clearfix"><a href="#">回复<em>（90）</em></a> <a href="#">赞<em>（90）</em></a> </p>--}}
                                    {{--<p>一次用三星，不是很顺手，但咨询客服后终于上手了，感觉性价比相当不错，值得购买。但最想说的是京东客服更好，产品信得过，正品行货，买的放心。</p>--}}
                                    {{--<p class="column5">2014-11-25 14:32</p>--}}
                                {{--</div>--}}
                                {{--<div class="column2"><img src="/view/one/img/icon/star.png"></div>--}}
                                {{--<div class="column3">颜色：云石白</div>--}}
                                {{--<div class="column4">--}}
                                    {{--<p><img src="/view/one/img/icon/user.png"></p>--}}
                                    {{--<p>2014-11-23 22:37 购买</p>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                            {{--<li class="clearfix">--}}
                                {{--<div class="column1">--}}
                                    {{--<p class="clearfix"><a href="#">回复<em>（90）</em></a> <a href="#">赞<em>（90）</em></a> </p>--}}
                                    {{--<p>一次用三星，不是很顺手，但咨询客服后终于上手了，感觉性价比相当不错，值得购买。但最想说的是京东客服更好，产品信得过，正品行货，买的放心。</p>--}}
                                    {{--<p class="column5">2014-11-25 14:32</p>--}}
                                {{--</div>--}}
                                {{--<div class="column2"><img src="/view/one/img/icon/star.png"></div>--}}
                                {{--<div class="column3">颜色：云石白</div>--}}
                                {{--<div class="column4">--}}
                                    {{--<p><img src="/view/one/img/icon/user.png"></p>--}}
                                    {{--<p>2014-11-23 22:37 购买</p>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                            {{--<li class="clearfix">--}}
                                {{--<div class="column1">--}}
                                    {{--<p class="clearfix"><a href="#">回复<em>（90）</em></a> <a href="#">赞<em>（90）</em></a> </p>--}}
                                    {{--<p>一次用三星，不是很顺手，但咨询客服后终于上手了，感觉性价比相当不错，值得购买。但最想说的是京东客服更好，产品信得过，正品行货，买的放心。</p>--}}
                                    {{--<p class="column5">2014-11-25 14:32</p>--}}
                                {{--</div>--}}
                                {{--<div class="column2"><img src="/view/one/img/icon/star.png"></div>--}}
                                {{--<div class="column3">颜色：云石白</div>--}}
                                {{--<div class="column4">--}}
                                    {{--<p><img src="/view/one/img/icon/user.png"></p>--}}
                                    {{--<p>2014-11-23 22:37 购买</p>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                            {{--<li class="clearfix">--}}
                                {{--<div class="column1">--}}
                                    {{--<p class="clearfix"><a href="#">回复<em>（90）</em></a> <a href="#">赞<em>（90）</em></a> </p>--}}
                                    {{--<p>一次用三星，不是很顺手，但咨询客服后终于上手了，感觉性价比相当不错，值得购买。但最想说的是京东客服更好，产品信得过，正品行货，买的放心。</p>--}}
                                    {{--<p class="column5">2014-11-25 14:32</p>--}}
                                {{--</div>--}}
                                {{--<div class="column2"><img src="/view/one/img/icon/star.png"></div>--}}
                                {{--<div class="column3">颜色：云石白</div>--}}
                                {{--<div class="column4">--}}
                                    {{--<p><img src="/view/one/img/icon/user.png"></p>--}}
                                    {{--<p>2014-11-23 22:37 购买</p>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                            {{--<li class="clearfix">--}}
                                {{--<div class="column1">--}}
                                    {{--<p class="clearfix"><a href="#">回复<em>（90）</em></a> <a href="#">赞<em>（90）</em></a> </p>--}}
                                    {{--<p>一次用三星，不是很顺手，但咨询客服后终于上手了，感觉性价比相当不错，值得购买。但最想说的是京东客服更好，产品信得过，正品行货，买的放心。</p>--}}
                                    {{--<p class="column5">2014-11-25 14:32</p>--}}
                                {{--</div>--}}
                                {{--<div class="column2"><img src="/view/one/img/icon/star.png"></div>--}}
                                {{--<div class="column3">颜色：云石白</div>--}}
                                {{--<div class="column4">--}}
                                    {{--<p><img src="/view/one/img/icon/user.png"></p>--}}
                                    {{--<p>2014-11-23 22:37 购买</p>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                    {{--<div style="display:none" class="H-over pc-comments">--}}
                        {{--<ul class="clearfix">--}}
                            {{--<li class="clearfix">--}}
                                {{--<div class="column1">--}}
                                    {{--<p class="clearfix"><a href="#">回复<em>（90）</em></a> <a href="#">赞<em>（90）</em></a> </p>--}}
                                    {{--<p>一次用三星，不是很顺手，但咨询客服后终于上手了，感觉性价比相当不错，值得购买。但最想说的是京东客服更好，产品信得过，正品行货，买的放心。</p>--}}
                                    {{--<p class="column5">2014-11-25 14:32</p>--}}
                                {{--</div>--}}
                                {{--<div class="column2"><img src="/view/one/img/icon/star.png"></div>--}}
                                {{--<div class="column3">颜色：云石白</div>--}}
                                {{--<div class="column4">--}}
                                    {{--<p><img src="/view/one/img/icon/user.png"></p>--}}
                                    {{--<p>2014-11-23 22:37 购买</p>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>
            {{--<div class="clearfix" style="margin-bottom:8px;">--}}
                {{--<div class="fr pc-search-g pc-search-gs">--}}
                    {{--<a href="#" class="fl " style="display:none">上一页</a>--}}
                    {{--<a class="current" href="#">1</a>--}}
                    {{--<a href="javascript:;">2</a>--}}
                    {{--<a href="javascript:;">3</a>--}}
                    {{--<a href="javascript:;">4</a>--}}
                    {{--<a href="javascript:;">5</a>--}}
                    {{--<a href="javascript:;">6</a>--}}
                    {{--<a href="javascript:;">7</a>--}}
                    {{--<span class="pc-search-di">…</span>--}}
                    {{--<a href="javascript:;">1088</a>--}}
                    {{--<a href="javascript:;" class="" title="使用方向键右键也可翻到下一页哦！">下一页</a>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
    </div>
    <div style="height:100px"></div>
@endsection
@section('script')

@endsection