<?php

namespace App\Models\Entity;

use App\Entity\M3result;
use App\Models\Order;
use App\Models\Pay;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Log;

//支付方式类
class Payway extends Order
{
    //支付方式 1积分支付 2余额支付 3积分和余额一起支付 4积分和微信一起支付 5积分和支付宝 6余额和微信 7余额和支付宝 8积分和余额和微信一起支付 9积分和余额和支付宝一起支付
    //10微信支付 11支付宝支付
    public $payway=1;//支付方式
    public $price=0;//订单总价格
    public $balance=0;//余额
    public $integral=0;//积分
    public $payid='';//订单组，号分
    public $pay='';
    public $user='';
    public function __construct($userid='999',$payway,$price,$balance,$integral,$payid=''){
//        parent::__construct();
        $this->user=User::find($userid);
        $this->payway=$payway;
        $this->price=$price;
        $this->balance=$balance;
        $this->integral=$integral;
        $this->payid=$payid;
        ($payid == '') ?:$this->pay=Pay::where('id',$payid);
    }

    //对订单的处理（在支付回调处理或直接处理）
    public function handle()
    {
        //设置用户购物赚取的金额
        $this->earn();
        $user = User::find(Session::get('member'));
        //写入订单使用的积分余额和支付的价格
        switch($this->payway){
            case 1:
                $this->pay->update([
                    'integral'=>$this->price,
                    'balance'=>0,
                ]);
                $user->decrement('integral',$this->price());
                return true;
                break;
            case 2:
                $this->pay->update([
                    'integral'=>0,
                    'balance'=>$this->price,
                ]);
                $user->decrement('balance',$this->price());
                return true;
                break;
            case 3:
                $this->pay->update([
                    'integral'=>(($this->integral-$this->price) >= 0) ? $this->price : ( $this->integral ),
                    'balance'=>(($this->integral-$this->price) >= 0) ? 0 : ($this->price-$this->integral ),
                ]);
                $user->decrement('integral',(($this->integral-$this->price) >= 0) ? $this->price : ( $this->integral ));
                $user->decrement('balance',(($this->integral-$this->price) >= 0) ? 0 : ($this->price-$this->integral ));
                return true;
                break;
            case 4:
                $this->pay->update([
                    'integral'=>$this->integral,
                    'balance'=>0,
                ]);
                $user->decrement('integral',$this->integral);
                return true;
                break;
            case 5:
                $this->pay->update([
                    'integral'=>$this->integral,
                    'balance'=>0,
                    'status'=>1,//支付宝支付
                ]);
                $user->decrement('integral',$this->integral);
                return true;
                break;
            case 6:
                $this->pay->update([
                    'integral'=>0,
                    'balance'=>$this->balance,
                ]);
                $user->decrement('balance',$this->balance);
                return true;
                break;
            case 7:
                $this->pay->update([
                    'integral'=>0,
                    'balance'=>$this->balance,
                    'status'=>1,//支付宝支付
                ]);
                $user->decrement('balance',$this->balance);
                return true;
                break;
            case 8:
                $this->pay->update([
                    'integral'=>$this->integral,
                    'balance'=>$this->balance,
                ]);
                $user->decrement('integral',$this->integral);
                $user->decrement('balance',$this->balance);
                return true;
                break;
            case 9:
                $this->pay->update([
                    'integral'=>$this->integral,
                    'balance'=>$this->balance,
                    'status'=>1,//支付宝支付
                ]);
                $user->decrement('integral',$this->integral);
                $user->decrement('balance',$this->balance);
                return true;
                break;
        }
    }

    ////设置用户购物赚取的金额
    public function earn()
    {
        $this->user->increment('money',$this->getAllprice());
    }

    //取用户购物赚取的金额
    public function getAllprice()
    {
        $price = 0;
        foreach ($this->getAllorder() as $order) {
            foreach ($order->goodss as $goods) {
                Log::info('jcj1');
                Log::info($price);
                $price+=$goods->gain_price*$goods->pivot->num;
            }
        }

        return $price;
    }
    //通过payid 取所有的订单
    public function getAllorder()
    {
        $order = new Order;
        return $order->where('orderpuuid',$this->pay->first()->out_trade_no)->get();
        Log::info('jcj1');
        Log::info(count($order->where('orderpuuid',$this->pay->first()->out_trade_no)->get()));
    }

    //计算一个订单用某种支付方式实际要付款的金额
    public function price()
    {
        switch ($this->payway){
            case 1:
                return 0;
                break;
            case 2:
                return 0;
                break;
            case 3:
                return 0;
                break;
            case 4:
                return $this->price-$this->integral;
                break;
            case 5:
                return $this->price-$this->integral;
                break;
            case 6:
                return $this->price-$this->balance;
                break;
            case 7:
                return $this->price-$this->balance;
                break;
            case 8:
                return $this->price-$this->integral-$this->balance;
                break;
            case 9:
                return $this->price-$this->integral-$this->balance;
                break;
            case 10:
                return $this->price;
                break;
            case 11:
                return $this->price;
                break;
        }
    }


    //跟据支付方式判断够不够
    public function isOk()
    {
        switch ($this->payway){
            case 1:
                return ($this->integral >= $this->price) ?1:'积分不够';
                break;
            case 2:
                return ($this->balance >= $this->price) ?1:'余额不够';
                break;
            case 3:
                return (($this->balance+$this->integral) >= $this->price) ?1:'积分加加余额不够';
                break;
            default :
                return 1;
        }
    }





}
