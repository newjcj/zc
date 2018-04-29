@extends('admin.master.master')
@section('title',"后台")
@section('plugin_css')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="/admin/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>
    <link href="/admin/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet"
          type="text/css"/>
    <link href="/admin/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet"
          type="text/css"/>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- date-->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="/admin/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="/admin/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="/admin/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="/admin/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"
          rel="stylesheet" type="text/css"/>
    <link href="/admin/assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- date-->

@endsection


@section('content')
    <div style="margin:0 auto;width:100%,height:30px;">
        <a href="/admin/goods/goods/add">
            <button type="button" class="btn btn-primary">添加项目</button>
        </a>
        @if(\App\models\User::getUser()->can('admin'))
        <form style="display:none" action="/admin/goods/goods/index" id="upform" method="get" class="form-horizontal form-bordered" enctype="multipart/form-data">
            <div>
            <select class="form-control input-small" id="shopid" name="shopid"  style="float: left; margin-left: 1400px;">
            <option value="">-----选择商家-----</option>
            @if(count($shop))
                @foreach($shop as $item)
                    @if($shopid && $shopid==$item->id)
                    <option selected="selected" value="{{$item->id}}" {{$item->id==$shopid ? 'selected' : ''}}>{{$item->name}}</option>
                        @else
                            <option value="{{$item->id}}" {{$item->id==$shopid ? 'selected' : ''}}>{{$item->name}}</option>
                        @endif
                @endforeach
            @endif
            </select>
            <input type="hidden" name="_token" value="{{csrf_token()}}">&nbsp;&nbsp;&nbsp;
            </div>
        </form>
    @endif
    </div>

    <hr>
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-cogs"></i>项目列表 </div>
            <div class="tools">
                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
            </div>
        </div>
        <div class="portlet-body flip-scroll">
            <table class="table table-bordered table-striped table-condensed flip-content">
                <thead>
                <tr class="odd">
                    <th style="text-align: center">id</th>
                    {{--<th style="text-align: center">图片</th>--}}
                    {{--<th style="text-align: center">商家</th>--}}
                    <th style="text-align: center">名称</th>
                    {{--<th style="text-align: center">类型</th>--}}
                    <th style="text-align: center">价格</th>
                    {{--<th style="text-align: center;">成本价</th>--}}
                    <th style="text-align: center;">最少众筹金额</th>
                    {{--<th style="text-align: center">排序</th>--}}
                    {{--<th style="text-align: center">是否上架</th>--}}
                    {{--<th style="text-align: center">是否热销</th>--}}
                    <th style="text-align: center">操作</th>
                </tr>
                </thead>
                <tbody>
                @if(count($goodss))
                    @foreach($goodss as $item)
                        <tr style="text-align: center">
                            <td class="gain">{{$item->id}}</td>
                            <?php $img=explode(',',($item->goodsimage)[0]->image);?>
                            <td style="display:none"><img src="<?php echo count($item->goodsimage)?$img[0]:'';?>" alt="" style="width:60px;"></td>
                            <td style="display:none">{{$item->shop?$item->shop->name:''}}</td>
                            <td style="text-align:left">{{$item->name}}</td>
                            @if($item->gift_lv)
                                <td style="display:none">{{'礼包'.$item->gift_lv.'级'}}</td>
                            @else
                                <td style="display:none">{{'普通商品'}}</td>
                            @endif
                            <td>{{$item->price/100}}</td>
                            <td style="display:none" data-id="{{$item->id}}" data-price="{{$item->price/100}}"><input style="width:70px;" class="base_price"   type="number" value="{{$item->base_price/100}}"></td>
                            <td data-gain="{{$item->id}}"><input style=" width:70px;" disabled id="gain{{$item->id}}" class="gain_price"  type="number" value="{{$item->gain_price/100}}"></td>
                            <td style="display:none">{{$item->hot}}</td>
                            <td style="display:none"> {{$item->is_ground==1 ? '上架' : '下架'}}</td>
                            <td style="display:none">{{ $item->is_hot==1 ? '热销' : '非热销' }}</td>
                            <td style="text-align: center">
                                <button type="button" class="btn btn-primary" onclick="location.href='/admin/goods/goods/edit?id={{$item->id}}'">编辑</button>
                                <button type="button" class="btn btn-primary" onclick="location.href='/admin/goods/goods/detail?id={{$item->id}}'">项目详情</button>
                                <button type="button" class="btn btn-primary" onclick="_payback({{$item->id}})">标识全体会员发放回报</button>
                                <button type="button" class="btn btn-danger" onclick="_delete({{$item->id}})">删除</button>
                            </td>
                        </tr>
                    @endforeach
                @endif


                </tbody>
            </table>

        </div>
        <div style="float:right;margin-top:20px;padding-top:12px;margin-bottom:12px;">
            {!! $goodss->appends(['shopid' => $shopid])->links() !!}
        </div>
    </div>



    <script>

        function _delete(id) {
            Ajax('JSON').post('/admin/goods/goods/delete', {
                id: id,
                _token: "{{csrf_token()}}"
            }, function (data) {
                var msg=(data);
                if(msg.status !== 1){
                    layer.open({
                        title: '提示'
                        ,content: msg.message,
                        yes:function(){
                            window.location.href='/admin/goods/goods/index';
                        },
                        cancel: function(){
                            //右上角关闭回调
                            window.location.href='/admin/goods/goods/index';
                        }
                    });
                }else{
                    layer.open({
                        title: '提示'
                        ,content: msg.message,
                        yes:function(){
                            window.location.href='/admin/goods/goods/index';
                        },
                        cancel: function(){
                            //右上角关闭回调
                            window.location.href='/admin/goods/goods/index';
                        }
                    });
                }
            });
        };
        function _payback(id) {
            Ajax('JSON').post('/admin/goods/goods/allpay', {
                goodsid: id,
                _token: "{{csrf_token()}}"
            }, function (data) {
                var msg=(data);
                if(msg.status !== 1){
                    layer.open({
                        title: '提示'
                        ,content: msg.message,
                        yes:function(){
                            window.location.href='/admin/goods/goods/index';
                        },
                        cancel: function(){
                            //右上角关闭回调
                            window.location.href='/admin/goods/goods/index';
                        }
                    });
                }else{
                    layer.open({
                        title: '提示'
                        ,content: msg.message,
                        yes:function(){
                            window.location.href='/admin/goods/goods/index';
                        },
                        cancel: function(){
                            //右上角关闭回调
                            window.location.href='/admin/goods/goods/index';
                        }
                    });
                }
            });
        }
        $('#shopid').change(function(){
            window.location.href='/admin/goods/goods/index?shopid='+$(this).val();
        });
        //赚取金额设置
        $('.base_price').blur(function(){
            var idname='gain'+$(this).parent().data('id');
            var gain_price=$('#'+idname);
            var base_price=$(this);
            //gain_price取值
            var g_price=function(){
                if( base_price.val() > (base_price.parent().data('price')/2) ){
                    return Math.floor( (base_price.parent().data('price')-base_price.val())/3*100 )/100;
                }else{
                    return Math.floor( (base_price.parent().data('price')-base_price.val())/4*100 )/100;
                }
            }(base_price);
            gain_price.val(g_price);
            $.ajax({
                url: '/admin/goods/goods/savebaseprice',
                data: {
                    id:gain_price.parent().data('gain'),
                    gain_price:gain_price.val(),
                    base_price:base_price.val(),
                    _token: "{{csrf_token()}}"
                },
                type: 'post',
                dataType: 'json',
                async:false,
                success: function (data) {
                    if(data.status){
                        layer.msg('保存成功');
                    }
                }
            });
        });
        //赚取金额设置
        $('.gain_price').blur(function(){
            var gainobj=$(this);
            $.ajax({
                url: '/admin/goods/goods/savegainprice',
                data: {
                    id:gainobj.parent().data('gain'),
                    gain_price:gainobj.val(),
                    _token: "{{csrf_token()}}"
                },
                type: 'post',
                dataType: 'json',
                async:false,
                success: function (data) {
                    if(data.status){
                        layer.msg('保存成功');
                    }
                }
            });
        });
    </script>
@endsection



@section('page_plugins_js')

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="/admin/assets/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"
            type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"
            type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="/admin/assets/global/plugins/moment.min.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js"
            type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"
            type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"
            type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"
            type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- date -->
    <script src="/admin/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js"
            type="text/javascript"></script>
    <!-- date -->
@endsection



@section('page_scripts_js')

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="/admin/assets/pages/scripts/table-datatables-colreorder.min.js" type="text/javascript"></script>
    <script src="/admin/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
@endsection








