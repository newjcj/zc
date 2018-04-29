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
    <div class="portlet box green" data='cc' id="g1">

        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-globe"></i>会员
            </div>
            <div class="tools"></div>

        </div>
        <div class="portlet-body">
            <table class="table table-striped table-bordered table-hover" id="sample_1">
                <thead>
                <tr class="odd">
                    <th style="text-align: center">姓名</th>
                    <th style="text-align: center">电话</th>
                    <th style="text-align: center">身份证号码</th>
                    <th style="text-align: center">身份证正面</th>
                    <th style="text-align: center">身份证反面</th>
                    <th style="text-align: center" >银行名称</th>
                    <th style="text-align: center" >银行卡号码</th>
                    <th style="text-align: center">审核状态</th>
                </tr>
                </thead>
                <tbody>
                @if($user)
                    @foreach($user as $item)
                        <tr style="text-align: center">
                            <td>{{$item->name}}</td>
                            <td>{{$item->phone}}</td>
                            <td>{{$item->cardid}}</td>
                            <td>{{$item->cardimage1}}</td>
                            <td>{{$item->cardimage2}}</td>
                            <td>{{count($item->userbank) ? $item->userbank[0]->bankname :'' }}</td>
                            <td>
                                {{count($item->userbank) ? $item->userbank[0]->banknumber :'' }}
                            </td>
                            <td>
                                 审核通过
                            </td>

                        </tr>
                    @endforeach
                @endif


                </tbody>
            </table>


        </div>
    </div>



    <script>

        function _change(id){
            var regionid = "regionid_"+id;
            Ajax('JSON').post('/admin/user/user/index1', {
                id: id,
                regionid:$("#"+regionid).val(),
                _token: "{{csrf_token()}}"
            }, function (data) {
                var msg=(data);
                if(msg.status !== 1){
                    layer.open({
                        title: '提示'
                        ,content: msg.message,
                        yes:function(){
                            window.location.href='/admin/user/user/index1';
                        },
                        cancel: function(){
                            //右上角关闭回调
                            window.location.href='/admin/user/user/index1';
                        }
                    });
                }else{
                    layer.open({
                        title: '提示'
                        ,content: msg.message,
                        yes:function(){
                            window.location.href='/admin/user/user/index1';
                        },
                        cancel: function(){
                            //右上角关闭回调
                            window.location.href='/user/user/user/index1';
                        }
                    });
                }
            });
        }

        function _delete(id) {
            Ajax('JSON').post('/admin/user/user/delete', {
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






