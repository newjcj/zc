<!--尾部-->
<footer class="page-footer fixed-footer" id="footer" style=" height: auto;">
    <ul>
        <li class="{{ Request::is('wap/home/index') ?'active':'' }}">
            <a href="/wap/home/index">
                <i class="iconfont icon-shouye"></i>
                <p>首页</p>
            </a>
        </li>
        <li class="{{ Request::is('wap/goods/category') ?'active':'' }}">
            <a href="/wap/goods/category">
                <i class="iconfont icon-icon04"></i>
                <p>分类</p>
            </a>
        </li>
        <li class="{{ Request::is('wap/goods/car') ?'active':'' }}">
            <a href="/wap/goods/car">
                <i class="iconfont icon-gouwuche"></i>
                <p>购物车</p>
            </a>
        </li>
        <li class="{{ Request::is('wap/user/center') ?'active':'' }}">
            <a href="/wap/user/center">

                <i class="iconfont icon-yonghuming"></i>
                <p>我的</p>
            </a>
        </li>
    </ul>
</footer>