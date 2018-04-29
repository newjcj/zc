<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/wap/weui/dist/style/weui.css">
    <link rel="stylesheet" href="/wap/weui/dist/example/example.css">

    @yield('head')
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
<body ontouchstart="">
<!--头部区域-->

<!--商品区域-->

@yield('content')


@include('wap.master.footer')
</body>
@yield('script')
<script src="/wap/weui/example/zepto.min.js"></script>
<script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script src="https://res.wx.qq.com/open/libs/weuijs/1.0.0/weui.min.js"></script>
<script src="/wap/weui/example/example.min.js"></script>
</html>
