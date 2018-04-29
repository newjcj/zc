<html>
    <head>
            <link rel="stylesheet" type="text/css" href="/wap/sourse/layer/mobile/need/layer.css">
        <script src="/wap/js/jquery.min.js" type="text/javascript"></script>
        <script src="/admin/layui/layui.all.js"></script>
    </head>
    <body>
        <li><a href="mqq://" id='openqq'><i class="iconfont"></i><p>确定支付成功2</p> </a></li>
    </body>
    <script>
        layer.open({
            title: '提示',
            shadeClose:true,//点击遮罩关闭
            content: '确定支付成功',
            yes:function(){
                layer.closeAll();
                 _hr();
            },
            cancel: function(){
                //右上角关闭回调
                _hr();
              }
            });
        var _hr=function(){
            console.log(11);
            location.href = "mqq://";
                //location.href = 'http://{{$_SERVER['HTTP_HOST']}}/1.tgz';
        };
    
    </script>
</html>