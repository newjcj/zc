@foreach($categorys as $category)
    <div class="list">
        <div class="l_top">{{ $category->name }}<span>>><a href="/wap/goods/list?id={{$category->id}}">更多</a></span></div>
        <div class="l_content">
            <?php $i=0?>
            @foreach($category->goods()->limit(6)->get() as $goods)
                <div class="goods">
                    <a href="/wap/goods/detail?id={{$goods->id}}">
                        <img src="{{ (explode(',',($goods->goodsimage)[0]->image))[0] }}" alt="">
                    </a>

                    <span class="name"><?php echo mb_substr($goods->name,0,5,'utf-8')."..."?></span><span class="price">￥{{$goods->price/100}}</span>
                </div>
            @endforeach

        </div>
    </div>
@endforeach