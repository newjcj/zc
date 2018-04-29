@extends('admin.master.master')
@section('title',"会员实名认证列表")
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
    <style>
        img.card_image{
            width:50px;
        }
    </style>
@endsection


@section('content')
    <div id="form_modal3" class="modal fade" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">查看</h4>
                </div>
                <div class="modal-body">
                    <img src=""  alt="" style="width:500px;">
                </div>
                <div class="modal-footer">
                    <button class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">关闭</button>
                    {{--<button class="btn green btn-primary" data-dismiss="modal">Save changes</button>--}}
                </div>
                <iframe id="tmp_downloadhelper_iframe" style="display: none;"></iframe></div>
        </div>
    </div>

    <div class="portlet box green" data='cc' id="g1">

        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-globe"></i>会员实名认证列表
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
                    <th style="text-align: center">用户id</th>
                    <th style="text-align: center">姓名</th>
                    <th style="text-align: center">微信名</th>
                    <th style="text-align: center">订单数</th>
                    <th style="text-align: center">电话</th>
                    <th style="text-align: center">邮箱</th>
                    <th style="text-align: center">身份证号码</th>
                    <th style="text-align: center">身份证正面图片</th>
                    <th style="text-align: center">身份证反现图片</th>
                    <th style="text-align: center" style=" width: 40px;">银行卡号码</th>
                    <th style="text-align: center">状态</th>
                    <th style="text-align: center">操作</th>
                </tr>
                </thead>
                <tbody>
                @if($users)
                    @foreach($users as $item)
                        <tr style="text-align: center">
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->nickname}}</td>
                            <td>{{count($item->orders)}}</td>
                            <td>{{$item->phone}}</td>
                            <td>{{$item->email}}</td>
                            <td><img class="card_image" src="{{$item->card_image1 ?:'111'}}" alt="" onclick="_bigImg(this)"></td>
                            <td><img class="card_image" src="{{$item->card_image2 ?:''}}" alt="" onclick="_bigImg(this)"></td>
                            <td>{{$item->cardid}}</td>
                            <td>
                                <select class="form-control input-small" id="shopid" name="shopid">
                                    @if(count($item->userbank))
                                        @foreach($item->userbank as $item1)
                                            <option value="{{$item1->id}}">{{$item1->banknumber}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </td>

                            <td style="text-align: center">
                                @if($item->is_true == 0)
                                    <button type="button" class="btn btn-primary dark" >未审核</button>
                                    @elseif($item->is_true == 1)
                                <button type="button" class="btn btn-primary default">审核过</button>
                                @elseif($item->is_true == 2)
                                    <button type="button" class="btn btn-danger" >封禁的用户</button>
                                    @elseif($item->is_true == 3)
                                    <button type="button" class="btn btn-primary" >审核中</button>
                                    @else
                                    @endif
                            </td>
                            <td style="text-align: center">
                                    <button type="button" class="btn btn-primary dark"  onclick="_verify('{{ $item->id }}',0)" >未审核</button>
                                    <button type="button" class="btn btn-primary default" onclick="_verify('{{ $item->id }}',1)" >通过</button>
                                    <button type="button" class="btn btn-danger"  onclick="_verify('{{ $item->id }}',2)" >封禁的用户</button>
                                    <button type="button" class="btn btn-primary" onclick="_verify('{{ $item->id }}',3)" >审核中</button>
                            </td>
                        </tr>
                    @endforeach
                @endif


                </tbody>
            </table>
            </table>

        </div>
    </div>



@endsection
<script>
    //显示大图
    function _bigImg(obj){
        $('#form_modal3').modal('show').find('img').attr('src',$(obj).attr('src'));
    }

    function _verify(userid,is_true) {
        Ajax('json').post('/admin/user/user/verify', {
            userid: userid,
            is_true: is_true,
            _token: "{{csrf_token()}}"
        }, function (data) {
            if (data.status !== 1) {
                layer.open({
                    title: '提示'
                    , content: data.message,
                    yes: function () {
                        window.location.reload();
                    },
                    cancel: function () {
                        //右上角关闭回调
                        window.location.reload();
                    }
                });
            } else {
                layer.open({
                    title: '提示'
                    , content: data.message,
                    yes: function () {
                        window.location.reload();
                    },
                    cancel: function () {
                        //右上角关闭回调
                        window.location.reload();
                    }
                });
            }
        });
    }
</script>



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






