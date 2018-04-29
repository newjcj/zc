<?php

namespace App\Models;

use App\Entity\M3result;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Order extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'id';

    public function goodss(){
        return $this->belongsToMany('App\Models\Goods','order_goods')->withPivot(['num','status','id','evaluate_status','evaluate','evaluate_rank']);
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    //取一个定单下所有的商品的价格
    public static function getOrderTotalPrice($orderid)
    {
        $num=0;
        if(!is_array($orderid)){
            $order = Order::find($orderid);
            foreach ($order->goodss as $goods) {
                $num+= $goods->price * $goods->pivot->num;
            }
            return $num;
        }else{
            foreach ($orderid as $id) {
                $order = Order::find($id);
                foreach ($order->goodss as $goods) {
                    $num+= $goods->price * $goods->pivot->num;
                }
            }
            return $num;
        }

    }
    //跟据商家把所有商品分为以商家为单位的订单
    public static function getOrder($goodsids)
    {
        $goodsone=[];
        $goodsids = explode(',',trim($goodsids,','));//数据格式是87:15,95:1,88:3,
        foreach($goodsids as $k=>$v){
            $goodsone[$k]['ids'] = (explode(':',$v))[0];
            $goodsone[$k]['num'] = (explode(':',$v))[1];
        }
        $arr = [];
        $re = [];//key是userid,value是goodsids
        foreach ($goodsone as $goodsid) {
            $goods=Goods::find($goodsid['ids']);
            $arr[]=$goods->shop->user_id;
        }
        $arrs=array_unique($arr);
        $i=0;
        foreach ($arrs as $userid) {
            foreach ($goodsone as $k=>$goodsid) {
                $goods=Goods::find($goodsid['ids']);
                if($goods->shop->user_id == $userid){
                    $re[$userid][$i]['id'] = $goods->id;
                    $re[$userid][$i]['num'] = $goodsone[$k]['num'];
                    $i++;
                }
            }
        }
        //没空提交的购物车
        return $re;//['商家id'=>[['id'=>1,'num'=>5],[]]]
    }


    //session购物车保存到数据库的购物车
    public static function saveScartTocart($goodsids)
    {
        $user = Session::get('member');
        $goodsone=[];
        $goodsids = explode(',',trim($goodsids,','));//数据格式是87:15,95:1,88:3,
        foreach($goodsids as $k=>$v){
            $goodsone[$k]['ids'] = (explode(':',$v))[0];
            $goodsone[$k]['num'] = (explode(':',$v))[1];
        }
        //取出当前用户所有的数据库里的购物车
        $carts = Cart::where('user_id',$user->id)->get();
        if(count($carts)){
            foreach($carts as $k=>$v){
                if(count($goodsone)){
                    foreach ($goodsone as $kk=>$vv) {
                        //对比session购物车与数据库购物车 相同的商品则数目相加
                        if($vv['ids'] == $v->goods_id){
                            $v->num=$v->num+$vv['num'];
                            $v->save();
                            //删除session购物车数组中的这个商品
                            unset($goodsone[$kk]);
                        }
                    }
                }else{
                    break;
                }
            }
            //session购物车与数据库购物车对比完如果还有商品则新加
            if(count($goodsone)){
                foreach ($goodsone as $k=>$v) {
                    $addcart = new Cart();
                    $addcart->goods_id=$v['ids'];
                    $addcart->user_id=$user->id;
                    $addcart->num=$v['num'];
                    $addcart->save();
                }
                return true;
            }
            return true;
        }else{
            //没有购物车则直接加到购物车
            foreach ($goodsone as $k=>$v) {
                $addcart = new Cart();
                $addcart->goods_id=$v['ids'];
                $addcart->user_id=$user->id;
                $addcart->num=$v['num'];
                $addcart->save();
            }
            return true;
        }
    }
    //订单组字符转数组
    public static function posersarray($orders)
    {
        return explode(',',trim($orders,','));
    }

    //一对一反向到address
    public function useraddress()
    {
        return $this->belongsTo('App\Models\Useraddress');
    }
    //一对多反向到pay
    public function pay()
    {
        return $this->belongsTo('App\Models\Pay');
    }
    //一对多反向到pay
    public function shop()
    {
        return $this->belongsTo('App\Models\Shop');
    }



}
