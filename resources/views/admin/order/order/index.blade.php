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
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="/admin/assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css" />
    <link href="/admin/assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
@endsection


@section('content')

    <div class="portlet box green" data='cc' id="g1">

        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-globe"></i>订单信息
            </div>
            <div class="tools"></div>

        </div>
        <div class="portlet-body">
            <table class="table table-striped table-bordered table-hover" id="sample_1">
                <thead>
                <tr class="odd">
                    <th style="text-align: center">消费者</th>
                    <th style="text-align: center">订单号</th>
                    <th style="text-align: center">快递单号</th>
                    <th style="text-align: center">国内承运人</th>
                    <th style="text-align: center">订单状态</th>
                    <th style="text-align: center">付款银行卡</th>
                    <th style="text-align: center">操作</th>
                </tr>
                </thead>
                <tbody>
                @if($order)
                    @foreach($order as $item)
                        <tr style="text-align: center">
                            <td style="text-align: center">{{$item->user->name}}</td>
                            <td style="text-align: center"><a data-toggle="modal" onclick="loop({{$item->id}});"  >{{$item->orderuuid}}</a></td>
                            <td style="text-align: center"><input id="express_{{$item->id}}" disabled="disabled" value="{{$item->express}}"></td>
                            <td style="text-align: center">
                                <select style="text-align: center" class="form-control input-small" id="kname_{{$item->id}}" name="kname" disabled="disabled">
                                    @if(count($express))
                                        @foreach($express as $exp)
                                            <option value="{{$exp->id}}" {{$exp->id==$item->express_id ? 'selected' : ''}}>{{$exp->kname}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </td>
                            <td style="text-align: center">
                                <select style="text-align: center" class="form-control input-small" id="status_{{$item->id}}" name="status" disabled="disabled">
                                    <option value="0" {{$item->status==0 ? 'selected' : ''}}>待付款</option>
                                    <option value="1" {{$item->status==1 ? 'selected' : ''}}>待发货</option>
                                    <option value="2" {{$item->status==2 ? 'selected' : ''}}>发货中</option>
                                    <option value="3" {{$item->status==3 ? 'selected' : ''}}>已签收</option>
                                    <option value="4" {{$item->status==4 ? 'selected' : ''}}>确认收货</option>
                                </select>
                            </td>
                            <td style="text-align: center">{{$item->user->cardid}}</td>
                            <td style="text-align: center">
                                <input type="button" id="bt_{{$item->id}}" class="btn btn-primary" value="编辑" onclick="show({{$item->id}})">
                                <button type="button" class="btn btn-danger" onclick="_delete({{$item->id}})">删除</button>
                            </td>
                        </tr>
                    @endforeach
                @endif


                </tbody>
            </table>
            </table>

        </div>
    </div>

    <div id="responsive" class="modal fade in" tabindex="-1" data-width="760" aria-hidden="true" style="display: none; width: 600px; margin-left: -379px; margin-top: -289px;">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">订单详情</h4>
        </div>
        <div class="modal-body" id="alldiv">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-striped table-bordered table-hover" id="sample_1" style=" width: 560px;">
                        <thead>
                        <tr class="odd1">
                            <th style="text-align: center">商品名称</th>
                            <th style="text-align: center">商品数量</th>
                            <th style="text-align: center">商品单价</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            总价：<span id="total"></span>&nbsp;元
        </div>
        <div class="modal-footer">
            <p align="center"><button type="button" data-dismiss="modal" class="btn btn-outline dark">关&nbsp;&nbsp;闭</button></p>
        </div>
    </div>

    <script id="t:_1234-abcd-1" type="text/html">
        <%for(var i=0 ;i<data.length; i++){%>
        <tr class="odd2">
            <td style="text-align: center"><%=data[i].name %></td>
            <td style="text-align: center"><%=data[i].pivot.num %></td>
            <td style="text-align: center"><%=data[i].price %></td>
        </tr>
        <%}%>
    </script>

    <script>
        var bt=baidu.template;
        function  loop(id) {
            $.ajax({
                    url: '/admin/order/order/ordergoods',
                    data: {
                        id:id,
                        _token: "{{csrf_token()}}"
                    },
                    type: 'post',
                    dataType: 'json',
                    async:false,
                    success: function (data) {
                        console.log(data.data[0].price);
                        var price=0;
                               $(data.data).each(function(i,obj){
                                    price += parseInt(obj.pivot.num * obj.price);
                               });
                               $('#total').html(price);

                        $('.odd2').remove();
                       $('.odd1').after(bt('t:_1234-abcd-1',{data:data.data}));
                         $('#responsive').modal(function(){

                         });
                    }
                });

        }

        function  show(id) {
            if($("#bt_"+id).val()=="编辑"){
                $("#bt_"+id).val("完成");
                $("#bt_"+id).css("color","red");
                $('#express_'+id).removeAttr("disabled");
                $('#status_'+id).removeAttr("disabled");
                $('#kname_'+id).removeAttr("disabled");
            }else{
                $("#bt_"+id).val("编辑");
                $("#bt_"+id).css("color","white");
                Ajax('JSON').post('/admin/order/order/index', {
                    id: id,
                    knameid: $('#kname_'+id).val(),
                    express: $('#express_'+id).val(),
                    status: $("#status_"+id).val(),
                    _token: "{{csrf_token()}}"
                }, function (data) {
                    var msg = (data);
                    if (msg.status !== 1) {
                        layer.open({
                            title: '提示'
                            , content: msg.message,
                            yes: function () {
                                window.location.href = msg.returnurl;
                            },
                            cancel: function () {
                                //右上角关闭回调
                                window.location.href = msg.returnurl;
                            }
                        });
                    } else {
                        layer.open({
                            title: '提示'
                            , content: msg.message,
                            yes: function () {
                                window.location.href = msg.returnurl;
                            },
                            cancel: function () {
                                //右上角关闭回调
                                window.location.href = msg.returnurl;
                            }
                        });
                    }
                });
                $('#express_'+id).attr("disabled","disabled");
                $('#status_'+id).attr("disabled","disabled");
                $('#kname_'+id).attr("disabled","disabled");
            }
        }

        function _delete(id) {
            Ajax('JSON').post('/admin/order/order/delete', {
                id: id,
                _token: "{{csrf_token()}}"
            }, function (data) {
                var msg = (data);
                if (msg.status !== 1) {
                    layer.open({
                        title: '提示'
                        , content: msg.message,
                        yes: function () {
                            window.location.href = msg.returnurl;
                        },
                        cancel: function () {
                            //右上角关闭回调
                            window.location.href = msg.returnurl;
                        }
                    });
                } else {
                    layer.open({
                        title: '提示'
                        , content: msg.message,
                        yes: function () {
                            window.location.href = msg.returnurl;
                        },
                        cancel: function () {
                            //右上角关闭回调
                            window.location.href = msg.returnurl;
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






