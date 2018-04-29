<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return redirect('/view/home/index');
});
Route::get('/manage', function () {
    return redirect('/admin/goods/goods/index');
});
Route::get('/ht', function () {
    return redirect('/admin/goods/goods/index');
});

Route::get('/car', function () {
    return redirect('/view/home/car');
});

Route::get('/repaire', function () {
    return view('view.errors.repaire');
});


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //后台
    Route::controller('test','TestController');//测试
    Route::controller('api','ApiController');//api
    //用户模块
    Route::controller('admin/user/login','Admin\User\LoginController');
    //用户模块
    Route::group(['prefix'=>'admin','middleware'=>['check.login']],function(){
        Route::group(['prefix'=>'user'],function(){

        });
        //商品模块
        Route::group(['prefix'=>'goods'],function(){
            Route::Controller('goods','Admin\Goods\GoodsController');
            Route::Controller('category','Admin\Goods\CategoryController');
        });
        //客服模块
        Route::group(['prefix'=>'orderwork'],function(){
            Route::Controller('orderwork','Admin\Orderwork\OrderworkController');
        });

        //会员模块
        Route::group(['prefix'=>'user'],function(){
            Route::Controller('user','Admin\User\UserController');
            Route::Controller('member','Admin\User\MemberController');
        });

        //顶部广告图片模块
        Route::group(['prefix'=>'topimage'],function(){
            Route::Controller('topimage','Admin\Topimage\TopimageController');
        });

        //顶部供应商审批模块
        Route::group(['prefix'=>'shop'],function(){
            Route::Controller('shop','Admin\Shop\ShopController');
        });

        //订单模块
        Route::group(['prefix'=>'order'],function(){
            Route::Controller('order','Admin\Order\OrderController');
        });

        //资源模块
        Route::group(['prefix'=>'dist'],function(){
            Route::Controller('dist','Admin\Dist\DistController');
        });

        //日志模块
        Route::group(['prefix'=>'log'],function(){
            Route::Controller('log','Admin\Log\LogController');
        });

    });


    //pc端前台
    Route::group(['prefix'=>'view'],function(){
        Route::group(['middleware' => ['view']],function(){
            //要加中间件的
            //用户中心
            Route::Controller('member','View\MemberController');
        });
        //首页模块
        Route::Controller('home','View\HomeController');
    });
    //手机端前台
    Route::group(['prefix'=>'wap'],function(){
        //登录模块
        Route::Controller('login','Wap\LoginController');
        Route::Controller('wlogin','Wap\WloginController');//微信登录模块
        //要加中间件的
        Route::group(['middleware'=>['wapcheck.login']],function() {
            //用户中心模块
            Route::Controller('user','Wap\UserController');
            //订单模块
            Route::Controller('order','Wap\OrderController');
        });
        //首页模块
        Route::Controller('home','Wap\HomeController');
        //商品模块
        Route::Controller('goods','Wap\GoodsController');
        //支付模块
        Route::Controller('pay','Wap\PayController');
        //工单模块
        Route::Controller('orderwork','Wap\OrderworkController');
    });
});
Route::post('service/upload/{type}/{userid}','Service\UploadController@uploadFile');//上传图片
Route::get('service/img','Service\ApiController@img');//
