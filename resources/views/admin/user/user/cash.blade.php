@extends('admin.master.master')
@section('title',"会员提现审核")
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
    <div id="form_modal3" class="modal fade" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">查看</h4>
                </div>
                <div class="modal-body userid" data-userid="">
                        <button type="button" class="btn btn-xs dark" onclick="_addRole(0)">通过</button>
                        <button type="button" class="btn btn-xs dark" onclick="_addRole(2)">不通过</button>
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
                <i class="fa fa-globe"></i>会员
            </div>
            <div class="tools"></div>

        </div>
        <div class="portlet-body">
            <table class="table table-striped table-bordered table-hover" id="sample_1">
                <thead>
                <tr class="odd">
                    <th style="text-align: center">姓名</th>
                    <th style="text-align: center">电话</th>
                    <th style="text-align: center">申请时间</th>
                    <th style="text-align: center">积分</th>
                    <th style="text-align: center">提现金额</th>
                    <th style="text-align: center">身份证号码</th>
                    <th style="text-align: center" >银行名称</th>
                    <th style="text-align: center" >银行卡号码</th>
                    <th style="text-align: center" >状态</th>
                    <th style="text-align: center">操作 </th>

                </tr>
                </thead>
                <tbody>
                @if($banks)
                    @foreach($banks as $item)
                        <tr style="text-align: center">
                            <td>{{$item->user->name}}</td>
                            <td>{{$item->user->phone}}</td>
                            <td>{{$item->created_at}}</td>
                            <td><div class="btn btn-xs red">{{$item->user->shop_coin*100}}</div></td>
                            <td><div class="btn btn-xs red">{{$item->money*100}}元</div></td>
                            <td>{{$item->user->cardid}}</td>
                            <td>{{count($item->user->userbank) ? $item->user->userbank[0]->bankname :'' }}</td>
                            <td>
                                {{count($item->user->userbank) ? $item->user->userbank[0]->banknumber :'' }}
                            </td>
                            <td>
                                @if($item->rate==1)
                                    <button type="button" class="btn btn-xs blue">
                                        等待审核
                                    </button>
                                    @elseif($item->rate==0)
                                    <button type="button" class="btn btn-xs green">
                                        已通过
                                    </button>
                                @else
                                    <button type="button" class="btn btn-xs red">
                                        不能提现
                                    </button>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary" onclick="_setUserid('{{ $item->id }}')">
                                    审核
                                </button>
                            </td>

                        </tr>
                    @endforeach
                @endif


                </tbody>
            </table>


        </div>
    </div>



    <script>
        function _setUserid(userid) {
            $('#form_modal3').modal('show').find('.userid').attr('data-userid',userid);
        }
        function _addRole(roleid) {
            Ajax('JSON').post('/admin/user/user/cash', {
                id: $('.userid').data('userid'),
                regionid:roleid,
                _token: "{{csrf_token()}}"
            }, function (data) {
                var msg=(data);
                if(msg.status !== 1){
                    layer.open({
                        title: '提示'
                        ,content: msg.message,
                        yes:function(){
                            window.location.href='/admin/user/user/cash';
                        },
                        cancel: function(){
                            //右上角关闭回调
                            window.location.href='/admin/user/user/cash';
                        }
                    });
                }else{
                    layer.open({
                        title: '提示'
                        ,content: msg.message,
                        yes:function(){
                            window.location.href='/admin/user/user/cash';
                        },
                        cancel: function(){
                            //右上角关闭回调
                            window.location.href='/user/user/user/cash';
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






