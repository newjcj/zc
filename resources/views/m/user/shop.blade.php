@extends('wap.master.index')
@section('title','订单详情')
@section('title','开店申请')

@section('head')
    <link rel="stylesheet" type="text/css" href="/wap/css/center.css" />
    <link rel="stylesheet" type="text/css" href="/wap/css/loaders.min.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/loading.css"/>
    <link rel="stylesheet" type="text/css" href="/service/webuploader/webuploader.css"/>
    <script src="/wap/js/rem.js"></script>
    <script src="/wap/js/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/admin/js/register.js"></script>
    <script type="text/javascript" src="/service/webuploader/webuploader.js"></script>

    <script src="/wap/js/common.js"></script>
    <script src="/wap/js/Popt.js"></script>
    <script src="/wap/js/cityJson.js"></script>
    <script src="/wap/js/citySet.js"></script>

    <style type="text/css">
        ._citys {width:100%; height:100%;display: inline-block; position: relative;}
        ._citys span {color: #56b4f8; height: 15px; width: 15px; line-height: 15px; text-align: center; border-radius: 3px; position: absolute; right: 1em; top: 10px; border: 1px solid #56b4f8; cursor: pointer;}
        ._citys0 {width: 100%; height: 34px; display: inline-block; border-bottom: 2px solid #56b4f8; padding: 0; margin: 0;}
        ._citys0 li {float:left; height:34px;line-height: 34px;overflow:hidden; font-size: 15px; color: #888; width: 80px; text-align: center; cursor: pointer; }
        .citySel {background-color: #56b4f8; color: #fff !important;}
        ._citys1 {width: 100%;height:80%; display: inline-block; padding: 10px 0; overflow: auto;}
        ._citys1 a {height: 35px; display: block; color: #666; padding-left: 6px; margin-top: 3px; line-height: 35px; cursor: pointer; font-size: 13px; overflow: hidden;}
        ._citys1 a:hover { color: #fff; background-color: #56b4f8;}
        .ui-content{border: 1px solid #EDEDED;}
        li{list-style-type: none;}
         .imgs img{
             width:100px;
         }
    </style>




    <script type="text/javascript">
        $(window).load(function(){
            $(".loading").addClass("loader-chanage");
            $(".loading").fadeOut(300);
        });
        $(function(){
            //计算内容上下padding
            reContPadding({main:"#main",header:"#header",footer:"#footer"});
            function reContPadding(o){
                var main = o.main || "#main",
                    header = o.header || null,
                    footer = o.footer || null;
                var cont_pt = $(header).outerHeight(true),
                    cont_pb = $(footer).outerHeight(true);
                $(main).css({paddingTop:cont_pt,paddingBottom:cont_pb});
            }
        });
    </script>

@endsection

@section('content')
    <header id="header" style="">
        <div class="topbar" style=" background-color: #f5655c;">
            <a href="javascript:history.back();" class="back_btn"><i class="iconfont">ş</i></a>
            <h1 class="page_title">商家实名认证</h1>
        </div>
    </header>
    <!-- 会员俱乐部 -->
    <div class="vip-club border_top_bottom vip-account">
        <div class="vip-club-title">
            <div style="width:100%;background:url(../images/flow_check_03.png);background-size:20%;height:5px;clear:both;"></div>
        </div>
        {{--@if(count($shop))--}}
        <input id = 'status' value="{{$shop?$shop->certify:''}}" type="hidden">
        {{--@endif--}}
        <div class="vip-club border_top_bottom">
            <div class="vip-club-title border_bottom">
                公司的姓名：&nbsp;<input id="name" name="name" type="text" style=" border: 0px;" >
            </div>
            <div class="vip-club-title border_bottom">
                身份证号码： <input id="identity" name="identity" type="text" style=" border: 0px;">
            </div>
            <div class="vip-club-title border_bottom">
                银行卡号码：<input id="number" name="number" type="text" style=" border: 0px;">
            </div>
            <div class="vip-club-title border_bottom">
                银行归属地：<input id="bankname" name="bankname" type="text" style=" border: 0px;">
            </div>

            <div class="vip-club-title border_bottom">
                所在&nbsp;地区：<font size="-1"><span id="city" name="city" style="color:#d7d7d7;padding-left:5px;"></span></font>
            </div>

            <div class="vip-club-title border_bottom">
                详细&nbsp;地址：<input id="address" name="address" type="text" placeholder="街道 楼牌号等" style=" border: 0px;">
            </div>

            <div class="imgs">
                <span>添加身份证正面和反面图片和营业执照</span>
                <div class="img">
                    <img class="preview_id1 picker" src="/admin/images/icon-add.png"  alt="">
                    <img class="preview_id2 picker" src="/admin/images/icon-add.png"  alt="">
                    <img class="preview_id3 picker" src="/admin/images/icon-add.png"  alt="">
                </div>
                <div class="cli" id="filePicker">添加图片</div>
            </div>

            <div class="vip-club-title border_bottom">
                <p align="center"><input id="save" type="button"  class="sub" value="提交审核" style="-webkit-appearance: none; border:solid 1px #84c1ff;background:#1980e0;color:#fff;width:80px; height: 35px;"></p>
            </div>
        </div>
    </div>
    <br><br><br>
    <script>
        // 初始化Web Uploader
        var uploader = WebUploader.create({

            // 选完文件后，是否自动上传。
            auto: true,
            // 文件接收服务端。

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',

            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            }
        });
        // 当有文件添加进来的时候
        uploader.on( 'fileQueued', function( file ) {
            var srcs = [$('.preview_id1').attr('src'),$('.preview_id2').attr('src'),$('.preview_id3').attr('src')];
            $img='';
            if(srcs[0] === '/admin/images/icon-add.png'){
                $img=$('.preview_id1');
            }else if(srcs[1] === '/admin/images/icon-add.png'){
                $img=$('.preview_id2');

            }else{
                $img=$('.preview_id3');
            }

            // 创建缩略图
            // 如果为非图片文件，可以不用调用此方法。
            // thumbnailWidth x thumbnailHeight 为 100 x 100
            uploader.makeThumb( file, function( error, src ) {
                if ( error ) {
                    $img.replaceWith('<span>不能预览</span>');
                    return;
                }

                $img.attr( 'src', src );
            }, 1000, 1000 );
        });
    </script>

    <script src='/wap/js/jquery.js'></script>
    <script src="/wap/js/index.js"></script>
    <script src='/service/uploadFile.js'></script>
@endsection

@section('script')
    <script type="text/javascript">

        $(function () {
            var status = $("#status").val();
            if(status == 0){
//               alert('审核中，请耐心等待。。');
//               location.href='/wap/user/center';
            }else if(status == 1){
                alert('审核成功，详情请登录商家后台。。');
                location.href='/wap/user/center';
            }else if(status == 3){
                alert('审核失败，请联系管理员');
                location.href='/wap/user/center';
            }else if(status == 4){
               alert('不充许提交');
                location.href='/wap/user/center';
            }
        });

        $("#city").click(function (e) {
            SelCity(this,e);
            console.log(this);
        });

        $("#save").click(function(){
            var preview1 = $('#preview_id1').attr('src');
            var preview2 = $('#preview_id2').attr('src');
            var preview3 = $('#preview_id3').attr('src');
            $.ajax({
                url: '/wap/user/shop',
                data: {
                    name:$('input[name="name"]').val(),
                    identity:$('input[name="identity"]').val(),
                    number:$('input[name="number"]').val(),
                    bankname:$('input[name="bankname"]').val(),
                    city:$('input[name="city"]').val(),
                    address:$('input[name="address"]').val(),
                    preview1:preview1,
                    preview2:preview2,
                    preview3:preview3,
                    _token: "{{csrf_token()}}"
                },
                type: 'post',
                dataType: 'json',
                async:false,
                success: function (data) {
                    console.log(data.status);
                    if(data.status == 1){
                        window.location.href=data.returnurl;
                    }else if(data.status == 4){
                        window.location.href=data.returnurl;
                    }else{
                        alert("添加失败，请联系客服！");
                    }
                }
            });
        });




    </script>
    <script type="text/javascript">
        sessionStorage.url = "confirm";
        $(window).load(function(){
            $(".loading").addClass("loader-chanage");
            $(".loading").fadeOut(300)
        })
    </script>
@endsection
@section('content')

@endsection
@section('script')


@endsection