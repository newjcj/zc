@extends('admin.master.master')
@section('title',"工单回复")
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
    <div style="margin:0 auto;width:100%,height:30px;">

        @if(\App\models\User::getUser()->can('admin'))
        <form style="display:none" action="/admin/goods/goods/index" id="upform" method="get" class="form-horizontal form-bordered" enctype="multipart/form-data">
            <div>
            <select class="form-control input-small" id="shopid" name="shopid"  style="float: left; margin-left: 1400px;">
            <option value="">-----选择商家-----</option>
            @if(count($shop))
                @foreach($shop as $item)
                    @if($shopid && $shopid==$item->id)
                    <option selected="selected" value="{{$item->id}}" {{$item->id==$shopid ? 'selected' : ''}}>{{$item->name}}</option>
                        @else
                            <option value="{{$item->id}}" {{$item->id==$shopid ? 'selected' : ''}}>{{$item->name}}</option>
                        @endif
                @endforeach
            @endif
            </select>
            <input type="hidden" name="_token" value="{{csrf_token()}}">&nbsp;&nbsp;&nbsp;
            </div>
        </form>
    @endif
    </div>

    <hr>
    <div class="portlet box blue" id="form_wizard_1">
        <div class="portlet-title">
            <div class="caption">
                工单
            </div>
            <div class="tools hidden-xs">
                <a href="javascript:;" class="collapse">
                </a>
                <a href="#portlet-config" data-toggle="modal" class="config">
                </a>
                <a href="javascript:;" class="reload">
                </a>
                <a href="javascript:;" class="remove">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <form action="javascript:" class="form-horizontal" id="submit_form" method="POST" novalidate="novalidate" _vimium-has-onclick-listener="">
                <div class="form-group">
                    <div class="tab-content">
                        <div class="alert alert-danger display-none" style="display: none;">
                            <button class="close" data-dismiss="alert"></button>

                        </div>
                        <div class="alert alert-success display-none" style="display: none;">
                            <button class="close" data-dismiss="alert"></button>
                            Your form validation is successful!
                        </div>
                        <div class="tab-pane" id="tab1">
                            <h3 class="block">Provide your account details</h3>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Username <span class="required" aria-required="true">
													* </span>
                                </label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="username" aria-required="true" aria-invalid="false"><span for="username" class="help-block help-block-error valid"></span>
                                    <span class="help-block">
														Provide your username </span>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Password <span class="required" aria-required="true">
													* </span>
                                </label>
                                <div class="col-md-4">
                                    <input type="password" class="form-control" name="password" id="submit_form_password" aria-required="true" aria-invalid="false"><span for="submit_form_password" class="help-block help-block-error valid"></span>
                                    <span class="help-block">
														Provide your password. </span>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Confirm Password <span class="required" aria-required="true">
													* </span>
                                </label>
                                <div class="col-md-4">
                                    <input type="password" class="form-control" name="rpassword" aria-required="true" aria-invalid="false"><span for="rpassword" class="help-block help-block-error valid"></span>
                                    <span class="help-block">
														Confirm your password </span>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label col-md-3">Email <span class="required" aria-required="true">
													* </span>
                                </label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="email" aria-required="true" aria-invalid="false"><span for="email" class="help-block help-block-error valid"></span>
                                    <span class="help-block">
														工单 </span>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane active" id="tab2">
                            <div class="form-group" style="margin-top:20px">
                                <label class="control-label col-md-3">工单内容</label>
                                <div class="col-md-4">
                                    <textarea class="form-control" rows="6" name="content" >{{$orderworkdetail->content}}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">回复内容</label>
                                <div class="col-md-4">
                                    <textarea class="form-control" rows="6" name="back">{{$orderworkdetail->back}}</textarea>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
                <button class="btn btn-primary" style="margin-left:40%;margin-bottom:20px;" onclick="_back1()">回复</button>
            </form>
        </div>
    </div>



    <script>
        function _back1(){
            $.ajax({
                url: '/admin/orderwork/orderwork/orderworkback',
                data: {
                    back:$('textarea[name="back"]').val(),
                    id:'{{ $orderworkdetail->id }}'
                },
                type: 'post',
                dataType: 'json',
                async:false,
                success: function (data) {
                    if(data.message === 1){
                        //提示
                        layer.msg(data.message);
                        setTimeout(function(){
                            window.location.href='/admin/orderwork/orderwork/orderworklist?id={{$orderworkid}}';
                        },2000);

                    }else{
                        setTimeout(function(){
                            window.location.href='/admin/orderwork/orderwork/orderworklist?id={{$orderworkid}}';
                        },2000);
                        layer.msg(data.message);
                    }
                }
            });
            return false;

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








