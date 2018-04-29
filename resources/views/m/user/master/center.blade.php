<header id="header" style="">
    <div class="topbar">
        <a href="javascript:history.back();" class="back_btn"><i class="iconfont">ş</i></a>
        <h1 class="page_title">会员中心</h1>
    </div>
</header>
<!-- 会员头像 -->
<div class="vip-header">
    <a href="">
        <dl>
            <dt>
                <img src="{{ $user->headimgurl }}" />
            </dt>
            <dd>
                <h4>{{$user->nickname}}<span>普通会员</span></h4>
                <p><span>积分：<i>30</i></span>&nbsp;&nbsp;<span>红包：<i>0</i></span></p>
            </dd>
        </dl>
    </a>
    <ul>
        <li><a href="/wap/user/orderlist?a=1"><span>{{$fknum}}</span><p>待付款</p> </a></li>
        <li><a href="/wap/user/orderlist?a=2"><span>{{$dshnum}}</span><p>待收货</p> </a></li>
        <li><a href="/wap/user/evaluate?a=1"><span>{{$eval}}</span><p>待评价</p> </a></li>
    </ul>
</div>