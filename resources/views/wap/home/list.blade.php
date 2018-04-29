@extends('wap.master.index')
@section('title',111)
@section('head')

@endsection

@section('content')
	<div class="warp clearfloat">
		<div class="lists clearfloat">
			<div class="top clearfloat">
				<ul>
					<li>默认</li>
					<li>价格<i class="iconfont icon-xiala"></i></li>
					<li>销量<i class="iconfont icon-xiala"></i></li>
				</ul>
			</div>
			<div class="bottom clearfloat">
				@if(count($goods)>1)
					@foreach($goods as $item)
						<div class="lie clearfloat">
							<a href="/wap/page?id={{$item->id}}">
								<div class="tu clearfloat fl">
									<img src="{{(\App\Models\Goods::getGoodsimages($item))[0]}}"/>
								</div>
							</a>
							<div class="right clearfloat fl">
								<a href="/wap/page?id={{$item->id}}">
									<p class="tit">{{$item->name}}</p>
								</a>
								<div class="xia clearfloat">
									<a href="/wap/page?id={{$item->id}}">
										<p class="jifen fl over"><span>价格:</span><span class="over db red">{{$item->price/100}}</span></p>
									</a>

								</div>
							</div>
						</div>
					@endforeach
				@else

					<div class="lie clearfloat">
						该类目下没有商品
					</div>
				@endif
			</div>
		</div>
	</div>
@endsection

@section('script')

@endsection