@extends('wap.master.index')
@section('title','确认支付')
@section('head')
    <div class="container" id="container">


        <div class="page searchbar js_show">
            <div class="page__bd">
                <!--<a href="javascript:;" class="weui-btn weui-btn_primary">点击展现searchBar</a>-->
                <div class="weui-cell">
                    <div class="weui-cell__bd" style="text-align:center">
                        <p style="font-size:23px;">瑞克斯网络科技有限公司</p>
                        <p style="font-size:3em;">￥{{$order->total_fee/100 }}元</p>
                    </div>
                </div>

                <div class="weui-cell">
                    <div class="weui-cell__bd" style="text-align:center">
                        <p style="font-size:17px;">收款方:瑞克斯网络科技有限公司</p>
                    </div>
                </div>


                {{--留白空间--}}
                <div style="height:50px;"></div>


            </div>
        </div>
        <div class="weui-tabbar">
            <div class="weui-btn-area" style="width:90%;margin-top:2px;">
                <a href="javascript:WXPayment();" class="weui-btn weui-btn_primary" id="btnUpload">确定支付</a>
            </div>

        </div>
        <script>
            /*退款*/
                    {{--Ajax().post('/pay/refund',{--}}
                    {{--out_trade_no:"452f24c288a998f5656ecef2829a4887",--}}
                    {{--_token: "{{csrf_token()}}",--}}
                    {{--},function(data){--}}
                    {{--var msg=JSON.parse(data);--}}
                    {{--if(msg.status==0){--}}
                    {{--alert('支付成功！');--}}
                    {{--}else{--}}
                    {{--alert('支付成功!!!！');--}}
                    {{--}--}}
                    {{--});--}}

            var WXPayment = function () {
                    if (typeof WeixinJSBridge === 'undefined') {
                        if (document.addEventListener) {
                            document.addEventListener('WeixinJSBridgeReady', wxPayCall, false);
                        } else if (document.attachEvent) {
                            document.attachEvent('WeixinJSBridgeReady', wxPayCall);
                            document.attachEvent('onWeixinJSBridgeReady', wxPayCall);
                        }
                        alert('请在微信打开页面！');
                        return false;
                    }
                    WeixinJSBridge.invoke(
                        'getBrandWCPayRequest', <?php echo $payment->getConfig(); ?>, function (res) {
                            switch (res.err_msg) {
                                case 'get_brand_wcpay_request:cancel':
                                    {{--Ajax().post('/pay/delorder',{--}}
                                    {{--out_trade_no:"{{$order->out_trade_no}}",--}}
                                    {{--_token: "{{csrf_token()}}",--}}
                                    {{--},function(data){--}}
                                    {{--var msg=JSON.parse(data);--}}
                                    {{--});--}}
                                    layer.msg('用户取消支付！',{'time':2000});
                                    window.history.go(-1);
                                    break;
                                case 'get_brand_wcpay_request:fail':
                                    layer.msg('支付失败！（' + res.err_desc + '）',{'time':2000});
                                    break;
                                case 'get_brand_wcpay_request:ok':
                                    layer.msg('支付成功！',{'time':2000});
                                    location.href = "/wap/user/center";
                                    break;
                                default:
                                    alert(JSON.stringify(res));
                                    break;
                            }
                        }
                    );
                }

        </script>
@endsection
@section('script')

@endsection
