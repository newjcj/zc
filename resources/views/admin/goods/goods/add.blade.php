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
                        <a href="#tab_0" data-toggle="tab"> 项目信息 </a>
                    </li>
                    <li>
                        <a href="#tab_1" data-toggle="tab">项目内容</a>
                    </li>
                    {{--<li>--}}
                        {{--<a href="#tab_2" data-toggle="tab">手机端商品图内容</a>--}}
                    {{--</li>--}}
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_0">
                        <div class="portlet box green">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>添加项目
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"> </a>
                                    <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                    <a href="javascript:;" class="reload"> </a>
                                    <a href="javascript:;" class="remove"> </a>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                                <form action="javascript:;" id="upform" method="post"
                                      class="form-horizontal form-bordered" enctype="multipart/form-data">
                                    <div class="form-body">
                                        {{--<h3 class="form-section">Person Info</h3>--}}
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">名称</label>
                                            <div class="col-sm-4">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-check"></i>
                                                    </span>
                                                    <input value="" type="text" name="name" class="form-control"
                                                           ></div>
                                                <p class="help-block"></p>
                                                <input type="hidden" value="{{csrf_token()}}" name="_token">
                                            </div>
                                        </div>
                                        @if(\App\Models\User::getUser()->can('admin'))
                                            <div class="form-group" style="display:none">
                                                <label class="col-sm-3 control-label">选择商家</label>
                                                <div class="col-sm-4">
                                                    <select class="form-control input-small" id="shop" name="shop">
                                                        <option value="">--------全部--------</option>
                                                        @if(count($shop))
                                                            @foreach($shop as $item)
                                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        @elseif(\App\Models\User::getUser()->can('shop'))
                                            <div class="form-group" style="display:none">
                                                <label class="col-sm-3 control-label">选择商家</label>
                                                <div class="col-sm-4">
                                                    <select class="form-control input-small" id="shop" name="shop">
                                                        @if($shop))
                                                                <option selected="selected" value="{{$shop->id}}">{{$shop->name}}</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        @else
                                        @endif
                                        <div class="form-group" style="display:none">
                                            <label class="col-sm-3 control-label">分类</label>
                                            <div class="col-sm-4">
                                                <select class="bs-select form-control" name="categoryid" tabindex="-98">
                                                    <?php echo $category->getOptions();?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">价格</label>
                                            <div class="col-md-5">
                                                <dl class="clearfix">
                                                    <div><input type="text" class="form-control input-xlarge"
                                                                placeholder="" name="price"
                                                                value=""></div>
                                                    <p class="help-block"></p>
                                                </dl>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">最少众筹金额</label>
                                            <div class="col-md-5">
                                                <dl class="clearfix">
                                                    <div><input type="text" class="form-control input-xlarge"
                                                                placeholder="" name="gain_price"
                                                                value=""></div>
                                                    <p class="help-block"></p>
                                                </dl>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">项目时间（项目的完成时间（秒））</label>
                                            <div class="col-md-5">
                                                <dl class="clearfix">
                                                    <div><input type="text" class="form-control input-xlarge"
                                                                placeholder="" name="project_time"
                                                                value=""></div>
                                                    <p class="help-block"></p>
                                                </dl>
                                            </div>
                                        </div>
                                        <div class="form-group" style="display:none">
                                            <label class="col-sm-3 control-label">礼包等级</label>
                                            <div class="col-md-5">
                                                <dl class="clearfix">
                                                    <div><input type="number" class="form-control input-xlarge"
                                                                placeholder="" name="gift_lv"
                                                                value=""></div>
                                                    <p class="help-block"></p>
                                                </dl>
                                            </div>
                                        </div>
                                        <div class="form-group" style="display:none">
                                            <label class="col-sm-3 control-label">排序</label>
                                            <div class="col-md-5">
                                                <dl class="clearfix">
                                                    <div><input type="text" class="form-control input-xlarge"
                                                                placeholder="" name="hot"

                                                                value=""></div>
                                                    <p class="help-block"></p>
                                                </dl>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">资格和风险提示</label>
                                            <div class="col-md-5">
                                                <dl class="clearfix">
                                                    <div><input type="text" class="form-control input-xlarge"
                                                                placeholder="" name="seller_note"
                                                                value=""></div>
                                                    <p class="help-block"></p>
                                                </dl>
                                            </div>
                                        </div>
                                        <div class="form-group" style="display:none">
                                            <label class="col-sm-3 control-label">是否上架</label>
                                            <div class="col-md-5">
                                                <dl class="clearfix">
                                                    <div><input type="radio" value="1"
                                                                name="is_ground">上架&nbsp;&nbsp;<input type="radio"
                                                                                                      value="0"
                                                                                                      name="is_ground">下架
                                                    </div>
                                                    <p class="help-block"></p>
                                                </dl>
                                            </div>
                                        </div>
                                        <div class="form-group" style="display:none">
                                            <label class="col-sm-3 control-label">是否热销</label>
                                            <div class="col-md-5">
                                                <dl class="clearfix">
                                                    <div><input type="radio" value="1"
                                                                name="is_hot">热销&nbsp;&nbsp;<input type="radio"
                                                                                                   value="0"
                                                                                                   name="is_hot">不热销
                                                    </div>
                                                    <p class="help-block"></p>
                                                </dl>
                                            </div>
                                        </div>

                                        <div class="form-group" style="display:none">
                                            <label class="col-sm-3 control-label">图片</label>
                                            <div class="col-md-5">
                                                <div class="formControls col-5" style="float:left">
                                                    <img id="preview_id1" src="/admin/images/icon-add.png"
                                                         style="border: 1px solid #B8B9B9; width: 100px; height: 100px;"
                                                         onclick="$('#input_id1').click()"/>
                                                    <input type="file" name="file" id="input_id1" style="display: none;"
                                                           onchange="return uploadImageToServer('input_id1','images', 'preview_id1');"/>
                                                </div>
                                                <div class="formControls col-5" style="float:left">
                                                    <img id="preview_id2" src="/admin/images/icon-add.png"
                                                         style="border: 1px solid #B8B9B9; width: 100px; height: 100px;"
                                                         onclick="$('#input_id2').click()"/>
                                                    <input type="file" name="file" id="input_id2" style="display: none;"
                                                           onchange="return uploadImageToServer('input_id2','images', 'preview_id2');"/>
                                                </div>
                                                <div class="formControls col-5" style="float:left">
                                                    <img id="preview_id3" src="/admin/images/icon-add.png"
                                                         style="border: 1px solid #B8B9B9; width: 100px; height: 100px;"
                                                         onclick="$('#input_id3').click()"/>
                                                    <input type="file" name="file" id="input_id3" style="display: none;"
                                                           onchange="return uploadImageToServer('input_id3','images', 'preview_id3');"/>
                                                </div>
                                                <div class="formControls col-5" style="float:left">
                                                    <img id="preview_id4" src="/admin/images/icon-add.png"
                                                         style="border: 1px solid #B8B9B9; width: 100px; height: 100px;"
                                                         onclick="$('#input_id4').click()"/>
                                                    <input type="file" name="file" id="input_id4" style="display: none;"
                                                           onchange="return uploadImageToServer('input_id4','images', 'preview_id4');"/>
                                                </div>
                                                <div class="formControls col-5" style="float:left">
                                                    <img id="preview_id5" src="/admin/images/icon-add.png"
                                                         style="border: 1px solid #B8B9B9; width: 100px; height: 100px;"
                                                         onclick="$('#input_id5').click()"/>
                                                    <input type="file" name="file" id="input_id5" style="display: none;"
                                                           onchange="return uploadImageToServer('input_id5','images', 'preview_id5');"/>
                                                </div>
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
                                            <div class="col-md-6"></div>
                                        </div>
                                    </div>

                                    <!-- END FORM-->
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_1">
                        <div class="portlet box green">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>项目内容
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"> </a>
                                    <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                    <a href="javascript:;" class="reload"> </a>
                                    <a href="javascript:;" class="remove"> </a>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                                <div class="form-body">
                                    {{--<h3 class="form-section">Person Info</h3>--}}
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">内容</label>
                                            <div class="col-md-5">
                                                <!-- 加载编辑器的容器 -->
                                                <script id="container" name="content" type="text/plain">

                                                </script>
                                                <!-- 配置文件 -->
                                                <script type="text/javascript"
                                                        src="/service/editor/ueditor.config.js"></script>
                                                <!-- 编辑器源码文件 -->
                                                <script type="text/javascript"
                                                        src="/service/editor/ueditor.all.js"></script>
                                                <!-- 实例化编辑器 -->
                                                <script type="text/javascript">
                                                    var ue = UE.getEditor('container');
                                                </script>
                                            </div>
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
                                        <div class="col-md-6"></div>
                                    </div>
                                </div>
                                <!-- END FORM-->
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_2">
                        <div class="portlet box green">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>手机端商品内容
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"> </a>
                                    <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                    <a href="javascript:;" class="reload"> </a>
                                    <a href="javascript:;" class="remove"> </a>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                                <div class="form-body">
                                    {{--<h3 class="form-section">Person Info</h3>--}}
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">内容</label>
                                            <div class="col-md-5">
                                                <!-- 加载编辑器的容器 -->
                                                <script id="mcontainer" name="mcontent" type="text/plain">

                                                </script>
                                                <script type="text/javascript">
                                                    var mue = UE.getEditor('mcontainer');
                                                </script>
                                            </div>
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
                                        <div class="col-md-6"></div>
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
            tiptype: 2,
            callback: function () {
                ue.ready(function () {
                    content = ue.getContent();
                });
                mue.ready(function () {
                    mcontent = mue.getContent();
                });
                Ajax('JSON').post('/admin/goods/goods/add', {
                    name: $('input[name="name"]').val(),
                    categoryid: $('select[name="categoryid"]').val(),
                    price: $('input[name="price"]').val(),
                    project_time:$('input[name="project_time"]').val(),
                    gain_price: $('input[name="gain_price"]').val(),
                    hot: $('input[name="hot"]').val(),
                    seller_note: $('input[name="seller_note"]').val(),
                    gift_lv: $('input[name="gift_lv"]').val(),
                    is_hot: $('input[name="is_hot"]').val(),
                    is_ground: $('input[name="is_ground"]').val(),
                    shop_id: $('#shop').val(),
                    content: content,
                    mcontent: mcontent,
//                    preview1: ($('#preview_id1').attr('src') != '/admin/images/icon-add.png' ? $('#preview_id1').attr('src') : ''),
//                    preview2: ($('#preview_id2').attr('src') != '/admin/images/icon-add.png' ? $('#preview_id2').attr('src') : ''),
//                    preview3: ($('#preview_id3').attr('src') != '/admin/images/icon-add.png' ? $('#preview_id3').attr('src') : ''),
//                    preview4: ($('#preview_id4').attr('src') != '/admin/images/icon-add.png' ? $('#preview_id4').attr('src') : ''),
//                    preview5: ($('#preview_id5').attr('src') != '/admin/images/icon-add.png' ? $('#preview_id5').attr('src') : ''),
                    _token: "{{csrf_token()}}"
                }, function (data) {
                    console.log(222);
                    var msg = (data);
                    if (msg.status !== 1) {
                        layer.open({
                            title: '提示'
                            , content: msg.message,
                            yes: function () {
                                window.location.href = '/admin/goods/goods/index';
                            }
                        });
                    } else {
                        layer.open({
                            title: '提示'
                            , content: msg.message,
                            yes: function () {
                                window.location.href = '/admin/goods/goods/index';
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
    <script src="/service/uploadFile.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
@endsection


<script>


</script>





