@extends('admin.master.master')
@section('title',"资源文件")
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
    <script type="text/javascript" src="/service/webuploader/webuploader.js"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- date-->
    <style>
        .row img {
            width:100px;
        }
    </style>
@endsection


@section('content')

    <div class="row">
        <a href="/admin/dist/dist/upl" id="" class="btn btn-primary">上传图片</a>
        <hr>
        @if(count($dists))
            @foreach($dists as $dist)
                <div class="col-md-2 col-sm-2 col-xs-6">
                    <div class="color-demo tooltips" data-original-title="Click to view demos for this color" data-toggle="modal" data-target="#demo_modal_white">
                        <span class="badge badge-danger" onclick="_del({{ $dist->id }})"> 删除 </span>
                        <div class="color-view bg-white bg-font-white bold uppercase">
                            <a href="/admin/dist/dist/edit">
                                <img src="{{ $dist->img }}" alt="" >
                            </a>
                        </div>
                        <div class="color-info bg-white c-font-14 sbold"> {{ $dist->iconname }}</div>
                    </div>
                </div>
    @endforeach
        @endif
    </div>

    <script>


        // 初始化Web Uploader
        var uploader = WebUploader.create({

            // 选完文件后，是否自动上传。
            auto: true,
            // 文件接收服务端。

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',

            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            }
        });
        // 当有文件添加进来的时候
        uploader.on( 'fileQueued', function( file ) {
            var srcs = [$('.preview_id1').attr('src'),$('.preview_id2').attr('src')];
            $img='';
            if(srcs[0] === '/admin/images/icon-add.png'){
                $img=$('.preview_id1');
            }else{
                $img=$('.preview_id2');

            }

            // 创建缩略图
            // 如果为非图片文件，可以不用调用此方法。
            // thumbnailWidth x thumbnailHeight 为 100 x 100
            uploader.makeThumb( file, function( error, src ) {
                if ( error ) {
                    $img.replaceWith('<span>不能预览</span>');
                    return;
                }

                $img.attr( 'src', src );
            }, 1000, 1000 );
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
    var _del=function(id){
        $.ajax({
            url: '/admin/dist/dist/del',
            data: {
                id:id,
                _token: "{{csrf_token()}}"
            },
            type: 'post',
            dataType: 'json',
            async:false,
            success: function (data) {
                layer.open({
                    title: '提示',
                    shadeClose:true,//点击遮罩关闭
                    content: data.message,
                    yes:function(){
                        layer.closeAll();
                        window.location.href='/admin/dist/dist/dist';
                    },
                    cancel: function(){
                        //右上角关闭回调
                        window.location.href='/admin/dist/dist/dist';
                    }
                });
            }
        });
    }
</script>





