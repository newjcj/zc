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
                <i class="fa fa-globe"></i>已办供应商信息
            </div>
            <div class="tools"></div>

        </div>
        <div class="portlet-body">
            <table class="table table-striped table-bordered table-hover" id="sample_1">
                <thead>
                <tr class="odd">
                    <th style="text-align: center">id</th>
                    <th style="text-align: center">商家</th>
                    <th style="text-align: center">身份证正面</th>
                    <th style="text-align: center">身份证反面</th>
                    <th style="text-align: center">营业执照</th>
                    <th style="text-align: center">身份证号码</th>
                    <th style="text-align: center">开店时间</th>
                    <th style="text-align: center">店铺详细地址</th>
                    <th style="text-align: center">所在地区</th>
                    <th style="text-align: center">审核状态</th>
                    <th style="text-align: center">操作</th>

                </tr>
                </thead>
                <tbody>
                @if(count($shop)>0)
                    @foreach($shop as $item)
                        <tr style="text-align: center">
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td><img src="{{$item->card_image1}}" alt="" style="width:60px;"></td>
                            <td><img src="{{$item->card_image2}}" alt="" style="width:60px;"></td>
                            <td><img src="{{$item->licence_image}}" alt="" style="width:60px;"></td>
                            <td>{{$item->card_number}}</td>
                            <td>{{$item->start_time}}</td>
                            <td>{{$item->address}}</td>
                            <td>{{$item->region_id}}</td>
                            <td>
                                审核通过
                            </td>
                            <td style="text-align: center">
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


    <script>



        function _delete(id) {
            Ajax('JSON').post('/admin/shop/shop/delete', {
                id: id,
                _token: "{{csrf_token()}}"
            }, function (data) {
                var msg=(data);
                if(msg.status !== 1){
                    layer.open({
                        title: '提示'
                        ,content: msg.message,
                        yes:function(){
                            window.location.href='/admin/shop/shop/index';
                        },
                        cancel: function(){
                            //右上角关闭回调
                            window.location.href='/admin/shop/shop/index';
                        }
                    });
                }else{
                    layer.open({
                        title: '提示'
                        ,content: msg.message,
                        yes:function(){
                            window.location.href='/admin/shop/shop/index';
                        },
                        cancel: function(){
                            //右上角关闭回调
                            window.location.href='/admin/shop/shop/index';
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
    {{--<script src="/admin/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>--}}
    {{--<script src="/admin/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"--}}
            {{--type="text/javascript"></script>--}}
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






