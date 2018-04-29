<?php

namespace App\Models;

use App\Entity\Curl;
use App\Entity\M3result;
use App\Models\Entity\Payway;
use App\Tool\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Overtrue\Wechat\Payment\Business;
use Overtrue\Wechat\Payment;
use App\Tool\Discuz;
use Overtrue\Wechat\Payment\Notify;
use Overtrue\Wechat\Payment\UnifiedOrder;
use Log;

class Pay extends Model
{
    protected $table = 'pay';
    protected $primaryKey = 'id';

    public function orders(){
        return $this->hasMany('App\Models\Order');
    }

    /**
     * 微信h5支付
     * @param $out_trade_no
     * @param $openid
     * @param $amount
     * @return \成功时返回，其他抛异常
     */
    public static function orderwh5($out_trade_no, $openid,$amount,$attach)
    {

        $order = new \App\Tool\wh5\Order([
            //公众账号ID
            'APP_ID' => config('wechat.app_id'),
            //商户ID
            'MCH_ID' => config('wechat.mchId'),
            //支付密钥
            'KEY' => config('wechat.mchKey'),
            //私钥证书地址(通信使用证书才需要配置)
            'sslkey_path' => '',
            //公钥证书地址(通信使用证书才需要配置)
            'sslcert_path' => '',
            //设备ID
            'device_info' => 'WEB',
            //回调地址
            'notify_url' => 'http://'.$_SERVER['HTTP_HOST'].'/wap/pay/wnotify',
            //下单接口
            'unifiedorder_url' => 'https://api.mch.weixin.qq.com/pay/unifiedorder',
            //订单查询接口
            'orderquery_url' => 'https://api.mch.weixin.qq.com/pay/orderquery',
            //订单关闭接口
            'closeorder_url' => 'https://api.mch.weixin.qq.com/pay/closeorder',
        ]);
        $order->setParams([
            'body' => '瑞克斯',
            'out_trade_no' => $out_trade_no,
            'total_fee' => $amount,
             'attach' => $attach, // 原样返回的参数string127
            'trade_type' => 'MWEB',
            'device_info' => 'WEB',
            'spbill_create_ip' => $_SERVER['REMOTE_ADDR'],
            'notify_url' => 'http://'.$_SERVER['HTTP_HOST'].'/wap/pay/wnotify',
            'scene_info' => '{"h5_info": {"type":"Wap","wap_url": "http://t1.rexmall11.com","wap_name": "购物"}}'
        ]);
        $res = $order->unifiedorder();
        return $res."&redirect_url=".config('wechat.redirect_url');
    }
    //支付地址过期处理
    public static function timeout()
    {
        $payaddress = Payaddress::all();
        foreach ($payaddress as $item) {
            $time = (time() - strtotime($item->created_at)) /60;
            if($time > 10){
                $item->user_id='';
                $item->goods_id='';
                $item->price='';
                $item->btcprice='';
                $item->save();
            }
        }
    }
    public static function orderwxf($out_trade_no, $openid,$amount,$attach)
    {
        /**
         * 第 1 步：定义商户1
         */
            $business = new Business(
                config('wechat')['app_id'],
                config('wechat')['secret'],
                config('wechat')['mchId'],
                config('wechat')['mchKey']
            );

        /**
         * 第 2 步：定义订单2
         */
            $order = new Payment\Order();
            $order->body = 'order';
            $order->out_trade_no = $out_trade_no;//一个订单组唯一标识
            $order->total_fee = $amount; // 单位为 “分”, 字符串类型 meilihua
            $order->attach = $attach; // 原样返回的参数string127
            $order->openid = $openid;
            $order->trade_type = 'JSAPI';
            $order->notify_url = 'http://'.$_SERVER['HTTP_HOST'].'/wap/pay/wnotify';
        /**
         * 第 3 步：统一下单
         */
            $unifiedOrder = new UnifiedOrder($business, $order);

        /**
         * 第 4 步：生成支付配置文件
         */
//        $discuz=new Discuz();
//        $re=$discuz->authcode(json_encode($takehasuser),'ENCODE','jcj',30000);
            return new Payment($unifiedOrder);
    }

    /**
     * @param Request $request
     * 完成订单支付后的等级处理 循环调用grande
     */
    public static function grandes($out_trade_no)
    {
        //查找所有的订单
        $orders = Order::where('orderpuuid',$out_trade_no)->get();
        //循环调用对每个订单的完成支付后的等级处理
        foreach ($orders as $order) {
            self::grande($order->id);
        }
        return true;
    }
    /**
     * @param Request $request
     * 完成订单支付后的等级处理
     */
    private static function grande($order_id,$type='',$price='')
    {
        $order = Order::find($order_id);
        $goods=$order->goodss;
        $ouser = User::find($order->user_id);
        $f_user=User::find($ouser->f_id);
        $ff_user=User::find($ouser->ff_id);
        //如果确认付款且付款成功，则触发礼包判定:
        Log::info('aaa1');
        Log::info(count($goods));
        foreach($goods as $good){
            Log::info('bbb12');
            //处理288商品
            if($good['gift_lv']==11){
                //购买后上级获得100元上级获得50元
                if($f_user) {
                    $fmoney = 10000;//上级将要获得的佣金
                    $f_user->increment("money",$fmoney);
                    Logs::writeOne('288直推佣金',$f_user['id'],"直推佣金来自 ".$ouser->id,$fmoney,0);
                }
                if($ff_user) {
                    Log::info('aaa4');
                    $ffmoney = $ff_user->ff_user_price;//祖父上级将获得的佣金
                    $ff_user->increment("money",$ffmoney);
                    Logs::writeOne('288二级佣金',$ff_user['id'],"二级佣金来自 ".$ouser->id,$ffmoney,0);

                }
                return true;
            }
            if($good['gift_lv']>0){
                //0 首先检查用户当前等级；如果礼包等级低于用户等级，返回购买失败提醒，礼包不能低于用户当前等级
                Log::info('bbb13');
                Log::info($good['gift_lv']);
                Log::info($ouser->m_level);
                if($good['gift_lv']<$ouser->m_level){
                    Log::info('aaa14');
                    return false;
                    r(0,'欲购买的礼包等级低于您的现有等级，无法购买','');
                    //return;
                }
                //是礼包，触发礼包身份处理，触发礼包商品订单分发
                //1 用户自身等级变为礼包等级；
                //2 计算用户上级奖励，上上级奖励；
                //3 填补上级的S1，S2，S3所属空位，如果已满则处理滑落；
                //4 判断是否触发对碰奖，触发的话发放对碰奖；
                //5 对该用户，上级，上上级 三人推送消息通知，告知奖金增加及身份变更。
                //6 进行礼包商品订单分发：一个礼包会包含多个商家的商品，每个商家后台生成一条订单信息

                $newlv=$good['gift_lv'];
                //将用户等级更新为商品等级
                User::where("id",$ouser->id)->update(["m_level"=>$newlv]);
                switch($good['gift_lv']){//改成了根据等级动态获取比例，所以这个switch现在是闲置状态
                    case 1:
                        //新版本中M1-680等级不开放购买(不存在M1礼包的商品)，所以不需要对购买做处理
                        break;
                    case 2:
                        break;

                }


                if($f_user) {
                    $f_per=User::getfPer($f_user->m_level) * 100;//取直推比例
                    $fmoney = $good['price'] * $f_per;//上级将要获得的佣金
                    Log::info('aaa3');
                    Log::info($f_user->nickname);
                    Log::info($fmoney);
                    $f_user->increment("money",$fmoney);
                    Logs::writeOne('直推佣金',$f_user['id'],"直推佣金来自 ".$ouser->id,$fmoney,0);

                    //处理滑落空位填补
                    //滑落原理是循环上级的下线直到得到一个空位
                    $space=User::getOnespace($ouser->f_id);
                    //return $space;
                    //判断处理对碰奖
                    if($space[1]=='s3'){
                        //如果恰好落在s3，那么就认为触发了对碰奖
                        //先找到将分钱的四个人的id
                        //先取出三个 sid 来
                        $s1user=User::find(User::find($space[0])->s1);
                        $s2user=User::find(User::find($space[0])->s2);
                        $s3user=$ouser;
                        $uid1=$space[0];//占位者
                        $uid2=$s1user->f_id;//找到占位者的 s1 的直推上级
                        $uid3=$s2user->f_id;
                        $uid4=$s3user->f_id;
                        //计算应得的对碰奖总额
                        $duipengmoney = User::getLvmoney($s1user->m_level);
                        $duipengmoney += User::getLvmoney($s2user->m_level);
                        $duipengmoney += $good['price'];
                        $duipengmoney *=0.1;//对碰奖为三个点位总业绩的10%
                        //四个ID每个可以得到四分之一，判断这四个ID是否有相同的，进行合并
                        $gmoney[$uid1]=0;
                        $gmoney[$uid2]=0;
                        $gmoney[$uid3]=0;
                        $gmoney[$uid4]=0;
                        $gmoney[$uid1] += $duipengmoney*0.25;
                        $gmoney[$uid2] += $duipengmoney*0.25;
                        $gmoney[$uid3] += $duipengmoney*0.25;
                        $gmoney[$uid4] += $duipengmoney*0.25;
                        //相同的下标会自动相加，所以结果可能是1-4条，循环即可
                        foreach($gmoney as $tmpuid=>$tmpmoney){
                            //echo $tmpuid.'->'.$tmpmoney.'<br>';
                            User::find($tmpuid)->increment("money",$tmpmoney);
                            Logs::writeOne('对碰奖佣金',$tmpuid,"对碰奖来自 ".$space[0]."->".$s1user->id.",".$s2user->id.",".$s3user->id,$tmpmoney,0);
                        }

                    }
                }
                if($ff_user) {
                    Log::info('aaa4');
                    $ff_per=User::getffPer($ff_user['m_level'])*100;
                    $ffmoney = $good['price'] * $ff_per;//祖父上级将获得的佣金
                    $ff_user->increment("money",$ffmoney);
                    Logs::writeOne('二级佣金',$ff_user['id'],"二级佣金来自 ".$ouser->id,$ffmoney,0);

                }
            }
        }
        return true;
        r(1,'全部处理结束','');
    }

    //支付方式的回调处理
    public static function paywayHandel($pay_id,$attach)
    {
        $attach = json_decode($attach,1);
        $pay = Pay::find($pay_id);
        $user = User::find(Order::where('orderpuuid',$pay->out_trade_no)->first()->user_id);
        $payway = new Payway($user->id,$attach['payway'],$attach['price'],$attach['balance'],$attach['integral'],$pay_id);
        $payway->handle();
    }

    //支付回调业处理
    public static function notify($out_trade_no,$attach)
    {
        //更新所有本次支付的订单组的状态
        Order::where('orderpuuid',$out_trade_no)->update(['status'=>1]);
        //完成订单支付后的等级处理 循环调用grande
        self::grandes($out_trade_no);
        //支付方式的处理
        self::paywayHandel(Pay::where('out_trade_no',$out_trade_no)->first()->id,$attach);
    }

    //获取btc价格的接口,返回用户要支付的价格
//        code: "CNY",
//        name: "Chinese Yuan",
//        rate: 66511.934408
    public static function btcPrice($price = 0)
    {
        $btcprice = 'https://bitpay.com/api/rates/cny';
        $data = json_decode(Curl::vget($btcprice),1);
        return $price / $data['rate'];
    }

}
