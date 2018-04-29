{{--<header id="header" style="">--}}
{{--<div class="topbar">--}}
{{--<a href="javascript:history.back();" class="back_btn"><i class="iconfont">?</i></a>--}}
{{--<h1 class="page_title">会员中心</h1>--}}
{{--</div>--}}
{{--</header>--}}
<!-- 会员头像 -->
<div style="background:url(../images/ctopbg.png);width:100%;height:160px;background-size:100% 100%;margin-bottom:16px;">
    <div style="position:absolute;right:5%;top:20px;"><img src="../images/cset.png" width="20"></div>
    <div style="position:absolute;left:6%;top:40px;"><img src="{{$user->headimgurl!='' ? $user->headimgurl:'/wap/images/login1.png'}}" style="width:80px;border-radius:40px;border:solid 2px #fff;"></div>
    <div style="position:absolute;left:130px;top:45px;font-size:0.45rem;font-weight:200;">{{$user->real_name!='' ? $user->real_name:'未实名认证'}}</div>
    <div style="position:absolute;left:130px;top:80px;font-size:12px;color:#fff;background:url(../images/clvbg.png) no-repeat;line-height:20px;background-size:100%;width:45px;text-indent:7px;">{{$user->m_level}}&nbsp;&nbsp;M{{$user->m_level}}</div>
    <div style="position:absolute;right:0;top:70px;font-size:12px;color:#fff;background:url(../images/crightman.png) no-repeat;line-height:20px;background-size:100%;width:80px;text-indent:12px;">等级特权 ></div>

    <div style="position:absolute;left:130px;top:110px;font-size:12px;font-weight:700;background:#fff;opacity:0.6;border-radius:10px;height:20px;width:100px;text-align:center;"><span id="realname">邀请人：</span></div>
</div>
