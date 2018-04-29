@extends('wap.wmaster.index')
@section('title',"支付订单")
@section('content')

        <div class="container" id="container">
            <div class="page__hd">
                <h1 class="page__title">瑞克斯网络科技有限公司</h1>
                <p class="page__desc">收款方:瑞克斯网络科技有限公司</p>
            </div>
            <div class="page__bd page__bd_spacing">
                <a href="{{ $r }}" class="weui-btn weui-btn_primary">确定支付￥{{$total_fee/100 }}元 </a>
            </div>
        <div>
@endsection
@section('myjs')

@endsection
