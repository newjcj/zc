<div class="weui-tabbar" style="background: black;">
    <a href="/user/about" class="weui-tabbar__item {{Request::is('user/about') ? 'weui-bar__item_on' : ''}}">
                    <span style="display: inline-block;position: relative;">
                        <img src="/view/img/icon1/2.png" alt="" class="weui-tabbar__icon">
                        {{--<span class="weui-badge" style="position: absolute;top: -2px;right: -13px;">8</span>--}}
                    </span>
        <p class="weui-tabbar__label">首页</p>
    </a>
    <a href="/goods/index" class="weui-tabbar__item {{Request::is('goods/*') ? 'weui-bar__item_on' : ''}}">
        <img src="/view/img/icon1/1.png" alt="" class="weui-tabbar__icon">
        <p class="weui-tabbar__label">在线购物</p>
    </a>
    {{--<a href="/cart/list" class="weui-tabbar__item">--}}
    {{--<span style="display: inline-block;position: relative;">--}}
    {{--<img src="/view/img/icon1/3.png" alt="" class="weui-tabbar__icon">--}}
    {{--<span class="weui-badge weui-badge_dot" style="position: absolute;top: 0;right: -6px;"></span>--}}
    {{--</span>--}}
    {{--<p class="weui-tabbar__label">购物车</p>--}}
    {{--</a>--}}
    <a href="/user/index" class="weui-tabbar__item {{Request::is('user/index') ? 'weui-bar__item_on' : ''}}">
        <img src="/view/img/icon1/4.png" alt="" class="weui-tabbar__icon">
        <p class="weui-tabbar__label">个人中心</p>
    </a>
</div>