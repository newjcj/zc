@extends('wap.master.index')
@section('title','订单详情')
@section('head')
    <link rel="stylesheet" type="text/css" href="/wap/css/center.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/loaders.min.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/loading.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/components/category/category.css"/>
    <script src="/wap/js/rem.js"></script>
    <script src="/service/jquery.nicescroll.min.js"></script>
    <script src="/wap/components/category/category.js" type="text/javascript"></script>
    <script type="text/javascript">
        sessionStorage.url = "confirm";
        $(window).load(function () {
            $(".loading").addClass("loader-chanage");
            $(".loading").fadeOut(300)
        })
    </script>

    <style>

    </style>

@endsection

@section('content')
    <div class="main category">
        <div class="top">
            <div class="input">
                <input type="text" placeholder="搜索">
                <span>搜索</span>
            </div>
        </div>
        <div class="content">
            <div class="left">
                <ul>
                    @foreach($categorys as $category)
                        <li onclick="_show('{{$category->id}}',this,'{{csrf_token()}}')">
                            <p>{{ $category->name }}</p>
                            <span data-status="1" data-image="{{$category->image}}" data-image2="{{$category->image2}}"><img src="{{$category->image}}" alt=""></span>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="right">

            </div>
        </div>
        <div class="footer"></div>
    </div>

@endsection

@section('script')
@endsection