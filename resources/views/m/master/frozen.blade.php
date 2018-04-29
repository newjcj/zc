<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<title>@yield('title')</title>
	<style src="/wap/frozen/css/frozen.css"></style>
	<script type="text/javascript" src="/admin/js/epii.js"></script>
	<script type="text/javascript" src="/admin/js/vue.js"></script>
	<script type="text/javascript" src="/view/js/min.js"></script>
	<script src="/admin/layui/layui.all.js"></script>
	<script src="/wap/frozen/js/frozen.js"></script>
	@yield('head')
</head>
<!--loading页开始-->
<div class="loading">
	<div class="loader">
		<div class="loader-inner pacman">
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
		</div>
	</div>
</div>
<!--loading页结束-->
<body>
<!--头部区域-->

<!--商品区域-->

@yield('content')


<!--尾部-->
@include('wap.master.footer')
</body>
@yield('script')
</html>
