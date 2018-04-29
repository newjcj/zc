<?php
namespace App\Http\Controllers\Wap;
use App\Entity\Curl;
use App\Models\Bank;
use App\Models\Cart;
use App\Models\Entity\Payway;
use App\Models\Goods;
use App\Models\Goodscategory;
use App\Models\Logs;
use App\Models\Order;
use App\Models\Ordergoods;
use App\Models\Pay;
use App\Models\Payaddress;
use App\Models\User;
use App\Models\Useraddress;
use App\Models\Usergoods;
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
use Overtrue\Wechat\Payment;
use Overtrue\Wechat\Payment\Business;
use Overtrue\Wechat\Payment\Notify;
use Overtrue\Wechat\Payment\UnifiedOrder;

class PayController extends Controller{

    //btc支付  生成支付连接
    public function getBtc (Request $request) {
        $user = Session::get('member');
        Pay::timeout();
//        $xpub = 'xpub6CvH6f1pe3pVqADmggdFVNbAQaKJ8Q89Y3RgEpfstpEYFSbcuDjPARkhAyEngHLiXF6v4EyUdjyDsperD67gtmf4iEbm8zYdavbWoSNi3ET';
        $xpub = 'xpub6CvH6f1pe3pVsUGfkfweTM2H9onwDAzH2GjbTABDUfaQQ4kzoxvnGtdvpaaQzDSaLjbGGYU9uZm1fCug1xupoeAUTiFogF6E4pq8EVUL6Lk';
        $callback_url = urlencode('http://invetofintech.com/wap/pay/btcnotify');//可自定义参数
        $key = 'fa36cdc5-f6bc-4774-bb3b-dfa0e829b8cf';
        $gap_limit = '15';
        $url = "https://api.blockchain.info/v2/receive?xpub=".$xpub."&callback=".$callback_url."&key=".$key."&gap_limit=".$gap_limit;
        //$re = json_decode(Curl::vget($url),1);
        $price = $request->input('price');
        $btcprice = Pay::btcPrice($request->input('price'));//取转换后的btc价格
        $btcprice = 0.00001;//取转换后的btc价格
        //判断如果数据库有支付地址，则先用数据库里的支付地址
        $num = count(Payaddress::all());
        $hasnum = count(Payaddress::where('user_id','')->get());
        if( $num > 5 && $hasnum < 1 ) {
            r(0, '支付地址满了');
        }elseif($num < 6 ){
            //把支付地址写入到数据库 支付地址还没满
            $addressobj = new Payaddress();
            $addr1=json_decode(Curl::vget($url),1);
            Log::info('2222222222222222');
            Log::info($addr1);
            Log::info('22222222222222');
            $addressobj->address = $addr1['address'];
//            $addressobj->address = '222';
            $addressobj->btcprice = $btcprice;
            $addressobj->price = $price;
            $addressobj->goods_id = $request->input('goodsid');
            $addressobj->user_id = $user->id;
            $addressobj->save();
//            $address = $re['address'];
            $address = $addressobj->address;
        }elseif($hasnum > 0){
            //如果有过期支付地址
            $addressobj = Payaddress::where('user_id','')->first();
            $address = $addressobj->address;
            $addressobj->btcprice = $btcprice;
            $addressobj->price = $price;
            $addressobj->goods_id = $request->input('goodsid');
            $addressobj->user_id = $user->id;
            $addressobj->save();
        }else{

        }
        r('1',$address,'','bitcoin:'.$address."?amount=".$btcprice);
    }
    //btc 支付回调
    public function postBtcnotify(Request $request)
    {
        Log::info('111111111111postBtcnotify111111111');
        Log::info(date('Y-m-d H:i:s'));
        Log::info($_REQUEST);
        Log::info('111111111111111111111');
        if((int)$_REQUEST['confirmations'] >= 3){
            echo '*ok*';
        }
        if( isset($_REQUEST['confirmations']) && $_REQUEST['confirmations'] >= 0 ){
            //处理业务
            //1.写入db_user_goods
            //删除db_payaddress里的address
            if( $payaddress = Payaddress::where('address',$_REQUEST['address'])->first() ){
                $usergoods = new Usergoods();
                $usergoods->user_id = $payaddress->user_id;
                $usergoods->goods_id = $payaddress->goods_id;
                $usergoods->price = $payaddress->price;
                $usergoods->btcprice = $payaddress->btcprice;
                $usergoods->save();
                $payaddress->delete();
            }else{
                exit;
            }
        }
    }
    //btc 支付回调
    public function getBtcnotify(Request $request)
    {
        Log::info('111111111111postBtcnotify11111get1111');
        Log::info(date('Y-m-d H:i:s'));
        Log::info($_REQUEST);
        Log::info('111111111111111111111');
        if((int)$_REQUEST['confirmations'] >= 3){
            echo '*ok*';
        }
        if( isset($_REQUEST['confirmations']) && $_REQUEST['confirmations'] >= 0 ){
            //处理业务
            //1.写入db_user_goods
            //删除db_payaddress里的address

            if( $payaddress = Payaddress::where('address',$_REQUEST['address'])->first() ){
                $usergoodsexcet = Usergoods::where(['user_id'=>$payaddress->user_id,'goods_id'=>$payaddress->goods_id])->first();
                if(!$usergoodsexcet){
                    $usergoods = new Usergoods();
                    $usergoods->user_id = $payaddress->user_id;
                    $usergoods->goods_id = $payaddress->goods_id;
                    $usergoods->price = $payaddress->price;
                    $usergoods->btcprice = $payaddress->btcprice;
                    $usergoods->save();
                    $payaddress->delete();
                }
            }else{
                exit;
            }
        }
    }
    //开始心跳 检测支付状态
    public function getBtccheck (Request $request) {
        $user = Session::get('member');
        if($user && Usergoods::where('user_id',$user->id)->where('goods_id',$request->input('goodsid'))->first()){
            r(1,'支付成功！');
        }else{
            r(0,'');
        }
    }
    //取支付地址个数
    public function getPayaddressnum(Request $request)
    {
        $num = count(Payaddress::all());
        $hasnum = count(Payaddress::where('user_id','')->get());
       if($num > 5 && $hasnum < 1){
           r(0, '', '');//满了
       }else{
           r(1, '', '');
       }
    }
    //心跳支付地址过期处理
    public function getPaytimeout()
    {
        Pay::timeout();
    }
    //判断这个项目我有没有买过
    public function getIspay(Request $request)
    {
        $user = Session::get('member');
        $usergoods = Usergoods::where(['user_id'=>$user->id,'goods_id'=>$request->input('goodsid')])->first();
        if($usergoods){
            r(1,'买过','');
        }else{
            r(0, '没有买过');
        }
    }
    //订单提交生成支付 此时要先保存商户的订单号到数据库  
    public function getOrder(Request $request)
    {
        //生成一个订单组唯一标识
        $order_uid = UUID::orderid();
        $ordersarr = explode(',',trim($request->input('orders'),','));
        $u = User::getUser();
        //支付方式定义
        //判断如果只用积分，余额，积分和余额则直接支付成功处理订单1
        if(in_array($request->input('payway'),[1,2,3])){
            //初始化payway类
            $pay=new Pay();
            $pay->out_trade_no = $order_uid;
            $pay->save();
            $payway = new Payway(User::getUser()->id,$request->input('payway'),Order::getOrderTotalPrice($ordersarr),$u->money,$u->shop_coin,$pay->id);
            if($payway->isOk() == 1){
                Order::whereIn(Order::posersarray($request->input('orders')))->update(['status'=>1,'orderpuuid'=>$order_uid,'pay_id'=>$pay->id]);//更新订单组状态
                $payway->handle(); //对订单的处理（在支付回调处理或直接处理）
                //完成订单支付后的等级处理 循环调用grande
                Pay::grandes($order_uid);
                return view('wap.pay.payok');
            }

        }
        //含有微信支付的方式
        if(in_array($request->input('payway'),[4,6,8,10])){
            $payway = new Payway(User::getUser()->id,$request->input('payway'),Order::getOrderTotalPrice($ordersarr),$u->money,$u->shop_coin);
            DB::beginTransaction();//开始事务
            //更新所有的这交提交的订单组的 orderpuuid为这个id
            if( Order::whereIn('id',$ordersarr)->update(['orderpuuid'=>$order_uid]) ){
                DB::commit();
            }else{
                DB::rollBack();
            }
            //组装回调传回的参数
            $attach=json_encode([
                'payway'=>$request->input('payway'),
                'price'=>Order::getOrderTotalPrice($ordersarr),
                'balance'=>$u->money,
                'integral'=>$u->shop_coin,
            ],1);
            if(Session::get('wxf')){
                return view('wap.pay.orderwxf',[
                    'payment'=>Pay::orderwxf($order_uid,$u->openid,1,$attach),
                    'total_fee'=>1,
                    'orders'=>$ordersarr,
                    'user'=>Session::get('user'),
                ]);
            }else{
                return view('wap.pay.orderwh5',[
                    'r'=>Pay::orderwh5($order_uid,$u->openid,1,$attach),
                    'total_fee'=>1,
                    'orders'=>$ordersarr,
                    'user'=>Session::get('user'),
                ]);
            }

        }



    }


    //微信支付回调接受通知接口
    public function postWnotify(Request $request)
    {
        $notify = new Notify(
            config('wechat')['app_id'],
            config('wechat')['secret'],
            config('wechat')['mchId'],
            config('wechat')['mchKey']
        );

        $transaction = $notify->verify();

        if (!$transaction) {
            $notify->reply('FAIL', 'verify transaction error');
        }
        Log::info('jcjnotify');
        Log::info($transaction);

        //入库 找到支付前预先存在pay表里的out_trade_no
        $pay=Pay::where(array('out_trade_no'=>$transaction->out_trade_no))->first();
        if(!$pay){
            $attach = json_decode($transaction->attach,1);
            $pay=new Pay();
            $pay->price=$transaction->cash_fee;
            $pay->out_trade_no=$transaction->out_trade_no;//一个订单组唯一标识
            $pay->appid=$transaction->appid;
            $pay->fee_type=$transaction->fee_type;//一个订单组唯一标识
            $pay->mch_id=$transaction->mch_id;
            $pay->openid=$attach['openid'];
            $pay->time_end=$transaction->time_end;
            $pay->status=1;
            $pay->transaction_id=$transaction->transaction_id;
            if($pay->save()){
                //支付成功  业务处理
                Pay::notify($transaction->out_trade_no,$transaction->attach);
                echo $notify->reply();
                return;
            }else{
                $notify->reply('FAIL', 'verify transaction error');
            }
        }else{
            $notify->reply('FAIL', 'verify transaction error');
        }

    }

    //提现申请
    public function postDeposit(Request $request)
    {
        $user = Session::get('member');
        $user = User::find($user->id);
        //判断是不是实名认证的用户
        switch ($user->is_true){
            case 2:
                r(2, '您已被封禁不能提现');
                break;
            case 0:
                r(3, '您还没有实名认证，不能提现','/wap/user/verify');
                break;
        }
        //判断是否有冻结资金
        if( $user->frozen_money>0 ){
            r(5, '提现申请已经提交，不能重复提交','/wap/user/center');
        }
        //判断提现金额是否大于可提现金额
        if( $request->input('price') > $user->money ){
            r(4, '您的余额不足');
        }
        //写入冻结金额
        $u=User::find($user->id);
        $u->frozen_money = $request->input('price');
        if($u->save()){
            //写入提现流水 写入bank表 记录提现
            $bank = new Bank();
            $bank->money = $request->input('price');
            $bank->user_id=$user->id;
            $bank->status=8;
            $bank->rate=1;//冻结起来
            $bank->save();
            r(1, '提现申请已提交，将在3个工作日内反现');
        }else{
            r(0, '提现申请失败');
        }

    }

}