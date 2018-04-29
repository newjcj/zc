@extends('m.master.index')
@section('title',"登录")
@section('content')


    <div class="container" id="container">


        <div class="page searchbar js_show">




            {{--产品--}}
            <div class="page__hd">
                <h1 class="page__title">Input</h1>
                <p class="page__desc">表单输入</p>
            </div>
            <div class="weui-grids">
                <div class="weui-cell weui-cell_vcode">
                    <div class="weui-cell__hd">
                        <label class="weui-label">手机号</label>
                    </div>
                    <div class="weui-cell__bd">
                        <input class="weui-input" type="tel" placeholder="请输入手机号">
                    </div>
                    <div class="weui-cell__ft">
                        <button class="weui-vcode-btn">获取验证码</button>
                    </div>
                </div>
                <div class="weui-cell weui-cell_vcode">
                    <div class="weui-cell__hd"><label class="weui-label">验证码</label></div>
                    <div class="weui-cell__bd">
                        <input class="weui-input" type="number" placeholder="请输入验证码">
                    </div>
                    <div class="weui-cell__ft">
                        <img class="weui-vcode-img" src="/service/weui/images/vcode.jpg">
                    </div>
                </div>
            </div>
            {{--留白空间--}}
            <div style="height:50px;"></div>


        </div>
    </div>

@endsection
@section('myjs')

@endsection

