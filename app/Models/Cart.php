<?php

namespace App\Models;

use App\Entity\M3result;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Cart extends Model
{
    protected $table = 'cart';
    protected $primaryKey = 'id';

    public function goods()
    {
        return $this->belongsTo('App\Models\Goods');
    }


    //取这个商品的购物车总数 没有反回false
    public static function getGoodscartnum($goodsid)
    {
        $user = Session::get('member');
        //有登录
        if(!$user){
            //判断这个商品有没有在session购物车
            return self::goodsIsInSession($goodsid);
        }else{
            //没有登录
            //判断这个商品有没有在数据库购物车
            if($cart = Cart::where(['user_id'=>$user->id,'goods_id'=>$goodsid])->first() ){
                return $cart->num;
            }else{
                return false;
            }
        }

    }

    //取这个商品在session的num  没有返回false
    public static function goodsIsInSession($goodsid)
    {
        if($cart = Session::get('cart')){
            $sgoodsarr=self::scartTocart($cart);
            foreach ($sgoodsarr as $sgoods) {
                if($sgoods['ids'] == $goodsid){
                    return $sgoods['num'];
                }
            }
            return false;
        }else{
            return false;
        }
    }

    //取所有的购物车的商品id数组
    public static function getCartArrIds($goodsids)
    {
        $re=[];
        foreach ($goodsids as $k=>$v) {
            $re[]=$v['ids'];
        }
        return $re;
    }

    //取我的购物车数量
    public static function getCartnum()
    {
        if($member = Session::get('member')){
            return Cart::where(['user_id'=>$member->id])->count();
        }else{
            if($scart = Session::get('cart') ){
                return count(Cart::scartTocart($scart));
            }else{
                return 0;
            }
        }
    }
    //通过sessioncart 组成显数据
    public static function sessionGetCarts($scart)
    {
        $cartarr = self::scartTocart($scart);
        $cartarr_re=[];
        foreach ($cartarr as $k=>$v) {
            $cartarr_re[$k]['num'] = $v['num'];
            $cartarr_re[$k]['goods'] = Goods::find($v['ids']);
        }
        return $cartarr_re;
    }
    //sessioncart 转成购物车数组
    public static function scartTocart($scart)
    {
        $goodsone=[];
        $goodsids = explode(',',trim($scart,','));//数据格式是87:15,95:1,88:3,
        foreach($goodsids as $k=>$v){
            $goodsone[$k]['ids'] = (explode(':',$v))[0];
            $goodsone[$k]['num'] = (explode(':',$v))[1];
        }
        return $goodsone;
    }
    //购物车数组转sessioncart
    public static function cartToscart($cartarr)
    {
        $str = '';
        foreach ($cartarr as $k=>$v) {
            $str.=$v['ids'].':'.$v['num'].',';
        }
        return trim($str,',');
    }

    //添加购物车到session
    public static function addCart($goodsid='',$num=1){
        //已经有了购物车session
        $scart = Session::get('cart');
//        print_r($scart);exit;
        if($scart){
            //如果已经存在这个商品则加1
            $stu=false;
            $cartarr=self::scartTocart($scart);
            foreach ($cartarr as $k=>&$v) {
                if($v['ids'] == $goodsid){
                    $v['num'] = $v['num']+$num;
                    $stu=true;
                }
            }
            if(!$stu){
                //追 加到sessioncart
                Session::put('cart',trim($scart,',').','.$goodsid.":".$num);
                return true;
            }else{
                Session::put('cart',self::cartToscart($cartarr));
                return true;
            }
            //不存在新增
        }else{
            //没有购物车session
            $cart = $goodsid.":".$num.",";
            Session::put('cart',trim($cart,','));
            return true;
        }
    }


}
