<?php

namespace App\Models;

use App\Entity\M3result;
use App\Http\Requests\Request;
use App\Tool\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Goods extends Model
{
    protected $table = 'goods';
    protected $primaryKey = 'id';

    //项目状态
    public static function status($goodsid)
    {
        $goods = Goods::find($goodsid);
        if($goods->status ==1){
            return 1;//完成
        }
        $starttime = strtotime($goods->created_at);
        $time = $goods->project_time;
        if( ($starttime+$time) < time() ){
            return 2;//过期
        }
        return 3;//进行中
    }

    public function getTimesAttribute()
    {
        $time= strtotime($this->updated_at)+$this->project_time;
        return date('Y-m-d H:i:s',$time);
    }
    //取所有没有过期的项目
    public static function getAlltimeok($page)
    {
        $goodss = Goods::whereNotNull('id')->offset(($page-1)*10)->limit(10)->orderBy('id','desc')->get();
        $re=[];
        foreach ($goodss as $goods) {
            $starttime = strtotime($goods->created_at);
            $time = $goods->project_time;
            //项目到期时间设置
            $goods->times=date('Y-m-d H:i:s',$starttime+$time);
            if( ($starttime+$time) > time() ){
                $goods->overtime = 0;
            }else{
                $goods->overtime = 1;
            }
        }
        return $goodss;
    }
    //取所有没有过期的项目
    public static function getOnetimeok($id)
    {
        $goodss = Goods::where('id',$id)->orderBy('id','desc')->get();
        $re=[];
        foreach ($goodss as $goods) {
            $starttime = strtotime($goods->created_at);
            $time = $goods->project_time;
            //项目到期时间设置
            $goods->times=date('Y-m-d H:i:s',$starttime+$time);
            if( ($starttime+$time) > time() ){
                $goods->overtime = 0;
            }else{
                $goods->overtime = 1;
            }
        }
        return $goodss;
    }
    //项目进度接口
    public static function progress($goodsid)
    {
        $goods = Goods::find($goodsid);
        return Usergoods::where('goods_id',$goodsid)->sum('price') / $goods->price * 100;
    }
    //加入数据属性first_img
    public function getFirstImgAttribute($value)
    {
        return self::getGoodsimages($this)[0];
    }
    /**
     * @param $goods
     * @return array
     * 取一个商品的图片
     */
    public static function getGoodsimages($goods)
    {
        return explode(',',($goods->goodsimage)[0]->image);
    }
    public function orders(){
        return $this->belongsToMany('App\Models\Order','order_goods')->withPivot('num');
    }
    //保存多个商品到订单
    public static function goodssSave($goodss,$userid)
    {
        //把之前的购物车提交的订单的默认选中状态去掉
        Order::where('id','>=',1)->where('user_id',$userid)->update(['cart_choice'=>0]);
        //先保存到order   再保存到order_goods
        foreach ( $goodss as $k=>$v) {
            $order = new Order;
            $order->orderuuid = UUID::orderid();//订单号
            $order->user_id=User::getUser()->id;
            $order->shop_id=$k;
            $order->cart_choice=1;//设置为默认选中的订单
            if( $order->save() ){
//                写入cart_goods
                $pricenum = 0;
                $allnum = 0;
                foreach($v as $goodsid){
                    //每个商品的id
                    $ordergoods = new Ordergoods;
                    $goods = Goods::find($goodsid['id']);
                    $pricenum+=($goods->price*$goodsid['num']);//所有的这个订单的总价格
                    $allnum+=($goodsid['num']);//所有的这个订单的总价格
                    $ordergoods->order_id=$order->id;
                    $ordergoods->goods_id = $goodsid['id'];
                    $ordergoods->num = $goodsid['num'];
                    if(!$ordergoods->save()){
                        return false;
                    }
                    //计算所有的这个订单的商品的总价格写到order表
                    Order::where('id',$order->id)->update(['price'=>$pricenum,'num'=>$allnum]);
                    //同时清除购物车
                    Cart::where(['goods_id'=>$goodsid['id'],'user_id'=>Session::get('member')->id])->delete();
                }
            }
        }
        return true;

    }




    //public $timestamps = false;
    //多对多关联
//    public function take()
//    {
//        return $this->belongsToMany('App\Models\Take','take_has_user')->withTimestamps()->withPivot('luck_number','id','ip','created_at','updated_at','status');
//    }

//一对多与活到关联
    public function goodsimage()
    {
        return $this->hasMany('App\Models\Goodsimage');
    }
    //一对多与活到关联
    public function goodscategory()
    {
        return $this->belongsTo('App\Models\Goodscategory');
    }
    //多对多
    public function users()
    {
        return $this->belongsToMany('App\Models\User','user_goods')->withPivot(['created_at','id','price','btcprice','payback']);
    }

    public function getImage($imgarray=[])
    {
//        foreach( $imgarray as $k=>$v){
//            if( !$v )
//                unset( $imgarray[$k] );
//        }
        if(count($imgarray)>0){
            return implode(',',$imgarray);
        }else{
            return '';
        }
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function shop(){
        return $this->belongsTo('App\Models\Shop');
    }
    //多个cart
    public function cart(){
        return $this->hasMany('App\models\Cart');
    }

//    //一对多与活到关联
//    public function orders()
//    {
//        return $this->hasMany('App\Models\Orders');
//    }
//    //一对多与活到关联
//    public function pay()
//    {
//        return $this->hasMany('App\Models\Pay');
//    }
//    //一对多与活到关联
//    public function sharecreate()
//    {
//        return $this->hasMany('App\Models\Share','user_create_id');//方法来重写外键与本地键：
//    }
//    //一对多与活到关联
//    public function bank()
//    {
//        return $this->hasMany('App\Models\Bank');//方法来重写外键与本地键：
//    }
//
//    //多对多
//    public function share()
//    {
//        return $this->belongsToMany('App\Models\Share','user_has_share')->withTimestamps()->withPivot('user_id','share_id','status','created_at','updated_at');
//    }
//
//    //设置user cookie信息
//    public static function setUser($user)
//    {
//        $user->ip = $_SERVER["REMOTE_ADDR"];
//        Session::set('user',$user);
//    }
//    //取用户所有购买的价格
//    public static function getTotalprice($userid)
//    {
//        $orders=Orders::where('user_id',$userid)->where('status','3')->get();
//        $totalprice=0;
//        foreach ($orders as $order) {
//            $orderpack=Orderpack::where('orders_id',$order->id)->get();
//            if(count($orderpack)){
//                foreach ($orderpack as $v) {
//                    $totalprice += $v->pack->price * $v->total;
//                }
//            }else{
//                $totalprice=0;
//            }
//        }
//        return $totalprice;
//    }
}
