@extends('wap.master.index')
@section('title','订单详情')
@section('head')
    <link rel="stylesheet" type="text/css" href="/wap/css/center.css" />
    <link rel="stylesheet" type="text/css" href="/wap/css/loaders.min.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/loading.css"/>
    <script src="/wap/js/rem.js"></script>
    <script src="/wap/js/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/admin/js/register.js"></script>



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
        </div>
    </header>
    <!-- 会员俱乐部 -->
    <div>
        <img src="/wap/images/check.jpg">
    </div>

    <script src='/wap/js/jquery.js'></script>
    <script src="/wap/js/index.js"></script>
    <script src='/service/uploadFile.js'></script>
@endsection

@section('script')
    <script type="text/javascript">
        $("#save").click(function(){
            var preview1 = $('#preview_id1').attr('src');
            var preview2 = $('#preview_id2').attr('src');
            $.ajax({
                url: '/wap/user/verify',
                data: {
                    name:$('input[name="name"]').val(),
                    identity:$('input[name="identity"]').val(),
                    number:$('input[name="number"]').val(),
                    bankname:$('input[name="bankname"]').val(),
                    preview1:preview1,
                    preview2:preview2,
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

@endsection