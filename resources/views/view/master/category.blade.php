<div class="yHeader">
<div class="yNavIndex">
    <div class="pullDown">
        <h2 class="pullDownTitle"><i class="icon-class"></i>所有商品分类</h2>
        <ul class="pullDownList" style="{{  Request::is('view/home/index') ? '' : 'display:none' }}">
            @foreach($category as $kk=>$vv)
            <li class="">
                <i class="list-icon-1"></i>
                <a href="" target="_blank"><?php echo $vv['name'];?></a>
                <span></span>
            </li>
            @endforeach
            {{--<li>--}}
                {{--<i class="list-icon-2"></i>--}}
                {{--<a href="" target="_blank">女装</a>--}}
                {{--/<a href="" target="_blank">内衣</a>--}}
                {{--<span></span>--}}
            {{--</li>--}}
        </ul>
        <!-- 下拉详细列表具体分类 -->
        <div class="yMenuListCon">
            @foreach($category as $k=>$v)
            <div class="yMenuListConin">
                <div class="yMenuLCinList">
                    <h3><a href="" class="yListName">{{ $v['name'] }}</a><a href="" class="yListMore">更多 ></a></h3>
                    <p>
                        {{--<a href="" class="ecolor610">大牌上新</a>--}}
                        @foreach($v['category'] as $kk=>$vv)
                        <a href="">{{ $vv->name }}</a>
                        @endforeach
                    </p>
                </div>
            </div>
            @endforeach



        </div>

    </div>
    <ul class="yMenuIndex">
        <li><a href="/view/home/index" target="">首页</a></li>
        <li><a href="" target="_blank">云购物 </a></li>
        <li><a href="" target="_blank">限时购</a></li>
        <li><a href="" target="_blank">电器城</a></li>
        <li><a href="" target="_blank">家具城</a></li>
        <li><a href="" target="_blank">母婴专场</a></li>
        <li><a href="" target="_blank">数码专场1</a></li>
    </ul>
</div>
</div>
    <script>
        @if( !Request::is('view/home/index') )
        $('.pullDownTitle').mouseover(function(){
            $('.pullDownList').css({display:'block'});
        });
        $('.pullDownTitle').mouseleave(function(){
            $('.pullDownList').css({display:'none'});
        });
        $('.pullDownList').mouseover(function(){
            $('.pullDownTitle').mouseover();
        });
        $('.pullDownList').mouseleave(function(){
            $('.pullDownList').css({display:'none'});
        });
        $('.yMenuListCon').mouseover(function(){
            $('.pullDownList').mouseover();
        });
        $('.yMenuListCon').mouseleave(function(){
            $('.pullDownList').mouseleave();
        });
        $('.yMenuListCon').css({display:'none'});
        @endif
    </script>
