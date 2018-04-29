<?php

namespace App\Models;

use App\Entity\M3result;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\Return_;

class Region extends Model
{
    protected $table = 'region';
    protected $primaryKey = 'REGION_ID';

    //得到省
    public static  function getProvince(){
      Return Region::where('PARENT_ID',"1")->lists('REGION_NAME','REGION_ID');
    }

    //得到市
    public static  function getCity($regionid){
        Return Region::where('PARENT_ID',$regionid)->lists('REGION_NAME','REGION_ID');
    }

    //得到区/县
    public static  function getArea($regionid){
        Return Region::where('PARENT_ID',$regionid)->lists('REGION_NAME','REGION_ID');
    }

    //通过区得到省市级
    public static function  getProvinceCity($regionid){
          $areaPid = Region::where('REGION_ID',$regionid)->value('PARENT_ID');
          $areaName = Region::where('REGION_ID',$regionid)->value('REGION_NAME');
          $cityPid = Region::where('REGION_ID',$areaPid)->value('PARENT_ID');
          $cityName = Region::where('REGION_ID',$areaPid)->value('REGION_NAME');
          $provinceName = Region::where('REGION_ID',$cityPid)->value('REGION_NAME');
//        $cityid = Region::where('REGION_ID',$regionid)->value('PARENT_ID');
//        $cityname = Region::where('REGION_ID',$regionid)->value('REGION_NAME');
//        $provinceid = Region::where('REGION_ID',$cityid)->value('REGION_ID');
//        $provincename = Region::where('REGION_ID',$cityid)->value('REGION_ID');
        $result = $provinceName.$cityName.$areaName;
        return $result;
    }

    //public $timestamps = false;
    //多对多关联
//    public function take()
//    {
//        return $this->belongsToMany('App\Models\Take','take_has_user')->withTimestamps()->withPivot('luck_number','id','ip','created_at','updated_at','status');
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
