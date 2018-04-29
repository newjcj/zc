@extends('view.master.index')
@section('title','商品列表')
@section('cartnum',2)
@section('asset')

@endsection
@section('content')
    <section id="pc-jie">
        <div class="center ">
            <ul class="pc-shopping-title clearfix">
                <li><a href="#" class="cu">全部商品(10)</a></li>
            </ul>
        </div>
        <div class="pc-shopping-cart center">
            <div class="pc-shopping-tab">
                <table>
                    <thead>
                    <tr class="tab-0">
                        <th class="tab-1"><input type="checkbox" name="s_all" class="s_all tr_checkmr"
                                                 id="s_all_h"><label for=""> 全选</label></th>
                        <th class="tab-2">商品</th>
                        <th class="tab-3">商品信息</th>
                        <th class="tab-4">单价</th>
                        <th class="tab-5">数量</th>
                        <th class="tab-6">小计</th>
                        <th class="tab-7">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($carts) && count($carts) && $status==1)
                        @foreach($carts as $cart)
                            <tr data-info={cartid:"{{$cart->id}}",id:"{{$cart->goods->id}}",price:"{{$cart->goods->price}}",count:"{{$cart->num}}"}>
                                <th><input type="checkbox" class="checke" onchange="_checkbox(this)" style="margin-left:10px; float:left"></th>
                                <th class="tab-th-1">
                                    <a href="/view/home/page?id={{ $cart->goods->id }}"><img src="{{\App\Models\Goods::getGoodsimages($cart->goods)[0]}}" width="100%"
                                                     alt=""></a>
                                    <a href="/view/home/page?id={{ $cart->goods->id }}" class="tab-title"> {{$cart->goods->name}} </a>
                                </th>
                                <th>
                                    <p>颜色：黑色</p>
                                    <p>规格：落地款</p>
                                </th>
                                <th>
                                    <p>{{$cart->goods->price}}</p>
                                    {{--<p class="red">299.99</p>--}}
                                </th>
                                <th class="tab-th-2">
                                    <span class="sub" onclick="_sub(this)">-</span>
                                    <input type="text" readonly value="{{$cart->num}}" maxlength="3" placeholder="" class="shul">
                                    <span class="add" onclick="_add(this)">+</span>
                                </th>
                                <th class="red">{{$cart->goods->price * $cart->num}}</th>
                                <th><a href="javascript:min.deleteCart({{$cart->goods->id}})">删除</a></th>
                            </tr>
                        @endforeach
                    @elseif(isset($carts) && count($carts) && $status==2)
                        @foreach($carts as $cart)
                            <tr data-info={cartid:"",id:"{{$cart['goods']->id}}",price:"{{$cart['goods']->price}}",count:"{{$cart['num']}}"}>
                                <th><input type="checkbox" class="checke" onchange="_checkbox(this)" style="margin-left:10px; float:left"></th>
                                <th class="tab-th-1">
                                    <a href="/view/home/page?id={{ $cart['goods']->id }}"><img src="{{ \App\Models\Goods::getGoodsimages($cart['goods'])[0] }}" width="100%"
                                                     alt=""></a>
                                    <a href="/view/home/page?id={{ $cart['goods']->id }}" class="tab-title"> {{$cart['goods']->name}} </a>
                                </th>
                                <th>
                                    <p>颜色：黑色</p>
                                    <p>规格：落地款</p>
                                </th>
                                <th>
                                    <p>{{$cart['goods']->price}}</p>
                                    {{--<p class="red">299.99</p>--}}
                                </th>
                                <th class="tab-th-2">
                                    <span class="sub" onclick="_sub(this)">-</span>
                                    <input onclick="_delete1(this)" type="text" readonly value="{{$cart['num']}}" maxlength="3" placeholder="" class="shul">
                                    <span class="add" onclick="_add(this)">+</span>
                                </th>
                                <th class="red">{{$cart['goods']->price * $cart['num']}}</th>
                                <th><a onclick="_delete1(this)">删除</a></th>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>

            </div>
        </div>
        <div style="height:10px"></div>
        <div class="center">
            <div class="clearfix pc-shop-go">
                <div class="fl pc-shop-fl">
                    <input type="checkbox" class="allcheck" onclick="_allcheck(this)" placeholder="">
                    <label for="">全选</label>
                    {{--<a href="#">删除</a>--}}
                    {{--<a href="#">清楚失效商品</a>--}}
                </div>
                <div class="fr pc-shop-fr">
                    <p>共有 <em class="red pc-shop-shu">0</em> 款商品，总计（不含运费）</p>
                    <span class="pricenum">¥ 0.00</span>
                    <a href="javascript:_pay(this)">去付款</a>
                </div>
            </div>
            @if(isset($carts) && count($carts) && $status==2)
                <script type="text/javascript">
                    //hover 触发两个事件，鼠标移上去和移走
                    //mousehover 只触发移上去事件
                    $(".top-nav ul li").hover(function () {
                        $(this).addClass("hover").siblings().removeClass("hover");
                        $(this).find("li .nav a").addClass("hover");
                        $(this).find(".con").show();
                    }, function () {
                        //$(this).css("background-color","#f5f5f5");
                        $(this).find(".con").hide();
                        //$(this).find(".nav a").removeClass("hover");
                        $(this).removeClass("hover");
                        $(this).find(".nav a").removeClass("hover");
                    })

                    //初始化商品总价格
                    num = 0;//总价格
                    goodsnum = 0;//总商品数
                    function _checkbox(obj){
                        $('.allcheck').removeAttr('checked');
                        _check($(obj));
                        _checCount();
                    }
                    //全选
                    function _allcheck(obj){
                        _check($(obj));
                        $('.checke').each(function(i,obj){
                            _check($(obj));
                            _checCount();
                        });
                    }
                    function _add(obj){
                        var trobj=min.getObj($(obj).parents('tr').data('info'));
                                        var redobj = $(obj).parents('tr').find('.red');
                                        var shulobj = $(obj).parents('tr').find('.shul');
                                        shulobj.val(parseInt(shulobj.val()) +1);
                                        redobj.text( parseInt(trobj.price) * shulobj.val() );
                                        _check($(obj).parents('tr').find('.checke'));
                                        _check($(obj).parents('tr').find('.checke'));
                                        _checCount();
                    }
                    function _sub(obj){
                        var trobj=min.getObj($(obj).parents('tr').data('info'));

                                       var redobj = $(obj).parents('tr').find('.red');
                                       var shulobj = $(obj).parents('tr').find('.shul');
                                       //数量不能为0
                                       if(parseInt(parseInt(shulobj.val()) -1) < 1 ){
                                           return;
                                       }
                                       shulobj.val(parseInt(shulobj.val()) -1);
                                       redobj.text( parseInt(trobj.price) * shulobj.val() );
                                       _check($(obj).parents('tr').find('.checke'));
                                       _check($(obj).parents('tr').find('.checke'));
                                       _checCount();
                    }
                    function _checCount(){
                        num=0;
                        goodsnum =0;
                        $('.checke').each(function(i,obj){
                            var trobj=min.getObj($(obj).parents('tr').data('info'));
                            if($(obj).attr('data-check') === '1'){
                                num += trobj.price* $(obj).parents('tr').find('.shul').val();
                                goodsnum +=1;
                            }
                            $('.pc-shop-shu').html(goodsnum);
                            $('.pricenum').html('￥'+(num));
                        });
                    }
                    function _check(obj){
                        if(obj.attr('data-check') === '1'){
                            obj.attr('data-check',0);
                            $(obj).removeAttr('checked');
                        }else{
                            obj.attr('data-check',1);
                            $(obj).prop('checked','checked');
                        }

                    }
                </script>
                @elseif(isset($carts) && count($carts) && $status==1)
                <script type="text/javascript">
                    //hover 触发两个事件，鼠标移上去和移走
                    //mousehover 只触发移上去事件
                    $(".top-nav ul li").hover(function () {
                        $(this).addClass("hover").siblings().removeClass("hover");
                        $(this).find("li .nav a").addClass("hover");
                        $(this).find(".con").show();
                    }, function () {
                        //$(this).css("background-color","#f5f5f5");
                        $(this).find(".con").hide();
                        //$(this).find(".nav a").removeClass("hover");
                        $(this).removeClass("hover");
                        $(this).find(".nav a").removeClass("hover");
                    })

                    //初始化商品总价格
                    num = 0;//总价格
                    goodsnum = 0;//总商品数
                    function _checkbox(obj){
                        $('.allcheck').removeAttr('checked');
                        _check($(obj));
                        _checCount();
                    }
                    //全选
                    function _allcheck(obj){
                        _check($(obj));
                        $('.checke').each(function(i,obj){
                            _check($(obj));
                            _checCount();
                        });
                    }
                    function _add(obj){
                        var trobj=min.getObj($(obj).parents('tr').data('info'));
                        $.ajax({
                            url: '/view/home/addcartnum',
                            data: {
                                id:trobj.cartid,
                                _token: "{{csrf_token()}}"
                            },
                            type: 'post',
                            dataType: 'json',
                            async:false,
                            success: function (data) {
                                if(data.status === 1){
                                    var redobj = $(obj).parents('tr').find('.red');
                                    var shulobj = $(obj).parents('tr').find('.shul');
                                    shulobj.val(parseInt(shulobj.val()) +1);
                                    redobj.text( parseInt(trobj.price) * shulobj.val() );
                                    _check($(obj).parents('tr').find('.checke'));
                                    _check($(obj).parents('tr').find('.checke'));
                                    _checCount();
                                }
                            }
                        });
                    }
                    function _sub(obj){
                        var trobj=min.getObj($(obj).parents('tr').data('info'));
                        $.ajax({
                            url: '/view/home/subcartnum',
                            data: {
                                id:trobj.cartid,
                                _token: "{{csrf_token()}}"
                            },
                            type: 'post',
                            dataType: 'json',
                            async:false,
                            success: function (data) {
                                if(data.status === 1){
                                    var redobj = $(obj).parents('tr').find('.red');
                                    var shulobj = $(obj).parents('tr').find('.shul');
                                    //数量不能为0
                                    if(parseInt(parseInt(shulobj.val()) -1) < 1 ){
                                        return;
                                    }
                                    shulobj.val(parseInt(shulobj.val()) -1);
                                    redobj.text( parseInt(trobj.price) * shulobj.val() );
                                    _check($(obj).parents('tr').find('.checke'));
                                    _check($(obj).parents('tr').find('.checke'));
                                    _checCount();
                                }
                            }
                        });

                    }
                    function _checCount(){
                        num=0;
                        goodsnum =0;
                        $('.checke').each(function(i,obj){
                            var trobj=min.getObj($(obj).parents('tr').data('info'));
                            if($(obj).attr('data-check') === '1'){
                                num += trobj.price* $(obj).parents('tr').find('.shul').val();
                                goodsnum +=1;
                            }
                            $('.pc-shop-shu').html(goodsnum);
                            $('.pricenum').html('￥'+(num));
                        });
                    }
                    function _check(obj){
                        if(obj.attr('data-check') === '1'){
                            obj.attr('data-check',0);
                            $(obj).removeAttr('checked');
                        }else{
                            obj.attr('data-check',1);
                            $(obj).prop('checked','checked');
                        }

                    }
                </script>
            @endif

            <script>
                //付款
                function _pay(obj){
                    if( parseInt($('.pc-shop-shu').text()) < 1 ){
                        layer.open({
                            title: '提示',
                            shadeClose:true,//点击遮罩关闭
                            content: '没有先择商品',
                            yes:function(){
                                layer.closeAll();
                            },
                            cancel: function(){
                            }
                        });
                    }else{
                        var goodss = '';
                        $('.checke[data-check="1"]').each(function(i,obj){
                            var trobj=min.getObj($(obj).parents('tr').data('info'));
                            var shulobj = $(obj).parents('tr').find('.shul');
                            goodss+=trobj.id+':'+shulobj.val()+',';
                        });
                        $.ajax({
                            url: '/view/home/addorders',
                            data: {
                                goodsids:goodss,
                                _token: "{{csrf_token()}}"
                            },
                            type: 'post',
                            dataType: 'json',
                            async:false,
                            success: function (data) {
                                if(data.status === 1){
                                    layer.open({
                                        title: '提示',
                                        shadeClose:true,//点击遮罩关闭
                                        content: data.message,
                                        yes:function(){
                                            layer.closeAll();
                                            // window.location.href='/admin/goods/goods/index';
                                        },
                                        cancel: function(){
                                            //右上角关闭回调
                                            // window.location.href='/admin/goods/goods/index';
                                        }
                                    });
                                }else if(data.status === 3){
                                    layer.open({
                                        title: '提示',
                                        shadeClose:true,//点击遮罩关闭
                                        content: data.message,
                                        yes:function(){
                                            layer.closeAll();
                                             window.location.href=data.returnurl;
                                        },
                                        cancel: function(){
                                            //右上角关闭回调
                                            window.location.href=data.returnurl;
                                        }
                                    });
                                }
                            }
                        });
                    }
                }

                //没登录时删除购物车
                _delete1=function(obj){
                    console.log($(obj).html());
                    console.log( $(obj).parents('tr').remove() );
                }
            </script>
        </div>
    </section>
@endsection
@section('script')
@endsection