@if(count($goodss))
    @foreach($goodss as $item)
        <tr style="text-align: center">
            <td>{{$item->id}}</td>
            <?php $img=explode(',',($item->goodsimage)[0]->image);?>
            <td><img src="<?php echo count($item->goodsimage)?$img[0]:'';?>" alt="" style="width:60px;"></td>
            <td>{{$item->shop?$item->shop->name:''}}</td>
            <td>{{$item->name}}</td>
            @if($item->gift_lv)
                <td style="color:green">{{'礼包'.$item->gift_lv.'级'}}</td>
            @else
                <td>{{'普通商品'}}</td>
            @endif
            <td>{{$item->price}}</td>
            <td>{{$item->hot}}</td>
            <td>{{$item->is_ground==1 ? '上架' : '下架'}}</td>
            <td>{{ $item->is_hot==1 ? '热销' : '非热销' }}</td>
            <td style="text-align: center">
                <button type="button" class="btn btn-primary" onclick="location.href='/admin/goods/goods/edit?id={{$item->id}}'">编辑</button>
                <button type="button" class="btn btn-danger" onclick="_delete({{$item->id}})">删除</button>
            </td>
        </tr>
    @endforeach
@endif