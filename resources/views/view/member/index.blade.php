<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="Keywords" content="{$keywords}" />
    <meta name="Description" content="{$description}" />
    <!-- TemplateBeginEditable name="doctitle" -->
    <title>首页</title>
    <!-- TemplateEndEditable -->
    <!-- TemplateBeginEditable name="head" -->
    <!-- TemplateEndEditable -->
    <link rel="shortcut icon" href="favicon.ico" />
    <!-- #BeginLibraryItem "/library/js_languages_new.lbi" --><!-- #EndLibraryItem -->
    <link rel="stylesheet" type="text/css" href="/view/ecmoban/css/quickLinks.css" />
</head>

<body>
<!-- #BeginLibraryItem "/library/page_header_common.lbi" --><!-- #EndLibraryItem -->
<div class="content" ectype="lazyDscWarp">
    <!--Banner Pic-->
    <div class="banner home-banner">
        <div class="bd">
            <!-- #BeginLibraryItem "/library/index_ad.lbi" --><!-- #EndLibraryItem -->
        </div>
        <div class="hd">
            <ul></ul>
        </div>
        <div class="vip-outcon">
            {* DSC 提醒您：动态载入index_user_info.lbi，显示首页分类小广告 *}
            @include();
        </div>
    </div>
    <div class="channel-content" ectype="channel">
        {* DSC 提醒您：动态载入seckill_goods_list.lbi，显示首页分类小广告 *}{insert name='index_seckill_goods'}
        {* DSC 提醒您：动态载入index_ad_cat.lbi，显示首页分类小广告 *}{insert name='get_adv_child' ad_arr=$rec_cat}
    </div>
    <div class="floor-loading" ectype="floor-loading"><div class="floor-loading-warp"><img src="/view/ecmoban/images/load/loading.gif"></div></div>
    <div class="other-content">
        {* DSC 提醒您：动态载入expert_field.lbi，显示首页达人专区小广告 *}{insert name='get_adv_child' ad_arr=$expert_field}

        <div class="lift-channel clearfix" id="guessYouLike">
            <ul>
                <!-- {foreach from=$guess_goods item=goods name=foo} -->
                <li class="opacity_img">
                    <a href="{$goods.url}">
                        <div class="p-img"><img src="{$goods.goods_thumb}"></div>
                        <div class="p-name" title="{$goods.short_name|escape:html}">{$goods.short_name|escape:html}</div>
                        <div class="p-price">
                            <div class="shop-price">{$goods.shop_price}</div>
                            <div class="original-price">{$goods.market_price}</div>
                        </div>
                    </a>
                </li>
                <!--{/foreach}-->
            </ul>
        </div>
    </div>
</div>

{* ECSHOP 提醒您：动态载入user_menu_position.lbi，显示首页分类小广告 *}{insert name='user_menu_position'}

<!-- #BeginLibraryItem "/library/page_footer.lbi" --><!-- #EndLibraryItem -->

{insert_scripts files='jquery.SuperSlide.2.1.1.js,jquery.yomi.js,cart_common.js,cart_quick_links.js'}
<script type="text/javascript" src="/view/ecmoban/js/dsc-common.js"></script>
<script type="text/javascript" src="/view/ecmoban/js/asyLoadfloor.js"></script>
<script type="text/javascript" src="/view/ecmoban/js/jquery.purebox.js"></script>
<script type="text/javascript">
    /*首页轮播*/
    var length = $(".banner .bd").find("li").length;
    if(length>1){
        $(".banner").slide({titCell:".hd ul",mainCell:".bd ul",effect:"fold",interTime:3500,delayTime:500,autoPlay:true,autoPage:true,trigger:"click",endFun:function(i,c,s){
            $(window).resize(function(){
                var width = $(window).width();
                s.find(".bd li").css("width",width);
            });
        }});
    }else{
        $(".banner .hd").hide();
    }
    $(".vip-item").slide({titCell:".tit a",mainCell:".con"});
    $(".seckill-channel").slide({mainCell:".box-bd ul",effect:"leftLoop",autoPlay:true,autoPage:true,interTime:5000,delayTime:500,vis:5,scroll:1,trigger:"click"});

    function load_js_content(key){
        var Floor = $("#floor_" + key);
        Floor.slide({titCell:".hd-tags li",mainCell:".floor-tabs-content",titOnClassName:"current"});
        Floor.find(".floor-left-slide").slide({titCell:".hd ul",mainCell:".bd ul",effect:"left",interTime:3500,delayTime:500,autoPlay:true,autoPage:true});
    }
    $("*[ectype='time']").each(function(){
        $(this).yomi();
    });

    //页面刷新自动返回顶部
    $("body,html").animate({scrollTop:0},50);



    //会员名称*号 by yanxin
    var name = $(".suspend-login a.nick_name").text();
    var star = new Array();
    var nameLen = name.length > 2 ? name.length-2:"1";
    for(var i=1;i<=nameLen;i++){
        star.push("*");
    }
    star = star.join("");
    if(name.length > 2){
        var new_name = name[0] + star + name[name.length-1];
    }else{
        var new_name = name[0] + star;
    }
    $(".suspend-login a.nick_name").text(new_name);

    //去掉悬浮框 我的购物车
    $(".attached-search-container .shopCart-con a span").text("");
</script>
</body>
</html>
