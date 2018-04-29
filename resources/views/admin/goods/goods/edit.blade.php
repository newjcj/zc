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
                                    <i class="fa fa-gift"></i>添加项目 </div>
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
                                                    <input value="{{ $goods->name ?:'' }}" type="text" name="name" class="form-control" > </div>
                                                <p class="help-block"> </p>
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
                                                                @if($goods->shop_id == $item->id)
                                                                <option selected value="{{$item->id}}">{{$item->name}}</option>
                                                                @else
                                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                                    @endif
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
                                                    <?php echo $category->getOptions($goods->category_id);?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">价格</label>
                                                <div class="col-md-5">
                                                    <dl class="clearfix">
                                                        <div><input value="{{ $goods->price ?$goods->price/100:'' }}" type="text" class="form-control input-xlarge" placeholder="" name="price" datatype1="/.*/"></div>
                                                        <p class="help-block"> </p>
                                                    </dl>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">最少众筹金额</label>
                                                <div class="col-md-5">
                                                    <dl class="clearfix">
                                                        <div><input value="{{ $goods->gain_price ?$goods->gain_price/100:'' }}" type="text" class="form-control input-xlarge" placeholder="" name="gain_price" datatype1="/.*/"></div>
                                                        <p class="help-block"> </p>
                                                    </dl>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">项目时间(秒)</label>
                                                <div class="col-md-5">
                                                    <dl class="clearfix">
                                                        <div><input value="{{ $goods->project_time ?$goods->project_time:'' }}" type="text" class="form-control input-xlarge" placeholder="" name="project_time" datatype1="/.*/"></div>
                                                        <p class="help-block"> </p>
                                                    </dl>
                                                </div>
                                            </div>
                                            <div class="form-group" style="display:none">
                                                <label class="col-sm-3 control-label">礼包等级</label>
                                                <div class="col-md-5">
                                                    <dl class="clearfix">
                                                        <div><input type="number" value="{{ $goods->gift_lv ?:'' }}" class="form-control input-xlarge" placeholder="" name="gift_lv" datatype1="/^[1-9]{1}$/" ></div>
                                                        <p class="help-block"> </p>
                                                    </dl>
                                                </div>
                                            </div>
                                            <div class="form-group" style="display:none">
                                                <label class="col-sm-3 control-label">排序</label>
                                                <div class="col-md-5">
                                                    <dl class="clearfix">
                                                        <div><input value="{{ $goods->hot ?$goods->hot:'' }}" type="text" class="form-control input-xlarge" placeholder="" name="hot" datatype1="/^[1-9]{1,3}([.]{0,1}[0-9]{1,2}){0,1}$/"></div>
                                                        <p class="help-block"> </p>
                                                    </dl>
                                                </div>
                                            </div>
                                            <div class="form-group" >
                                                <label class="col-sm-3 control-label">资格和风险提示</label>
                                                <div class="col-md-5">
                                                    <dl class="clearfix">
                                                        <div><input value="{{ $goods->seller_note ?$goods->seller_note:'' }}" type="text" class="form-control input-xlarge" placeholder="" name="seller_note" datatype1="/^[1-9]{1,3}([.]{0,1}[0-9]{1,2}){0,1}$/"></div>
                                                        <p class="help-block"> </p>
                                                    </dl>
                                                </div>
                                            </div>

                                            <div class="form-group" style="display:none">
                                                <label class="col-sm-3 control-label">是否上架</label>
                                                <div class="col-md-5">
                                                    <dl class="clearfix">
                                                        <div><input type="radio" value="1" name="is_ground" {{ $goods->is_ground==1 ? 'checked' : '' }} >上架&nbsp;&nbsp;&nbsp;<input type="radio" value="0" name="is_ground" {{ $goods->is_ground==0 ? 'checked' : '' }}>下架</div>
                                                        <p class="help-block"> </p>
                                                    </dl>
                                                </div>
                                            </div>
                                            <div class="form-group" style="display:none">
                                                <label class="col-sm-3 control-label">是否热销</label>
                                                <div class="col-md-5">
                                                    <dl class="clearfix">
                                                        <div><input type="radio" value="1" name="is_hot" {{ $goods->is_hot==1 ? 'checked' : '' }} >热销&nbsp;&nbsp;&nbsp;<input type="radio" value="0" name="is_hot" {{ $goods->is_hot==0 ? 'checked' : '' }}>不热销</div>
                                                        <p class="help-block"> </p>
                                                    </dl>
                                                </div>
                                            </div>
                                            <div class="form-group" style="display:none">
                                                <label class="col-sm-3 control-label">图片</label>
                                                <div class="col-md-5" >
                                                    <?php $image = explode(',',(($goods->goodsimage)[0])->image);?>
                                                    <div class="formControls col-5" style="float:left">
                                                        <img id="preview_id1" src="{{ $image[0]?:'/admin/images/icon-add.png' }}" style="border: 1px solid #B8B9B9; width: 100px; height: 100px;" onclick="$('#input_id1').click()" />
                                                        <input type="file" name="file" id="input_id1" style="display: none;" onchange="return uploadImageToServer('input_id1','images', 'preview_id1','2')" />
                                                    </div>
                                                    <div class="formControls col-5" style="float:left">
                                                        <img id="preview_id2" src="{{ $image[1]?:'/admin/images/icon-add.png' }}" style="border: 1px solid #B8B9B9; width: 100px; height: 100px;" onclick="$('#input_id2').click()" />
                                                        <input type="file" name="file" id="input_id2" style="display: none;" onchange="return uploadImageToServer('input_id2','images', 'preview_id2');" />
                                                    </div>
                                                    <div class="formControls col-5" style="float:left">
                                                        <img id="preview_id3" src="{{ $image[2]?:'/admin/images/icon-add.png' }}" style="border: 1px solid #B8B9B9; width: 100px; height: 100px;" onclick="$('#input_id3').click()" />
                                                        <input type="file" name="file" id="input_id3" style="display: none;" onchange="return uploadImageToServer('input_id3','images', 'preview_id3');" />
                                                    </div>
                                                    <div class="formControls col-5" style="float:left">
                                                        <img id="preview_id4" src="{{ $image[3]?:'/admin/images/icon-add.png' }}" style="border: 1px solid #B8B9B9; width: 100px; height: 100px;" onclick="$('#input_id4').click()" />
                                                        <input type="file" name="file" id="input_id4" style="display: none;" onchange="return uploadImageToServer('input_id4','images', 'preview_id4');" />
                                                    </div>
                                                    <div class="formControls col-5" style="float:left">
                                                        <img id="preview_id5" src="{{ $image[4]?:'/admin/images/icon-add.png' }}" style="border: 1px solid #B8B9B9; width: 100px; height: 100px;" onclick="$('#input_id5').click()" />
                                                        <input type="file" name="file" id="input_id5" style="display: none;" onchange="return uploadImageToServer('input_id5','images', 'preview_id5');" />
                                                    </div>
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
                                            <div class="col-md-6"> </div>
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
                                    <i class="fa fa-gift"></i>商品内容 </div>
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
                                                <script type="text/javascript" src="/service/editor/ueditor.config.js"></script>
                                                <!-- 编辑器源码文件 -->
                                                <script type="text/javascript" src="/service/editor/ueditor.all.js"></script>
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
                                        <div class="col-md-6"> </div>
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
                                    <i class="fa fa-gift"></i>手机端商品内容 </div>
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
                                                <!-- 实例化编辑器 -->
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
        ue.ready(function() {
            ue.setContent('{!! $goods->content !!}');
        });
        mue.ready(function() {
            mue.setContent('{!! $goods->content !!}');
        });
        var id={{ $goods->id }}
        $("#upform").Validform({
            tiptype:2,
            callback:function(){
                ue.ready(function() {
                    content = ue.getContent();
                });
                mue.ready(function() {
                    mcontent = mue.getContent();
                });
                Ajax('JSON').post('/admin/goods/goods/update',{
                    id:id,
                    categoryid:$('select[name="categoryid"]').val(),
                    name:$('input[name="name"]').val(),
                    price:$('input[name="price"]').val(),
                    project_time:$('input[name="project_time"]').val(),
                    gain_price:$('input[name="gain_price"]').val(),
                    gift_lv:$('input[name="gift_lv"]').val(),
                    content:content,
                    mcontent:mcontent,
//                    preview1:($('#preview_id1').attr('src')!='/admin/images/icon-add.png'?$('#preview_id1').attr('src'):''),
//                    preview2:($('#preview_id2').attr('src')!='/admin/images/icon-add.png'?$('#preview_id2').attr('src'):''),
//                    preview3:($('#preview_id3').attr('src')!='/admin/images/icon-add.png'?$('#preview_id3').attr('src'):''),
//                    preview4:($('#preview_id4').attr('src')!='/admin/images/icon-add.png'?$('#preview_id4').attr('src'):''),
//                    preview5:($('#preview_id5').attr('src')!='/admin/images/icon-add.png'?$('#preview_id5').attr('src'):''),
                    hot:$('input[name="hot"]').val(),
                    shop_id: $('#shop').val(),
                    seller_note:$('input[name="seller_note"]').val(),
                    is_ground:$('input[name="is_ground"]:checked').val(),
                    is_hot:$('input[name="is_hot"]:checked').val(),
                    _token: "{{csrf_token()}}"
                },function(data){
                    var msg=(data);
                    if(msg.status !== 1){
                        layer.open({
                            title: '提示'
                            ,content: msg.message,
                        });
                    }else{
                        layer.open({
                            title: '提示'
                            ,content: msg.message,
                            yes:function(){
                                window.location.href='/admin/goods/goods/index';
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





