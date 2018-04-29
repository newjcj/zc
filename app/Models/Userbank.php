<?php

namespace App\Models;

use App\Entity\M3result;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Userbank extends Model
{
    protected $table = 'user_bank';
    protected $primaryKey = 'id';


    //多对多
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }


//一对多与活到关联
//    public function address()
//    {
//        return $this->hasMany('App\Models\Address');
//    }
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
