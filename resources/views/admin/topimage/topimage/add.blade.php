@extends('admin.master.master')
@section('title',"后台")
@section('plugin_css')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="/admin/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="/admin/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="/admin/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- date-->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="/admin/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="/admin/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <link href="/admin/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="/admin/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="/admin/assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- date-->

@endsection


@section('content')

    <!-- BEGIN PAGE TITLE-->
    {{--<h3 class="page-title"> 添加商品--}}
    {{--<small></small>--}}
    {{--</h3>--}}
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <div class="tabbable-line boxless tabbable-reversed">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#tab_0" data-toggle="tab"> 广告图片信息 </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_0">
                        <div class="portlet box green">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>添加商品 </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"> </a>
                                    <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                    <a href="javascript:;" class="reload"> </a>
                                    <a href="javascript:;" class="remove"> </a>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                                <form action="javascript:;" id="upform" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
                                    <div class="form-body">
                                        {{--<h3 class="form-section">Person Info</h3>--}}
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">名称</label>
                                            <div class="col-sm-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-check"></i>
                                                    </span>
                                                    <input value="" type="text" name="name" class="form-control" datatype="/.*/"> </div>
                                                <p class="help-block"> </p>
                                                <input type="hidden" value="{{csrf_token()}}" name="_token">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">图片</label>
                                            <div class="col-md-3" >
                                                <div class="formControls col-5" style="float:left">
                                                    <img id="preview_id1" src="/admin/images/icon-add.png" style="border: 1px solid #B8B9B9; width: 100px; height: 100px;" onclick="$('#input_id1').click()" />
                                                    <input type="file" name="file" id="input_id1" style="display: none;" onchange="return uploadImageToServer('input_id1','images', 'preview_id1');" />
                                                    <p class="help-block"> </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">开始时间</label>
                                            <div class="col-md-3">
                                                <input class="form-control form-control-inline input-medium date-picker" size="16" type="text" value="" name="start" id="start"  />
                                                <p class="help-block"> </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">结束时间</label>
                                            <div class="col-md-3">
                                                <input class="form-control form-control-inline input-medium date-picker" size="16" type="text" value="" name="end"  />
                                                <p class="help-block"> </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">链接url</label>
                                            <div class="col-md-3">
                                                <dl class="clearfix">
                                                    <div><input type="text" class="form-control input-xlarge" placeholder="" name="url"  value=""></div>
                                                    <p class="help-block"> </p>
                                                </dl>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <button type="submit" class="btn green" id="keep">保存</button>
                                                        {{--<button type="button" class="btn default">Cancel</button>--}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6"> </div>
                                        </div>
                                    </div>

                                <!-- END FORM-->
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $("#upform").Validform({
            tiptype:2,
            callback:function(){
                Ajax('JSON').post('/admin/topimage/topimage/add',{
                    name:$('input[name="name"]').val(),
                    start:$('input[name="start"]').val(),
                    end:$('input[name="end"]').val(),
                    preview1:($('#preview_id1').attr('src')!='/admin/images/icon-add.png'?$('#preview_id1').attr('src'):''),
                    url:$('input[name="url"]').val(),
                    _token: "{{csrf_token()}}"
                },function(data){
                    var msg=(data);
                    if(msg.status !== 1){
                        layer.open({
                           title: '提示'
                           ,content: msg.message,
                           yes:function(){
                               window.location.href='/admin/topimage/topimage/index';
                           }
                        });
                    }else{
                        layer.open({
                            title: '提示'
                            ,content: msg.message,
                            yes:function(){
                                window.location.href='/admin/topimage/topimage/index';
                            }
                        });
                    }
                });
            }
        });
    </script>
@endsection
@section('page_plugins_js')

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="/admin/assets/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="/admin/assets/global/plugins/moment.min.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="/admin/assets/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- date -->
    <script src="/admin/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
    <!-- date -->
@endsection



@section('page_scripts_js')

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="/admin/assets/pages/scripts/table-datatables-colreorder.min.js" type="text/javascript"></script>
    <script src="/admin/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
    <script src="/service/uploadFile.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
@endsection


<script>


</script>





