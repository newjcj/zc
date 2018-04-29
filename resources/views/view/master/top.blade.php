<div class="pc-header-nav">
    <div class="pc-header-con">
        <div class="fl pc-header-link">您好！，欢迎来五色瑞克斯
            @if(\Illuminate\Support\Facades\Session::get('member'))
                <a href="javascript:_logout()" target="_blank">退出</a>
                <a href="/view/member/login" target="_blank">111</a>
                <a href="/view/member/register" target="_blank"> 1111</a></div>
            @else
                <a href="/view/member/login" target="_blank">请登录1</a>
                <a href="/view/member/register" target="_blank"> 免费注册</a></div>
            @endif
        <div class="fr pc-header-list top-nav">
            <ul>
                @if(\Illuminate\Support\Facades\Session::get('member'))
                <li>
                    <div class="nav"><i class="pc-top-icon"></i><a href="/view/member/order">我的订单1</a></div>
                    <div class="con">
                        <dl>
                            <dt><a href="">批发进货</a></dt>
                            <dd><a href="">已买到货品</a></dd>
                            <dd><a href="">优惠券</a></dd>
                            <dd><a href="">店铺动态</a></dd>
                        </dl>
                    </div>
                </li>
                <li>
                    <div class="nav"><i class="pc-top-icon"></i><a href="#">我的商城</a></div>
                    <div class="con">
                        <dl>
                            <dt><a href="">批发进货</a></dt>
                            <dd><a href="">已买到货品</a></dd>
                            <dd><a href="">优惠券</a></dd>
                            <dd><a href="">店铺动态</a></dd>
                        </dl>
                    </div>
                </li>
                <li><a href="#">我的云购</a></li>
                <li><a href="#">我的收藏</a></li>
                <li><a href="/view/member/order">会员中心</a></li>
                @endif
                <li><a href="#">客户服务</a></li>
                <li><a href="#">帮助中心</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="pc-header-logo clearfix">
    <div class="pc-fl-logo fl">
        <h1>
            <a href="/view/home/index"></a>
        </h1>
    </div>
    <div class="head-form fl">
        <form class="clearfix">
            <input class="search-text" accesskey="" id="key" autocomplete="off" placeholder="洗衣机" type="text">
            <button class="button" onclick="search('key');return false;">搜索</button>
        </form>
        <div class="words-text clearfix">
            <a href="#" class="red">1元秒爆{{$category[0]['name']}}</a>
            <a href="#">低至五折</a>
            <a href="#">农用物资</a>
            <a href="#">佳能相机</a>
            <a href="#">服装城</a>
            <a href="#">买4免111</a>
            <a href="#">家电秒杀</a>
            <a href="#">农耕机械</a>
            <a href="#">手机新品季</a>
        </div>
    </div>
    <div class="fr pc-head-car">
        <i class="icon-car"></i>
        <a href="/view/home/car" target="_blank">我的购物车</a>
        <em>{{ \App\Models\Cart::getCartnum() }}</em>
    </div>
</div>
<script>
    _logout=function(){
        $.ajax({
                url: '/view/member/logout',
                data: {
                    _token: "{{csrf_token()}}"
                },
                type: 'post',
                dataType: 'json',
                async:false,
                success: function (data) {
                    window.location.href='/view/home/index';
                }
            });
    }
</script>