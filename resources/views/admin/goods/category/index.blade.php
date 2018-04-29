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
    <div style="margin:0 auto;widht:100%,height:30px;">
        <a href="/admin/goods/category/add">
            <button type="button" class="btn btn-primary">添加分类</button>
        </a>
    </div>

    <hr>
    <div class="portlet box green" data='cc' id="g1">

        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-globe"></i>商品
            </div>
            <div class="tools"></div>

        </div>
        <div class="portlet-body">
            <table class="table table-striped table-bordered table-hover" id="sample_1">
                <thead>
                <tr class="odd">
                    <th style="text-align: center">列表</th>
                    <th style="text-align: center">图片</th>
                    <th style="text-align: center">分类名</th>
                    <th style="text-align: center"> 操作</th>

                </tr>
                </thead>
                <tbody>
                <?php $i=1;?>
                @foreach($categorys as $item)
                    <tr style="text-align: center">
                        <td>{{ $i }}</td>
                        <td><img src="{{ $item->image ?:'' }}" alt="" style="width:60px;"/></td>
                        <?php $color=["#FF69B4",'#800080','#aaa','#0000FF','#1E90FF','#2F4F4F'];?>
                        <?php $num = count(explode('-',$item->orderpath))-2;?>
                        <td style="text-align:left;color:<?php echo $color[$num];?>;"><?php echo str_repeat('.......',$num);?>{{$item->name}}</td>
                        <td style="text-align: center">
                            <button type="button" class="btn btn-primary" onclick="location.href='/admin/goods/category/edit?id={{$item->id}}'">编辑</button>
                            <button type="button" class="btn btn-danger" onclick="_delete({{$item->id}})">删除</button>

                        </td>
                    </tr>
                    <?php $i++;?>
                @endforeach


                </tbody>
            </table>
            </table>

        </div>
    </div>



    <script>
        function _delete(id) {
            Ajax('JSON').post('/admin/goods/category/delete', {
                id: id,
                _token: "{{csrf_token()}}"
            }, function (data) {
                var msg = (data);
                if (msg.status !== 1) {
                    layer.open({
                        title: '提示'
                        , content: msg.message,
                        yes: function () {
                            window.location.href = '/admin/goods/category/index';
                        },
                        cancel: function () {
                            //右上角关闭回调
                            window.location.href = '/admin/goods/category/index';
                        }
                    });
                } else {
                    layer.open({
                        title: '提示'
                        , content: msg.message,
                        yes: function () {
                            window.location.href = '/admin/goods/category/index';
                        },
                        cancel: function () {
                            //右上角关闭回调
                            window.location.href = '/admin/goods/category/index';
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






