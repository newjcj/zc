<?php
namespace App\Http\Controllers\Wap;
use App\Entity\Kdn;
use App\Models\Cart;
use App\Models\Express;
use App\Models\Goods;
use App\Models\Goodscategory;
use App\Models\Order;
use App\Models\Ordergoods;
use App\Models\Region;
use App\Models\Shop;
use App\Models\User;
use App\Models\Useraddress;
use App\Tool\Discuz;
use App\Tool\SMS\Sendsms;
use App\Tool\UUID;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity\M3result;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Log;

class OrderController extends Controller{

    //删除购物车里的东西
    public function postDeletecart(Request $request)
    {
        if(Cart::find($request->input('id'))->delete()){
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
        $user=Session::get('user');
        $goodsids=explode(',',trim($request->input('goodsids'),','));
        //跟据商家把所有商品分为以商家为单位的订单
        $shopgoods = Order::getOrder($goodsids);
        //购物车存进order_goods
        if( !Goods::goodssSave($shopgoods,$user->id) ){
            r(0,'保存商品到订单失败');
        }else{
            r(1,'保存商品到订单成功');
        }
    }

    //购物车提交到订单的页面
    public function getCarttoorder(Request $request){
        $user = Session::get('member');
        //取所有的订单
        $orders = Order::where('user_id',$user->id)->orderBy('cart_choice','desc')->get();
        return view('wap.order.carttoorder',['orders'=>$orders]);
    }
    //删除一个订单
    public function postDel(Request $request)
    {
        $order = Order::find($request->input('id'));
        if($order->delete()){
            r(1, '删除成功');
        }else{
            r(0,'删除失败');
        }
    }
    ////判断如果有礼包则用户等级要大于礼包等级
    public function postIsgreater(Request $request)
    {
        $u = User::getUser();
        $orders=explode(',',trim($request->input('orders'),','));//订单组数组
        $orders = Order::whereIn('id',$orders)->get();
        foreach ($orders as $order) {
            foreach ($order->goodss as $goods) {
                //如果有一个商品是礼包等级小于用户等级就不能购买
                if($goods->gift_lv>0){
                    if($goods->gift_lv < $u->m_level){
                        r(0,'欲购买的礼包等级低于您的现有等级，无法购买','');
                        //return;
                    }
                }
            }
        }
        r(1,'都可以购买','');
    }
    //选择支付方式
    public function getPayway(Request $request)
    {
        $orders=explode(',',trim($request->input('orders'),','));//订单组数组
        //所有的订单价格
        $allorderprice = Order::getOrderTotalPrice($orders);
        //积分抵消判断
        $shopcoin=Session::get('member')->shop_coin*1;//商城积分
        if($shopcoin>$allorderprice/100){
            $usecoin=$allorderprice/100;
        }else{
            $usecoin=$shopcoin/100;
        }
        $needpaymoney=$allorderprice-$usecoin;
        return view('wap.order.payway',[
            'orders'=>$request->input('orders'),//订单组用，号分隔
            'allorderprice'=>$allorderprice,
            'usecoin'=>$usecoin,
            'needpaymoney'=>$needpaymoney,//剩余应付金额
            'user'=>User::getUser(),
        ]);
    }
    //确认订单
    public function getConfirm(Request $request)
    {
        $user=Session::get('member');
        $orders = Order::whereIn('id',explode(',',trim($request->input('orders'),',')))->get();
        $orders1 = Order::where('id',$request->input('orders'))->first();
        $useraddress = Useraddress::where(['user_id'=>$user->id,'is_choice'=>1])->where('status','!=','1')->first();
        //将地址插入到order表里面
        if(count($useraddress)){
            $orders1->useraddress_id = $useraddress->id;
            $orders1->save();
        }

        return view('wap.order.confirm',[
            'ordersid'=> $request->input('orders'),
            'user'=>$user,//用户剩余的积分
            'orders'=>$orders,
            'useraddress'=>$useraddress,
            'ordersarr'=>explode(',',trim($request->input('orders'),','))
        ]);
    }
    //确认订单（直接购买的）
    public function getConfirm1(Request $request)
    {
        $user = Session::get('member');
        $goods = Goods::find($request->input('goodsid'));
        Order::where('user_id',$user->id)->update(['cart_choice'=>0]);
        //直接提交订单存order 和ordergoods
        $order = new Order;
        $order->user_id=$user->id;
        $order->orderuuid=UUID::orderid();
        $order->price=$goods->price;
        $order->num=1;
        $order->cart_choice=1;//最近一次的提交
        $order->save();
        $ordergoods = new Ordergoods();
        $ordergoods->goods_id=$goods->id;
        $ordergoods->order_id=$order->id;
        $ordergoods->num=1;
        $ordergoods->save();


        $orders = [Order::find($order->id)];
        $useraddress = Useraddress::where(['user_id'=>$user->id,'is_choice'=>1])->where('status','!=','1')->first();
        return view('wap.order.confirm',[
            'ordersid'=> $orders[0]->id,
            'user'=>$user,//用户剩余的积分
            'orders'=>$orders,
            'useraddress'=>$useraddress,
            'ordersarr'=>[$order->id]
        ]);
    }



}