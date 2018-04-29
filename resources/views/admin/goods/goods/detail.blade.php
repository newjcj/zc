@extends('admin.master.master')
@section('title',"项目详情")
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
                <i class="fa fa-cogs"></i>项目详情</div>
            <div class="tools">
                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
            </div>
        </div>
        <div class="portlet-body">
            <table class="table table-striped table-bordered table-hover" id="sample_1">
                <thead>
                <tr class="odd" >
                    <th style="text-align: center">用户id</th>
                    <th style="text-align: center">用户名</th>
                    <th style="text-align: center">电话</th>
                    <th style="text-align: center">购买的价格</th>
                    <th style="text-align: center">购买的btc价格</th>
                    <th style="text-align: center">购买时间</th>
                    <th style="text-align: center">回报状态</th>
                    <th style="text-align: center">操作</th>
                </tr>
                </thead>
                <tbody>


                @if(count($users))
                    @foreach($users as $item)
                        <tr style="text-align: center">
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->phone}}</td>
                            <td>{{$item->pivot->price}}</td>
                            <td>{{$item->pivot->btcprice}}</td>
                            <td>{{$item->pivot->created_at}}</td>
                            <td>
                                @if($item->pivot->payback == 1)
                                    <button class="btn btn-primary">已回报</button>
                                    @else
                                    <button class="btn btn-primary">未回报</button>
                                @endif
                            </td>
                            <td>
                                @if($item->pivot->payback == 1)
                                @else
                                    <button class="btn btn-primary" onclick="_payback({{$item->id}},{{$goodsid}})">设置为回报</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif

                </tbody>
            </table>
            </table>
        </div>
    </div>



    <script>
        function _payback(userid,goodsid) {
            Ajax('JSON').post('/admin/goods/goods/payback', {
                userid: userid,
                goodsid: goodsid,
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








