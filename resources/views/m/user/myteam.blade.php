@extends('wap.master.index')
@section('title','会员中心')
@section('head')
    <link rel="stylesheet" type="text/css" href="/wap/css/center.css" />
    <link rel="stylesheet" type="text/css" href="/wap/css/loaders.min.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/loading.css"/>
    <script src="/wap/js/rem.js"></script>
    <script src="/wap/js/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/admin/js/register.js"></script>
    <script type="text/javascript">
        sessionStorage.url = "confirm";
        $(window).load(function(){
            $(".loading").addClass("loader-chanage")
            $(".loading").fadeOut(300)
        })
    </script>
@endsection

@section('content')
    <header id="header" >
        <div class="topbar" style=" background-color: #f5655c;">
            <a href="javascript:history.back();" class="back_btn"><i class="iconfont">ş</i></a>
            <h1 class="page_title">我的团队</h1>
        </div>
    </header>
    <!-- 会员俱乐部 -->
    {{--<div class="vip-club border_top_bottom">--}}
        {{--<div class="vip-club-title border_bottom">--}}
            {{--<span><i class="iconfont"></i>我的团队</span>--}}
            {{--<a href="">每日签到领积分<i class="iconfont"></i></a>--}}
        {{--</div>--}}
    {{--</div>--}}
    <div class="vip-club ">
        <div class="vip-club-title">
            <span><img src="/wap/images/backup.gif" style="width:90px;"></span>
            <a href=""><img src="/wap/images/backtop.gif" style="width:60px;"></a>
        </div>
    </div>
    <div class="vip-list-icon border_bottom">
        <div style="background:url('/wap/images/team_bg4.png') no-repeat;background-size:100%;min-height:500px;width:100%;text-align:center;">
            <div style="padding-top:26%;color:#f60;line-height:0.4rem;font-size:0.3rem;">
                <div class="myimg radiusall" style="width:100px;height:100px;margin:0 auto;margin-top:-114px;border:1px solid #fff;">
                    <a href="/wap/user/myteam?id={{ $user->id }}">
                        <img src="{{ $user->headimgurl }}" alt="" class="radiusall" style="width:100px;padding-top:10px;">
                    </a>
                </div>
                我<br>创业者M1
            </div>
            <div style="width:100%;padding-top:16%;" tag="第二层头像">
                <div style="width:33%;float:left;">
                    @if($usergraph[0][0])
                        <a href="{{ $usergraph[0][0]?'/wap/user/myteam?id='.$usergraph[0][0]->id:'' }}">
                            <img src="{{ $usergraph[0][0]?$usergraph[0][0]->headimgurl:'' }}" alt="" class="radiusall" style="width:100px;">
                        </a>
                    @endif
                </div>
                <div style="width:33%;float:left;">
                    @if($usergraph[0][1])
                        <a href="{{ $usergraph[0][1]?'/wap/user/myteam?id='.$usergraph[0][1]->id:'' }}">
                            <img src="{{ $usergraph[0][1]?$usergraph[0][1]->headimgurl:'' }}" alt="" class="radiusall" style="width:100px;">
                        </a>
                    @endif
                </div>
                <div style="width:33%;float:left;">
                    @if($usergraph[0][2])
                        <a href="{{ $usergraph[0][2]?'/wap/user/myteam?id='.$usergraph[0][2]->id:'' }}">
                            <img src="{{ $usergraph[0][2]?$usergraph[0][2]->headimgurl:'' }}" alt="" class="radiusall" style="width:100px;">
                        </a>
                    @endif
                </div>
            </div>
            <div style="width:100%;padding-top:6%;line-height:0.4rem;font-size:0.2rem;color:#5d9c0a" tag="第二层">
                <div style="width:33%;float:left;margin-top:74px">
                    <span id="s1uname">{{ $usergraph[0][0]?$usergraph[0][1]->name:'' }}</span><br><span id="s1ulevel">创业者M1</span>
                </div>
                <div style="width:33%;float:left;margin-top:74px">
                    <span id="s2uname">{{ $usergraph[0][1]?$usergraph[0][1]->name:'' }}</span><br><span id="s2ulevel">创业者M1</span>
                </div>
                <div style="width:33%;float:left;margin-top:74px">
                    <span id="s3uname">{{ $usergraph[0][2]?$usergraph[0][1]->name:'' }}</span><br><span id="s3ulevel">创业者M1</span>
                </div>
            </div> <div style="width:100%;padding-top:33.2%;padding-left:5px;" tag="第三层头像">
                <?php $i=0;?>
                @foreach($usergraph[1] as $item)
                <div style="width:10.6%;float:left;">
                    <a href="{{ $item[0]?'/wap/user/myteam?id='.$item[0]->id:'' }}">
                        <img src="{{ $item[0]?$item[0]->headimgurl:'/wap/images/headpic3.gif' }}" width="45" id="s12pic">
                    </a>
                </div>
                <div style="width:10.6%;float:left;">
                    <a href="{{ $item[1]?'/wap/user/myteam?id='.$item[1]->id:'' }}">
                        <img src="{{ $item[1]?$item[1]->headimgurl:'/wap/images/headpic3.gif' }}" width="45" id="s12pic">
                    </a>
                </div>
                <div style="width:10.6%;float:left;">
                    <a href="{{ $item[2]?'/wap/user/myteam?id='.$item[2]->id:'' }}">
                        <img src="{{ $item[2]?$item[2]->headimgurl:'/wap/images/headpic3.gif' }}" width="45" id="s12pic">
                    </a>
                </div>
                    <?php $i++?>
                    @if($i<2)
                            <div style="width:2.2%;float:left;">&nbsp;</div>
                        @endif

                @endforeach
            </div>
            <div style="width:100%;padding-top:5%;line-height:0.3rem;font-size:0.1rem;color:#77ccff" tag="第三层">
                @foreach($usergraph[1] as $item)
                    <div style="width:11%;float:left;">
                        <span id="s11uname">{{ $item[0]?$item[0]->name:'' }}</span><br><span id="s11ulevel">创业者M1</span>
                    </div>
                    <div style="width:11%;float:left;">
                        <span id="s12uname">{{ $item[1]?$item[1]->name:'' }}</span><br><span id="s12ulevel">创业者M1</span>
                    </div>
                    <div style="width:11%;float:left;">
                        <span id="s13uname">{{ $item[2]?$item[2]->name:'' }}</span><br><span id="s13ulevel">创业者M1</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{--<script>--}}
        {{--$('form').submit(function () {--}}
            {{--return false;--}}
        {{--});--}}
        {{--//团队分布数据--}}
        {{--s=[];--}}
        {{--s[1]=[];--}}
        {{--s[1][1]=[];--}}
        {{--s[1][2]=[];--}}
        {{--s[1][3]=[];--}}
        {{--s[2]=[];--}}
        {{--s[2][1]=[];--}}
        {{--s[2][2]=[];--}}
        {{--s[2][3]=[];--}}
        {{--s[3]=[];--}}
        {{--s[3][1]=[];--}}
        {{--s[3][2]=[];--}}
        {{--s[3][3]=[];--}}
        {{--s[1]['uname']='张学友';--}}
        {{--s[1]['ulevel']='1';--}}
        {{--s[1][1]['uname']='赵四';--}}
        {{--s[1][1]['ulevel']='1';--}}
        {{--s[1][2]['uname']='张三';--}}
        {{--s[1][2]['ulevel']='1';--}}
        {{--s[1][3]['uname']='刘能';--}}
        {{--s[1][3]['ulevel']='1';--}}

        {{--s[2]['uname']='张学友';--}}
        {{--s[2]['ulevel']='2';--}}
        {{--s[2][1]['uname']='赵四';--}}
        {{--s[2][1]['ulevel']='2';--}}
        {{--s[2][2]['uname']='张三';--}}
        {{--s[2][2]['ulevel']='2';--}}
        {{--s[2][3]['uname']='';--}}
        {{--s[2][3]['ulevel']='';--}}

        {{--s[3]['uname']='张学友';--}}
        {{--s[3]['ulevel']='3';--}}
        {{--s[3][1]['uname']='';--}}
        {{--s[3][1]['ulevel']='';--}}
        {{--s[3][2]['uname']='';--}}
        {{--s[3][2]['ulevel']='';--}}
        {{--s[3][3]['uname']='';--}}
        {{--s[3][3]['ulevel']='';--}}
        {{--for(a=1;a<=3;a++) {--}}
            {{--if (s[a]['uname']) {--}}
                {{--$('#s'+a+'uname').html(s[a]['uname']);--}}
                {{--$('#s'+a+'ulevel').html(s[a]['ulevel']);--}}
                {{--for (b=1;b<=3;b++){--}}
                    {{--if (s[a][b]['uname']) {--}}
                        {{--$('#s'+a+b+'uname').html(s[a][b]['uname']);--}}
                        {{--$('#s'+a+b+'ulevel').html(s[a][b]['ulevel']);--}}
                    {{--}else{--}}
                        {{--$('#s'+a+b+'uname').html(s[a][b]['uname']);--}}
                        {{--$('#s'+a+b+'ulevel').html(s[a][b]['ulevel']);--}}
                        {{--$('#s'+a+b+'pic').attr("src","/wap/images/blank2.png");--}}
                    {{--}--}}
                {{--}--}}
            {{--}else{--}}
                {{--$('#s'+a+'pic').attr("src","/wap/images/blank2.png");--}}
            {{--}--}}
        {{--}--}}

    {{--</script>--}}
@endsection