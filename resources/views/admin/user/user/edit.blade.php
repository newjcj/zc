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
                        <a href="#tab_0" data-toggle="tab"> 会员信息 </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_0">
                        <div class="portlet box green">
                            <div class="portlet-title">
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
                                            <div class="item">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">姓名</label>
                                                    <div class="col-md-5">
                                                        <dl class="clearfix">
                                                            <div><input value="{{ $user->name ?$user->name:'' }}" type="text" class="form-control input-xlarge" placeholder="" name="name" datatype="/^[a-zA-Z\u4e00-\u9fa5]+$/"></div>
                                                            <p class="help-block"> </p>
                                                        </dl>
                                                    </div>
                                                </div>
                                        <div class="item">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">电话</label>
                                                <div class="col-md-5">
                                                    <dl class="clearfix">
                                                        <div><input value="{{ $user->phone ?$user->phone:'' }}" type="text" class="form-control input-xlarge" placeholder="" name="phone" datatype="/^1(3|4|5|7|8)\d{9}$/"></div>
                                                        <p class="help-block"> </p>
                                                    </dl>
                                                </div>
                                            </div>
                                        <div class="item">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">邮箱</label>
                                                <div class="col-md-5">
                                                    <dl class="clearfix">
                                                        <div><input value="{{ $user->email ?$user->email:'' }}" type="text" class="form-control input-xlarge" placeholder="" name="email" datatype="/^[a-z\d]+(\.[a-z\d]+)*@([\da-z](-[\da-z])?)+(\.{1,2}[a-z]+)+$/"></div>
                                                        <p class="help-block"> </p>
                                                    </dl>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">密码</label>
                                                <div class="col-md-5">
                                                    <dl class="clearfix">
                                                        <div><input value="{{ $user->password ?$user->password:'' }}" type="text" class="form-control input-xlarge" placeholder="" name="password" ></div>
                                                        <p class="help-block"> </p>
                                                    </dl>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">身份证号码</label>
                                                <div class="col-md-5">
                                                    <dl class="clearfix">
                                                        <div><input value="{{ $user->cardid ?$user->cardid:'' }}" type="text" class="form-control input-xlarge" placeholder="" name="cardid" datatype="/^[a-z0-9_-]{6,18}$/"></div>
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
                                                        <button type="submit" class="btn green">保存</button>
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

        var id={{ $user->id }}
        $("#upform").Validform({
            tiptype:2,
            callback:function(){
                Ajax('JSON').post('/admin/user/user/update',{
                    id:id,
                    name:$('input[name="name"]').val(),
                    phone:$('input[name="phone"]').val(),
                    email:$('input[name="email"]').val(),
                    password:$('input[name="password"]').val(),
                    cardid:$('input[name="cardid"]').val(),
                    _token: "{{csrf_token()}}"
                },function(data){
                    var msg=(data);
                    if(msg.status !== 1){
                        layer.open({
                            title: '提示'
                            ,content: msg.message
                        });
                    }else{
                        layer.open({
                            title: '提示'
                            ,content: msg.message,
                            yes:function(){
                                window.location.href='/admin/user/user/index';
                            }
                        });
                    }
                });
            }
        });
    </script>
    <script>
        var imgitem_pre=1;//图片id后缀
        //取一次item的图片
        function _getimgitem(){
            var imgitem = '';
            for(var i=0;i<5;i++){
                imgitem = '<div class="formControls col-5" style="float:left">'+
                    '<img id="preview_id'+imgitem_pre+'" src="/admin/images/icon-add.png" style="border: 1px solid #B8B9B9; width: 100px; height: 100px;" onclick="$(\'#input_id'+imgitem_pre+'\').click()" />'+
                    '<input type="file" name="file" id="input_id'+imgitem_pre+'" style="display: none;" onchange="return uploadImageToServer(\'input_id'+imgitem_pre+'\',\'images\', \'preview_id'+imgitem_pre+'\');" />'+
                    '</div>';
                imgitem_pre++;
            }
            return imgitem;
        }
        //取一次item
        function _getitem(){

        }

        function _additem(obj){
            $('.pitem').append('<div onclick="alert($(\'.pitem\').html())">111</div>');
        }
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





