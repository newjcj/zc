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

    <div class="row">
        <div class="col-md-12">
            <div class="portlet light form-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-social-dribbble font-dark"></i>
                        <span class="caption-subject font-dark bold uppercase">添加商品</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                            <i class="icon-cloud-upload"></i>
                        </a>
                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                            <i class="icon-wrench"></i>
                        </a>
                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                            <i class="icon-trash"></i>
                        </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form action="javascript:;" id="upform" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">名称</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-check"></i>
                                                    </span>
                                    <input value="" type="text" name="name" class="form-control" datatype="/^[\s\S]{1,55}$/"> </div>
                                <p class="help-block"> </p>
                                <input type="hidden" value="{{csrf_token()}}" name="_token">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">商品描述</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-check"></i>
                                                    </span>
                                    <input value="" type="text" name="describe" class="form-control" datatype="/^[\s\S]{1,55}$/"> </div>
                                <p class="help-block"> </p>
                                <input type="hidden" value="{{csrf_token()}}" name="_token">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">设置默认夜用数量</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-check"></i>
                                                    </span>
                                    <input value="" type="number" name="one" class="form-control" datatype="/\d{1,2}/"> </div>
                                <p class="help-block"> </p>
                                <input type="hidden" value="{{csrf_token()}}" name="_token">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">设置默认日用数量</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-check"></i>
                                                    </span>
                                    <input value="" type="number" name="two" class="form-control" datatype="/\d{1,2}/"> </div>
                                <p class="help-block"> </p>
                                <input type="hidden" value="{{csrf_token()}}" name="_token">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">设置默认大号数量</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-check"></i>
                                                    </span>
                                    <input value="" type="number" name="three" class="form-control" datatype="/\d{1,2}/"> </div>
                                <p class="help-block"> </p>
                                <input type="hidden" value="{{csrf_token()}}" name="_token">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">设置默认护垫数量</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-check"></i>
                                                    </span>
                                    <input value="" type="number" name="four" class="form-control" datatype="/\d{1,2}/"> </div>
                                <p class="help-block"> </p>
                                <input type="hidden" value="{{csrf_token()}}" name="_token">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">价格</label>
                            <div class="col-md-5">
                                <dl class="clearfix">
                                    <div><input type="text" class="form-control input-xlarge" placeholder="" name="price" datatype="/^[1-9]{1,3}([.]{0,1}[0-9]{1,2}){0,1}$/" value=""></div>
                                    <p class="help-block"> </p>
                                </dl>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">购物返现金额</label>
                            <div class="col-md-5">
                                <dl class="clearfix">
                                    <div><input type="text" class="form-control input-xlarge" placeholder="" name="back_price" datatype="/^\d{0,5}$/" value=""></div>
                                    <p class="help-block"> </p>
                                </dl>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">购物返现时间（天）</label>
                            <div class="col-md-5">
                                <dl class="clearfix">
                                    <div><input type="text" class="form-control input-xlarge" placeholder="" name="back_day" datatype="/^\d{0,5}$/" value=""></div>
                                    <p class="help-block"> </p>
                                </dl>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">推广返现金额</label>
                            <div class="col-md-5">
                                <dl class="clearfix">
                                    <div><input type="text" class="form-control input-xlarge" placeholder="" name="spread_price" datatype="/^\d{0,5}$/" value=""></div>
                                    <p class="help-block"> </p>
                                </dl>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">图片</label>
                            <div class="col-md-5" >
                                <div class="formControls col-5" style="float:left">
                                    <img id="preview_id1" src="/admin/images/icon-add.png" style="border: 1px solid #B8B9B9; width: 100px; height: 100px;" onclick="$('#input_id1').click()" />
                                    <input type="file" name="file" id="input_id1" style="display: none;" onchange="return uploadImageToServer('input_id1','images', 'preview_id1');" />
                                </div>
                                <div class="formControls col-5" style="float:left">
                                    <img id="preview_id2" src="/admin/images/icon-add.png" style="border: 1px solid #B8B9B9; width: 100px; height: 100px;" onclick="$('#input_id2').click()" />
                                    <input type="file" name="file" id="input_id2" style="display: none;" onchange="return uploadImageToServer('input_id2','images', 'preview_id2');" />
                                </div>
                                <div class="formControls col-5" style="float:left">
                                    <img id="preview_id3" src="/admin/images/icon-add.png" style="border: 1px solid #B8B9B9; width: 100px; height: 100px;" onclick="$('#input_id3').click()" />
                                    <input type="file" name="file" id="input_id3" style="display: none;" onchange="return uploadImageToServer('input_id3','images', 'preview_id3');" />
                                </div>
                                <div class="formControls col-5" style="float:left">
                                    <img id="preview_id4" src="/admin/images/icon-add.png" style="border: 1px solid #B8B9B9; width: 100px; height: 100px;" onclick="$('#input_id4').click()" />
                                    <input type="file" name="file" id="input_id4" style="display: none;" onchange="return uploadImageToServer('input_id4','images', 'preview_id4');" />
                                </div>
                                <div class="formControls col-5" style="float:left">
                                    <img id="preview_id5" src="/admin/images/icon-add.png" style="border: 1px solid #B8B9B9; width: 100px; height: 100px;" onclick="$('#input_id5').click()" />
                                    <input type="file" name="file" id="input_id5" style="display: none;" onchange="return uploadImageToServer('input_id5','images', 'preview_id5');" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">内容</label>
                            <div class="col-md-5">
                                <!-- 加载编辑器的容器 -->
                                <script id="container" name="content" type="text/plain">

                                </script>
                                <!-- 配置文件 -->
                                <script type="text/javascript" src="/service/editor/ueditor.config.js"></script>
                                <!-- 编辑器源码文件 -->
                                <script type="text/javascript" src="/service/editor/ueditor.all.js"></script>
                                <!-- 实例化编辑器 -->
                                <script type="text/javascript">
                                    var ue = UE.getEditor('container');
                                </script>
                            </div>
                        </div>


                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn green">
                                        <i class="fa fa-check"></i> 提交</button>
                                    <!--                                <button type="button" class="btn btn-outline grey-salsa">Cancel</button>-->
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END PORTLET-->
        </div>

    </div>

    <script>
        $("#upform").Validform({
            tiptype:2,
            callback:function(){
                ue.ready(function() {
                    content = ue.getContent();
                });
                Ajax().post('/service/admin/goods/add',{
                    name:$('input[name="name"]').val(),
                    describe:$('input[name="describe"]').val(),
                    price:$('input[name="price"]').val(),
                    one:$('input[name="one"]').val(),
                    two:$('input[name="two"]').val(),
                    three:$('input[name="three"]').val(),
                    four:$('input[name="four"]').val(),
                    back_price:$('input[name="back_price"]').val(),
                    back_day:$('input[name="back_day"]').val(),
                    spread_price:$('input[name="spread_price"]').val(),
//                    starttime:$('input[name="starttime"]').val(),
//                    endtime:$('input[name="endtime"]').val(),
                    content:content,
                    preview1:($('#preview_id1').attr('src')!='/admin/images/icon-add.png'?$('#preview_id1').attr('src'):''),
                    preview2:($('#preview_id2').attr('src')!='/admin/images/icon-add.png'?$('#preview_id2').attr('src'):''),
                    preview3:($('#preview_id3').attr('src')!='/admin/images/icon-add.png'?$('#preview_id3').attr('src'):''),
                    preview4:($('#preview_id4').attr('src')!='/admin/images/icon-add.png'?$('#preview_id4').attr('src'):''),
                    preview5:($('#preview_id5').attr('src')!='/admin/images/icon-add.png'?$('#preview_id5').attr('src'):''),
                    _token: "{{csrf_token()}}"
                },function(data){
                    var msg=JSON.parse(data);
                    if(msg.status!=0){
                        location.reload();
                        return;
                    }else{
                        window.location.href="/admin/goods/index";
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





