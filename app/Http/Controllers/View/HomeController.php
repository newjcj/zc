<?php
namespace App\Http\Controllers\View;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Goods;
use App\Models\Goodscategory;
use App\Models\Order;
use App\Models\Pay;
use App\Tool\Discuz;
use App\Tool\UUID;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity\M3result;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller{
    public function getIndex(Request $request)
    {
        Session::set('user',$request->input('aa'));
        return 33444;
        $goodss = Goods::all();
        $all=[];
        $i=0;
        $a=0;
        foreach ($goodss as $k=>$v) {
            if($a%6 == 0){
                $i++;
            }
            $a++;
            $all[$i-1][]=$v;
        }
//        print_r($all[0][2]);exit;
        return view('view.home.index',[
            'goods'=>$all,
        ]);
    }

    public function getIndex1(Request $request)
    {
        return Session::get('user');
    }
    //商品列表
    public function getList(Request $request)
    {
        $goodss = Goods::all();
        return view('view.home.list',[
            'goods'=>22222,
            'goodss'=>$goodss,
        ]);
    }
    //商品详情页
    public function getPage(Request $request)
    {
        $goods=Goods::find($request->input('id'));
        return view('view.home.page',[
            'goods'=>$goods,
        ]);
    }
    //添加购物车
    public function postAddcart(Request $request)
    {
        //如果用户登录了
        if($member = Session::get('member')){
            //查看这个商品有没有存过购物车
            if(Cart::where(['user_id'=>$member->id,'goods_id'=>$request->input('goodsid')])->first()){
                r(1,'保存成功','',['cartcount'=>Cart::where('user_id',$member->id)->count()]);
            }else{
                $cart = new Cart;
                $cart->user_id=$member->id;
                $cart->goods_id = $request->input('goodsid');
                $cart->num = $request->input('num',1);
                if($cart->save()){
                    r(1,'保存成功','',['cartcount'=>Cart::where('user_id',$member->id)->count()]);
                }else{
                    r(2,'保存失败');
                }
            }
        }else{
            //添加购物车到session
            $m3=new M3result();
            if(Cart::addCart($request->input('goodsid'),$request->input('num')) ){
                return $m3->build(1,'保存成功','');
            }else{
                return $m3->build(2,'保存失败');
            }
        }
    }
    //显示购物车页面
    public function getCar(Request $request)
    {
        //1.登录
        if(Session::get('member') != ''){
            $user = Session::get('member');
            $carts=Cart::where('user_id',$user->id)->get();
            return view('view.home.car',[
                'carts'=>$carts,
                'status'=>1,
            ]);
        }else{
            //2.没登录
            //有session购物车
            if( $scart = Session::get('cart') ){
                $carts = Cart::sessionGetCarts($scart);
                return view('view.home.car',[
                    'carts'=>$carts,
                    'status'=>2,
                ]);
            }else{
                //没有session购物车
                return view('view.home.car',[
                    'status'=>3,
                    ]);
            }
        }
    }
    //删除购物车里的东西
    public function postDeletecart(Request $request)
    {
        if( Cart::where(['goods_id'=>$request->input('id'),'user_id'=>Session::get('member')->id])->delete() ){
            r(1,'删除成功','');
        }else{
            r(0,'删除失败','');
        }
    }
    //购物车加数
    public function postAddcartnum(Request $request)
    {
        $cart = Cart::find($request->input('id'));
        $cart->num=$cart->num + 1;
        if ($cart->save()){
            r(1, '加数成功', '');
        }else{
            r(0, '加数失败', '');
        }
    }
    //购物车减数
    public function postSubcartnum(Request $request)
    {
        $cart = Cart::find($request->input('id'));
        if($cart->num<=1){
            r(2, '最少1件', '');
        }
        $cart->num=$cart->num - 1;
        if ($cart->save()){
            r(1, '减数成功', '');
        }else{
            r(0, '减数失败', '');
        }
    }
    //处理购物车提交
    public function postAddorders(Request $request)
    {
        //购物车提交到定单
        //跟据商家把所有商品分为以商家为单位的订单
        $shopgoods = Order::getOrder($request->input('goodsids'));
        //1.有登录
        if( Session::get('member') != '' ){
            //先保存sessioncart 到数据库cart
//            Order::saveScartTocart( $request->input('goodsids') );
            if( !Goods::goodssSave($shopgoods,Session::get('member')->id) ){
                r(0,'保存商品到订单失败');
            }else{
                r(1,'保存商品到订单成功');
            }
        }else{
            //2.没有登录
            //购物车加入到session
            Session::put('cart',trim($request->input('goodsids'),','));
            $m3=new M3result();
            return $m3->build(3,'购物车数据更新到session','/view/member/login');
        }

    }






}