@extends('admin.master.master')
@section('title',"日志列表 ")
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


    <hr>
    <div class="portlet box green" data='cc' id="g1">

        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-globe"></i>商品
            </div>
            <div style="display: inline-block;position:relative;left:10px;top:5px;">
                <select style="width:120px;" id="select2-single-input-sm" class="form-control input-sm select2-multiple select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                    <option value="AK">过滤条件</option>
                    <option value="HI">审核通过的</option>
                </select>
            </div>
            <div class="tools"></div>

        </div>
        <div class="portlet-body">
            <table class="table table-striped table-bordered table-hover" id="sample_1">
                <thead>
                <tr class="odd">
                    <th style="text-align: center">id</th>
                    <th style="text-align: center">图片</th>
                    <th style="text-align: center">商家</th>
                    <th style="text-align: center">名称</th>
                    <th style="text-align: center">类型</th>
                    <th style="text-align: center">价格</th>
                    <th style="text-align: center">排序</th>
                    <th style="text-align: center">是否上架</th>
                    <th style="text-align: center">是否热销</th>
                    <th style="text-align: center">操作</th>

                </tr>
                </thead>
                <tbody>



                </tbody>
            </table>
            </table>

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








