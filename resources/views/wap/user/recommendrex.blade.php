@extends('wap.master.index')
@section('title','订单列表')
@section('head')
    <link rel="stylesheet" type="text/css" href="/wap/css/base.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/address.css" />
    <link rel="stylesheet" type="text/css" href="/wap/css/loaders.min.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/loading.css"/>
    <script src="/wap/js/jquery.min.js" type="text/javascript"></script>
    <script src="/wap/sourse/layer/mobile/layer.js"></script>
    <script type="text/javascript">
        $(window).load(function(){
            $(".loading").addClass("loader-chanage")
            $(".loading").fadeOut(300);
        })
    </script>

    <style type="text/css">
         table.gridtable {
                 font-family: verdana,arial,sans-serif;
                 font-size:11px;
                 color:#333333;
                 border-width: 1px;
                 border-color: #666666;
                 border-collapse: collapse;
         }
         table.gridtable th {
                    border-width: 1px;
                    padding: 8px;
                    border-style: solid;
                    border-color: #666666;
                    background-color: #dedede;
                }
         table.gridtable td {
                    border-width: 1px;
                    padding: 8px;
                    border-style: solid;
                    border-color: #666666;
                    background-color: #ffffff;
                }
         </style>

@endsection

@section('content')
    <header class="mui-bar mui-bar-nav" id="header" style=" background-color: #f5655c;">
        <a class="btn" href="javascript:history.go(-1);">
            <i class="iconfont icon-fanhui" style="color: #fff"></i>
        </a>
        <p style="margin-left: 120px;">推荐瑞达人列表</p>
    </header>
    <table class="gridtable" width="100%">
        <tr><th align="center">ID</th><th align="center">电话</th><th align="center">会员等级</th><th align="center">加盟时间</th></tr>
        @if(count($fu))
            @foreach($fu as $user)
                <tr>
                    <td align="center"><img id="jia_{{$user->id}}" onclick="show({{$user->id}});" style="vertical-align:middle;" width="15" height="15" src="/wap/images/jia1.png"><img id="jian_{{$user->id}}" onclick="show1({{$user->id}});" style="vertical-align:middle; display: none;" width="15" height="15" src="/wap/images/jian1.png">&nbsp;&nbsp;&nbsp;<span style="vertical-align:middle;">{{$user->id}}</span></td>
                    <td align="center">{{$user->phone}}</td>
                    <td align="center">
                       瑞达人M{{$user->m_level}}
                    </td>
                    <td align="center">{{substr($user->created_at,0,11)}}</td>
                </tr>
                @if(count($re[$user->id]))
                    @foreach($re[$user->id] as $ffu)
                        <tr class="tr_{{$user->id}}" style="color: grey; display: none;"><td align="center">{{$ffu->id}}</td><td align="center">{{$ffu->phone}}</td><td align="center">M{{$ffu->m_level}}</td><td align="center">{{substr($ffu->created_at,0,11)}}</td></tr>
                    @endforeach
                @endif
            @endforeach
        @endif

    </table>
@endsection

@section('script')
    <script type="text/javascript">
        function show(id) {
            $(".tr_"+id).show();
            $("#jia_"+id).hide();
            $("#jian_"+id).show();
        }

        function show1(id) {
            $(".tr_"+id).hide();
            $("#jia_"+id).show();
            $("#jian_"+id).hide();
        }
    </script>
@endsection
