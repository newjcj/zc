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
                    <th style="text-align: center">客户号</th>
                    <th style="text-align: center">社交账号</th>
                    <th style="text-align: center">性别</th>
                    <th style="text-align: center">国别</th>
                    <th style="text-align: center">电话</th>
                    <th style="text-align: center">邮箱</th>
                    <th style="text-align: center">身份证号码</th>
                    <th style="text-align: center">身份证正面</th>
                    <th style="text-align: center">身份证反而</th>
                    <th style="text-align: center">passport</th>
                    <th style="text-align: center">kyc</th>
                    <th style="text-align: center">eth</th>
                    <th style="text-align: center">btc</th>
                    <th style="text-align: center">用户状态</th>
                    {{--<th style="text-align: center;"> 冻结的金额</th>--}}
                    <th style="text-align: center">操作</th>
                </tr>
                </thead>
                <tbody>
                @if($users)
                    @foreach($users as $item)
                        <tr style="text-align: center">
                            <td>{{$item->name}}</td>
                            <td>{{$item->people_id}}</td>
                            <td>{{$item->social}}</td>
                            <td>{{$item->sex == 0 ? '女':'男'}}</td>
                            <td>{{$item->country}}</td>
                            <td>{{$item->phone}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->cardid}}</td>
                            <td><img src="{{$item->cardimage1}}" style="width:50px" alt=""></td>
                            <td><img src="{{$item->cardimage2}}" style="width:50px" alt=""></td>
                            <td><img src="{{$item->passport}}" style="width:50px" alt=""></td>
                            <td><a href="{{$item->kyc}}"> 点击查看 </a></td>
                            <td>{{$item->eth}}</td>
                            <td>{{$item->btc}}</td>
                            <td>
                                @if($item->status == 1)
                                    <button type="button" class="btn btn-primary" >审核通过</button>
                                @elseif($item->status == 2)
                                    <button type="button" class="btn btn-primary" >审核未通过</button>
                                @else
                                    <button type="button" class="btn btn-primary" >未审核</button>
                                @endif
                            </td>
                            {{--<td data-id="{{$item->id}}"><input style="width:70px;" type="text" class="ffuserprice" value="{{ $item->ff_user_price/100 }}"></td>--}}
                            <td style="text-align: center">
{{--                                <button type="button" class="btn btn-primary" onclick="location.href='/admin/user/user/edit?id={{$item->id}}'">编辑</button>--}}
                                @if($item->status == 1)
                                    @elseif($item->status == 2)
                                    @else
                                    <button type="button" class="btn btn-primary" onclick="_identify('{{$item->id}}')">审核通过</button>
                                    @endif
                                <button type="button" class="btn btn-danger" onclick="_delete({{$item->id}})">删除</button>

                            </td>
                        </tr>
                    @endforeach
                @endif


                </tbody>
            </table>
            </table>

        </div>
    </div>



    <script>
        //审核
        function _identify(id) {
            Ajax('JSON').post('/admin/user/user/identify', {
                id: id,
                status: 1,
                _token: "{{csrf_token()}}"
            }, function (data) {
                var msg = (data);
                if (msg.status !== 1) {
                    layer.open({
                        title: '提示'
                        , content: msg.message,
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
                        , content: msg.message,
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
        function _delete(id) {
            Ajax('JSON').post('/admin/user/user/delete1', {
                id: id,
                status: 1,
                _token: "{{csrf_token()}}"
            }, function (data) {
                var msg = (data);
                if (msg.status !== 1) {
                    layer.open({
                        title: '提示'
                        , content: msg.message,
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
                        , content: msg.message,
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
        //288金二代额设置



        //放大图片
        $w = $('img').width();
        $h = $('img').height();
        st = 300;
        console.log($w);
        $w2 = $w + st;
        $h2 = $h + st;
        $('img').hover(function(){
            w=$(this).width();
            h=$(this).height();
                $(this).stop().animate({height:$h2,width:$w2,left:"-10px",top:"-10px",zIndex:10},500);
            },
            function(){
                $(this).stop().animate({height:h,width:w,left:"0px",top:"0px",zIndex:100},500);
            }
        );
        // $('img').mouseleave(
        //     function(){
        //         console.log(222);
        //         $(this).css({height:20,width:20},500);
        //     }
        // );
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






