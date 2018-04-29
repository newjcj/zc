@extends('admin.master.master')
@section('title',"会员角色设置")
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
        img.card_image {
            width: 50px;
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
                <div class="modal-body userid" data-userid="">
                    @foreach($roles as $role)
                        <button type="button" class="btn btn-xs dark" onclick="_addRole('{{ $role->id }}')">{{ $role->display_name }}</button>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">关闭</button>
                    {{--<button class="btn green btn-primary" data-dismiss="modal">Save changes</button>--}}
                </div>
                <iframe id="tmp_downloadhelper_iframe" style="display: none;"></iframe>
            </div>
        </div>
    </div>

    <div class="portlet box green" data='cc' id="g1">

        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-globe"></i>会员角色设置
            </div>
            <div style="display: inline-block;position:relative;left:10px;top:5px;">
                <select style="width:120px;" id="select2-single-input-sm"
                        class="form-control input-sm select2-multiple select2-hidden-accessible" tabindex="-1"
                        aria-hidden="true">
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
                    <th style="text-align: center">电话</th>
                    <th style="text-align: center">邮箱</th>
                    <th style="text-align: center">角色状态</th>
                    <th style="text-align: center">操作</th>
                </tr>
                </thead>
                <tbody>
                @if(count($users))
                    @foreach($users as $item)
                        <tr style="text-align: center">
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->phone}}</td>
                            <td>{{$item->email}}</td>

                            <td style="text-align: center">
                                @if(count($item->roles))
                                    @foreach($item->roles as $role)
                                        <a href="javascript:_delRole('{{ $item->id }}','{{ $role->id }}');" class="btn btn-sm purple">
                                            <i class="fa fa-times"></i> {{ $role->display_name }} </a>
                                    @endforeach
                                @endif
                            </td>
                            <td style="text-align: center">
                                    <button type="button" class="btn btn-primary" onclick="_setUserid('{{ $item->id }}')">
                                        添加角色
                                    </button>
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
    function _setUserid(userid) {
        $('#form_modal3').modal('show').find('.userid').attr('data-userid',userid);
    }

    function _addRole(roleid) {
        Ajax('json').post('/admin/user/user/addrole', {
            userid: $('.userid').data('userid'),
            roleid: roleid,
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
    //删除角色
    function _delRole(userid,roleid) {
        Ajax('json').post('/admin/user/user/delrole', {
            userid: userid,
            roleid: roleid,
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






