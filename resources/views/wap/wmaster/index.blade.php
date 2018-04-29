<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/view/weui/dist/style/weui.css">
    <link rel="stylesheet" href="/view/weui/dist/example/example.css">
    <link rel="stylesheet" href="/view/frozen/css/frozen.css">
    <link rel="stylesheet" href="/service/swiper/css/swiper.css">


    <script src="/view/weui/dist/example/zepto.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>

    <script src="/view/weui/dist/example/weui.min.js" charset="utf-8"></script>
    <script src="/service/swiper/js/swiper.js" charset="utf-8"></script>
    <script src="/view/layui/layui.all.js" charset="utf-8"></script>


    <script src="/service/jNotify/ajax3.0.js" charset="utf-8"></script>
</head>
<body ontouchstart="">

@yield('content')
</body>

@yield('myjs')
</html>