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

class UserController extends Controller{

    //在个人中初次进去时候的忽略按钮操作
    public  function postIgnoreverify(Request $request){
        $user = User::getUser();
        $user->status = '1';
        if($user->save()){
           r(1,'忽略成功！');
        }else{
           r(0,'忽略失败！');
        }
    }

    //通过手机号找到邀请人id
    public  function  postCheckinviter(Request $request){
       // print_r($request->input("phone"));exit;
        $fuser = User::where("phone",$request->input("phone"))->first();
        $user = User::getUser();
        if($user->f_id>0){
            r(2,'不允许变更邀请人','');
        }

        if(count($fuser)){
            $user->f_id = $fuser->id;
            if($user->save()){
                r(1,'保存成功','');
            }
        }else{
            r(0,'没有这个人~','');
        }
    }

    //在订单页面付款前 检查是否有默认地址如果有则 蒋默认地址插入订单表中
    public  function  postCheckaddress(Request $request){
        $user = User::getUser();
        $useraddress = Useraddress::where("user_id",$user->id)->where('is_choice',1)->where('status',0)->first();
        $order = Order::where("id",$request->input("orderid"))->first();
        if($order->useraddress_id!=''){
            r(1,'可以付款了','');
        }else{
            if(count($useraddress)){
                $order->useraddress_id = $useraddress->id;
                $order->save();
                r(1,'可以付款了','');
            }else{
                r(0,'去选择地址吧','');
            }
        }
    }
    //查看推荐瑞达人
    public function getRecommendrex(Request $request){
        $user = User::getUser();
        $fu = User::where("f_id",$user->id)->where("r",'1')->get();
        $re=[];
        if(count($fu)){
            foreach ($fu as $k=>$u){
                $re[$u->id] = User::where("f_id",$u->id)->where("r",'1')->get();
            }
        }
        return view("wap.user.recommendrex",[
            'fu'=>$fu,
            're'=>$re
        ]);
    }

    //查看推荐礼包会员
    public function getRecommend(Request $request){
        $user = User::getUser();
        $fu = User::where("f_id",$user->id)->get();
        $re=[];
        if(count($fu)){
            foreach ($fu as $k=>$u){
                $re[$u->id] = User::where("f_id",$u->id)->get();
            }
        }
        return view("wap.user.recommend",[
            'fu'=>$fu,
            're'=>$re
        ]);
    }

    //验证支付密码是否正确
    public function postCheckpwd(Request $request){
        $user = User::getUser();
        if($user->pay_password==password($request->input("pwd"))){
            r(1,'确定支付','');
        }else{
            r(0,'密码输入有误！','');
        }
    }

    //添加支付密码
    public  function  postAddpwd(Request $request){
        $user = User::getUser();
        if(Cache::get('r'.$request->input('phone')) && (Cache::get('r'.$request->input('phone'))==$request->input('code'))  ){
            $user->pay_password = password($request->input('paypwd'));
            if($user->save()){
                r(1,'设置成功','');
            }else{
                r(0,'设置失败','');
            }
        }else{
            r(0,'验证码错误','');
        }


    }

    //设置支付密码的页面
    public function getSetpwd(Request $request){
        return view('wap.user.setpwd',['orders'=>$request->input("orders")]);
    }

    //判断用户是否设置支付密码
    public function postIssetpwd(Request $request){
       $user = User::getUser();
       $orders = $request->input("orders");
       if($user->pay_password!=''){
           r(1,'已设置','/wap/pay/order?orders='.$orders);
       }else{
           r(0,'请设置支付密码！','/wap/user/setpwd?orders='.$orders);
       }
    }

    //更新订单里面的默认地址
    public  function  postSaveaddress(Request $request){
        $order = Order::find($request->input('orderid'));
        $order->useraddress_id = Useraddress::where('user_id',Session::get('member')->id)->where('is_choice',1)->first()->id;
        //print_r($order->useraddress_id);exit;
        if($order->save()){
            r(1,'保存成功','/wap/user/orderinfo?id='.$request->input('orderid'));
        }else{
            r(0,'保存失败','');
        }

    }

    //更新订单详情里面的默认地址
    public  function  postSave1address(Request $request){
        $order = Order::find($request->input('ordersid'));
        $order->useraddress_id = Useraddress::where('user_id',Session::get('member')->id)->where('is_choice',1)->first()->id;
        //print_r($order->useraddress_id);exit;
        if($order->save()){
            r(1,'保存成功','/wap/user/orderinfo?id='.$request->input('orderid'));
        }else{
            r(0,'保存失败','');
        }
    }

    //更新订单详情里面的默认地址
    public  function  postSave2address(Request $request){
        $order = Order::find($request->input('order_id'));
        $order->useraddress_id = Useraddress::where('user_id',Session::get('member')->id)->where('is_choice',1)->first()->id;
        //print_r($order->useraddress_id);exit;
        if($order->save()){
            r(1,'保存成功','/wap/user/orderinfo?id='.$request->input('orderid'));
        }else{
            r(0,'保存失败','');
        }

    }

    //物流跟踪
    public  function  getLogistics(Request $request){
        $order = Order::find($request->input('id'));
        $express = Express::find($order->express_id);
        $kdn = new Kdn();
        $wl = json_decode($kdn->getOrderTracesByJson($express->encode,$order->express),1);
//        print_r( array_reverse($wl['Traces']));exit;
//        array_reverse($wl['Traces']);
        return view('wap.user.logistics',[
            'wl' => $wl,
            'yc' => $express->kname,
            'wl1' =>array_reverse($wl['Traces']),
            'i' => 0
        ]);
    }

    //编辑地址
    public function postBjaddress(Request $request){
        $useraddress=Useraddress::where('id',$request->input('id'))->where('user_id',Session::get('member')->id)->first();
        $useraddress->addressname = $request->input('name');
        $useraddress->phone = $request->input('phone');
        $useraddress->address = $request->input('address');
        $useraddress->is_choice = $request->input('chk');
        $useraddress->region_id = $request->input('city');
        $orderid = $request->input('orderid');
        $ordersid = $request->input('ordersid');
        $order_id = $request->input('order_id');
        if(!count($orderid)){
            $orderid=-1;
        }

        if(!count($ordersid)){
            $ordersid=-1;
        }

        if(!count($order_id)){
            $order_id=-1;
        }
        if($useraddress->is_choice==1){
            Useraddress::where('user_id',Session::get('member')->id)->update(['is_choice'=>0]);
        }
        if($useraddress->save()){
            r(1,'更新成功','/wap/user/address?orderid='.$orderid.'&ordersid='.$ordersid.'&order_id='.$order_id);
        }else{
            r(0,'更新失败，请联系管理员！','');
        }
    }

    //回显地址
    public function  getEditaddress(Request $request){
        $useraddress=Useraddress::where('id',$request->input('id'))->where('user_id',Session::get('member')->id)->first();
        $orderid = $request->input('orderid');
        $ordersid = $request->input('ordersid');
        $order_id = $request->input('order_id');
        if(!count($orderid)){
            $orderid=-1;
        }

        if(!count($ordersid)){
            $ordersid=-1;
        }

        if(!count($order_id)){
            $order_id=-1;
        }
        return view('wap.user.editaddress',[
            'useraddress' =>$useraddress,
            'id' => $request->input('id'),
            'orderid' => $orderid,
            'order_id' => $order_id,
            'ordersid' => $ordersid
        ]);
    }

    //增加地址
    public  function  postZjaddress(Request $request){

        $useraddress = new Useraddress;
        $useraddress->addressname = $request->input('name');
        $useraddress->phone = $request->input('phone');
        $useraddress->address = $request->input('address');
        $useraddress->is_choice = $request->input('chk');
        $useraddress->user_id = Session::get('member')->id;
        $useraddress->region_id = $request->input('city');

        $orderid = $request->input('orderid');
        $ordersid = $request->input('ordersid');
        $order_id = $request->input('order_id');
        if(!count($orderid)){
            $orderid=-1;
        }

        if(!count($ordersid)){
            $ordersid=-1;
        }

        if(!count($order_id)){
            $order_id=-1;
        }

        if($useraddress->is_choice==1){
            Useraddress::where('user_id',Session::get('member')->id)->update(['is_choice'=>0]);
        }
//        print_r($useraddress->phone);exit;
        if($useraddress->save()){
            r(1,'保存成功','/wap/user/address?orderid='.$orderid.'&ordersid='.$ordersid.'&order_id='.$order_id);
        }else{
            r(0,'保存失败失败','');
        }

    }

    //增加地址
    public  function  getAddaddress(Request $request){
        $orderid = $request->input('orderid');
        $ordersid = $request->input('ordersid');
        $order_id = $request->input('order_id');
        if(!count($orderid)){
            $orderid=-1;
        }

        if(!count($ordersid)){
            $ordersid=-1;
        }

        if(!count($order_id)){
            $order_id=-1;
        }

        return view('wap.user.addaddress',[
            'orderid' =>$orderid,
            'ordersid'=>$ordersid,
            'order_id'=>$order_id
        ]);
    }

    //删除地址
    public  function postDeladdress(Request $request){
        $useraddress = Useraddress::where('id',$request->input('id'))->first();
        $useraddress->status = '1';
        $orderid = $request->input('orderid');
        $ordersid = $request->input('ordersid');
        $order_id = $request->input('order_id');
        if(!count($orderid)){
            $orderid=-1;
        }

        if(!count($ordersid)){
            $ordersid=-1;
        }

        if(!count($order_id)){
            $order_id=-1;
        }
        if($useraddress->save()){
            r(1,'删除成功','/wap/user/address?orderid='.$orderid.'&ordersid='.$ordersid.'&order_id='.$order_id);
        }else{
            r(0,'删除失败','');
        }
    }

    //修改默认的地址
    public  function postChoice(Request $request){
        //$useraddress = Useraddress::where('user_id',Session::get('member')->id)->get();
        Useraddress::where('user_id',Session::get('member')->id)->update(['is_choice'=>0]);
        $useraddress = Useraddress::where('id',$request->input('id'))->first();
        $useraddress->is_choice = '1';
        if($useraddress->save()){
            r(1,'更新成功','/wap/user/address');
        }else{
            r(0,'更新失败','');
        }
    }

    //查看address
    public  function  getAddress(Request $request){
        $useraddress = Useraddress::where('user_id',Session::get('member')->id)->where('status','!=','1')->get();
        $orderid = $request->input('orderid');
        $ordersid = $request->input('ordersid');
        $order_id = $request->input('order_id');
        if(!count($orderid)){
            $orderid=-1;
        }

        if(!count($ordersid)){
            $ordersid=-1;
        }

        if(!count($order_id)){
            $order_id=-1;
        }
        return view('wap.user.address',[
            'useraddress' =>$useraddress,
            'orderid' =>$orderid,
            'ordersid' =>$ordersid,
            'order_id' =>$order_id
        ]);
    }

    //查看评价
    public  function  getShoweval(Request $request){
        $order = Order::find($request->input('orderid'));
        $img = Goods::getGoodsimages(Goods::find($request->input('goodid')))[0];
//        print_r($img);exit;
//       print_r($ordergoods->order_id);exit;
        return view('wap.user.showeval',[
            'img' => $img,
            'order' =>$order,
            'orderid' => $request->input('orderid'),
            'goodid' => $request->input('goodid')
        ]);
    }

    //添加评价
    public  function  postPutevaluate(Request $request){
        $ordergoods = Ordergoods::where("order_id",$request->input('orderid'))->where("goods_id",$request->input('goodid'))->first();
        $ordergoods->evaluate_rank = $request->input('count');
        $ordergoods->evaluate_status = '3';
        $ordergoods->evaluate = $request->input('content');
        if($ordergoods->save()){
            r(1,'更新成功','/wap/user/evaluate?a=2');
        }else{
            r(0,'更新失败','');
        }
    }


    //评价单个商品
    public  function  getOvereval(Request $request){
        Order::find($request->input('orderid'))->goodss;
      // $ordergoods = Order::where('order_id',$request->input('orderid'))->where('goods_id',$request->input('goodid'))->first();
        $img = Goods::getGoodsimages(Goods::find($request->input('goodid')))[0];
//        print_r($img);exit;
//       print_r($ordergoods->order_id);exit;
        return view('wap.user.overeval',[
            'img' => $img,
            'orderid' => $request->input('orderid'),
            'goodid' => $request->input('goodid')
        ]);
    }

    //评价订单
    public function  getEvaluate(Request $request){
        $orders = Order::where('user_id',Session::get('member')->id)->where('status',4)->get();
        $dpjnum = 0;
        $ypjnum = 0;

        if(count($orders)){
            foreach ($orders as $k=>$order){
                $ordergoods = Ordergoods::where('order_id',$order->id)->get();
                if(count($ordergoods)) {
                    foreach ($ordergoods as $o) {
                        if($o->evaluate_status==1){
                            $dpjnum++;
                        }
                        if($o->evaluate_status==3){
                            $ypjnum++;
                        }
                    }
                }
            }
        }

        return view('wap.user.evaluate',[
            'dpjnum' => $dpjnum,
            'ypjnum' => $ypjnum,
            'orders' => $orders,
            'a' => $request->input('a')
        ]);
    }

    //订单详情页
    public function getOrderinfo(Request $request)
    {
        $orders = Order::find($request->input('id'));
        $ordergoods = Ordergoods::where('order_id',$request->input('id'))->get();
        $user = User::getUser();
        $useraddress = Useraddress::where('user_id',$user->id)->where('is_choice',1)->where('status',0)->first();
        if(count($useraddress)){
            $orders->useraddress_id = $useraddress->id;
            $orders->save();
        }
//        print_r($orders->useraddress);exit;
        return view('wap.user.orderinfo',[
            'ordergoods'=>$ordergoods,
            'orders' => $orders
        ]);
    }

    public function getMyteam(Request $request)
    {
        $user = Session::get('member');
        $orders = Order::where('user_id',Session::get('member')->id)->where('status','0')->get();
        $orders1 = Order::where('user_id',Session::get('member')->id)->where('status','1')->get();
        $orders2 = Order::where('user_id',Session::get('member')->id)->where('status','4')->get();
        $re=[];
        $a = $request->input('a');
        $eval = 0;
        if(count($orders2)){
            foreach ($orders2 as $k=>$order){
                $ordergoods = Ordergoods::where('order_id',$order->id)->get();
                if(count($ordergoods)) {
                    foreach ($ordergoods as $o) {
                        if($o->evaluate_status==1){
                            $eval++;
                        }
                    }
                }
            }
        }
        return view('wap.user.myteam',[
            'fknum'=>count($orders),
            'user'=>Session::get('member'),
            'dshnum'=>count($orders1),
            'eval' => $eval,
            'user' => $user,
            'usergraph'=>User::UserGraph($request->input('id',$user->id)),//取一个人的下面二级的用户的图表
        ]);
    }
    //我的订单
    public function getOrderlist(Request $request)
    {
        $orders0 = Order::where('user_id',Session::get('member')->id)->where('status','0')->get();
        $orders1 = Order::where('user_id',Session::get('member')->id)->where('status','1')->get();
        $orders2 = Order::where('user_id',Session::get('member')->id)->where('status','2')->get();
        $orders3 = Order::where('user_id',Session::get('member')->id)->where('status','!=','4')->get();
        $orders = Order::where('user_id',Session::get('member')->id)->get();
        $re=[];
        $a = $request->input('a');
        if(count($orders)){
          foreach ($orders as $k=>$order){
            $ordergoods = Ordergoods::where('order_id',$order->id)->get();
            $re[$order->id]['num']=(DB::select("select sum(num) as snum from db_order_goods where order_id = ?",[$order->id]))[0]->snum;
            $knum=count($ordergoods);
            $ztotal=0;
            if(count($ordergoods)){
                foreach($ordergoods as $o){
                    $tmpgood = Goods::where('id',$o->goods_id)->get();
                    $tprice= $tmpgood[0]->price/100;
                    $tnum=$o->num;
                    $ztotal+=$tnum*$tprice;
                }
            }
            $re[$order->id]['totalprice']=$ztotal;
            $re[$order->id]['knum']=$knum;
           // $re[$order->id]['orderuuid']=$order->orderuuid;
          }
        }
        return view('wap.user.orderlist',[
            'fknum'=>count($orders0),
            'dfhnum'=>count($orders1),
            'dshnum'=>count($orders2),
            'allnum'=>count($orders3),
            'orders' => $orders,
            're' => $re,
            'a' => $a
        ]);
    }


    //确认收货
    public function postOrderreceive(Request $request)
    {
        $o = Order::find($request->input('id'));
        $o->status = '4';
        if($o->save()){
            r(1,'更新成功','/wap/user/orderlist');
        }else{
            r(0,'更新失败','');
        }

    }

    //会员中心
    public function getCenter(Request $request)
    {
        $orders = Order::where('user_id',Session::get('member')->id)->where('status','0')->get();
        $orders1 = Order::where('user_id',Session::get('member')->id)->where('status','1')->get();
        $orders2 = Order::where('user_id',Session::get('member')->id)->where('status','2')->get();
        $orders3 = Order::where('user_id',Session::get('member')->id)->where('status','4')->get();
        $re=[];
        $a = $request->input('a');
        $eval = 0;
        if(count($orders3)){
            foreach ($orders3 as $k=>$order){
                $ordergoods = Ordergoods::where('order_id',$order->id)->get();
                if(count($ordergoods)) {
                    foreach ($ordergoods as $o) {
                       if($o->evaluate_status==1){
                           $eval++;
                       }
                    }
                }
            }
        }
        $user =  User::getUser();
        $f_id = $user->f_id;
        if($f_id==0){
            $realname =0;
        }else{
            $realname = User::where("id",$f_id)->first()->real_name;
             if($realname==''){
                 $realname ='未实名';
             }
        }

        //算出直推的人数
        $fu = User::where("f_id",$user->id)->get();
        $fannum = count($fu);

        return view('wap.user.center',[
            'fknum'=>count($orders),
            'user'=>User::getUser(),
            'dfhnum'=>count($orders1),
            'dshnum'=>count($orders2),
            'eval' => $eval,
            'realname'=>$realname,
            'fannum' =>$fannum,
            'status' =>$user->status
        ]);
    }



    //订单页面
    public function getOrder(Request $request)
    {
        $user = Session::get('member');
        $order=Order::where('id','!=',0)->orderBy('id','desc')->first();
        $address = Useraddress::where(['user_id'=>$user->id,'is_choice'=>1])->first();
//        $address = Region::getProvinceCity($address->region_id).$address->address;
        return view('wap.home.order',[
            'order'=>$order,
            'address'=>11,
        ]);
    }

    //提现
    public function getDeposit(Request $request){
        $user = User::find(Session::get('member')->id);
        return view('wap.user.deposit',[
            'user'=>$user,
        ]);
    }

    //实名认证
    public function getVerify(Request $request)
    {
        return view('wap.user.verify');
    }
    //执行实名认证 资料提交
    public function postVerify(Request $request)
    {
        $user = User::getUser();
        //验证是否审核通过
        if($user->is_true == 3){
            r(4, '审核中，不用再次提交','/wap/user/center');
        }
        //看店铺是否存在
        if( !$shop = $user->shop ){
            $shop = new Shop();
        }
        $user->is_true = 3;
        $user->real_name = $request->input('name');
        $user->cardimage1 = $request->input('preview1');
        $user->cardimage2 = $request->input('preview2');
        $user->cardid = $request->input('identity');
        $shop->user_id = $user->id;
        $shop->card_image1 = $request->input('preview1');
        $shop->card_image2 = $request->input('preview2');
        $shop->card_number = $request->input('identity');
        $shop->banknumber = $request->input('number');
        $shop->bankname = $request->input('bankname');
        if( $shop->save() ){
            $user->status = '1';
            $user->save();
            r(1, '提交成功，请待会审核','/wap/user/center');
        }else{
            r(2, '提交失败');
        }

    }

    /**
     * @param Request $request
     * 执行开店实名认证 资料提交
     * 用户名username
     */

    public  function getShop(Request $request){
        $user = User::getUser();
        return view('wap.user.shop',['shop' => $user->shop]);
    }

    public function postShop(Request $request)
    {
        $user = Session::get('member');
        //看店铺是否存在
        if( !$shop = $user->shop ){
            $shop = new Shop();
        }
        $user->is_true = 1;
        $user->cardimage1 = $request->input('preview1');
        $user->cardimage2 = $request->input('preview2');
        $user->cardid = $request->input('identity');
        $shop->user_id = $user->id;
        $shop->name = $request->input('name');
        $shop->licence_image=$request->input('preview3');//营业执照图片
        $shop->card_image1=$request->input('preview1');//身份证现面图片
        $shop->licence_image=$request->input('preview2');//身份证反面图片
        $shop->card_number=$request->input('identity');//身份证号
        $shop->region=$request->input('city');//省市区
        $shop->address=$request->input('address');//详细地址
        $shop->banknumber = $request->input('number');
        $shop->bankname = $request->input('bankname');
        $shop->certify = 0;
        //$shop->start_time=date('Y-m-d H:i:s',time());//商家开店时间
        if( $shop->save()&&$user->save()){
            //会员身份也通过认证
            r(1, '提交成功，请待会审核');
        }else{
            r(2, '提交失败');
        }

    }

    //我的推广图片
    public static function getMyad()
    {
        //判断用户有没有手机号，没有到注册页面
        $user = Session::get('member');
        $user = User::find($user->id);
        if(!$user->phone){
            return redirect('/wap/login/reg');
        }
        $url = "http://{$_SERVER['HTTP_HOST']}/wap/login/reg?u=".$user->phone;
        return view('wap.user.myad',[
            'img'=>User::img($url),
            'url'=>$url,
        ]);
    }



}