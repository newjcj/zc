<?php
namespace App\Http\Controllers\View;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Member;
use App\Models\Order;
use App\Models\Ordergoods;
use App\Models\User;
use App\Tool\SMS\Sendsms;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity\M3result;
use Illuminate\Support\Facades\Cache;

use Illuminate\Support\Facades\Session;

use Log;


class MemberController extends Controller{
    //登录页面
    public function getLogin()
    {
        return view('view.member.login');
    }




    //执行登录
    public function postLogin(Request $request)
    {
        $m3 = new M3result();
        //username 可以是phone name email
        if($user = User::checkUseradnpassword($request->input('password'),$request->input('username'))){
            Session::set('member',$user);//登录成功写入session
            //用户登录后做购物车的同步处理
            $scart = Session::get('cart');
            $cartstatus = false;
            //分为用户在线和不在线
            //1.有session购物车
            if($scart){
                if( Order::saveScartTocart($scart) ){
                    $cartstatus = true;
                    Log::info('jcj-----------'.Session::get('cart'));
                    Session::forget('cart');
                    return $m3->build(1, '登录成功', '/view/home/index');
                }else{
                    return $m3->build(0, '登录失败', '/view/home/index');
                }
            }else{
                return $m3->build(1, '登录成功', '/view/home/index');
            }
        }else{
            r(0,'用户名或密码错误','/view/member/login');
        }
    }
    //退出
    public function postLogout(Request $request)
    {
        Session::flush();
        $m3=new M3result();
        return $m3->build(1, '退出登录');
    }
    //判断用户是否存在
    public function postIsuser(Request $request)
    {
        if(User::isUser($request->input('username'))){
            r(1,'用户存在','');
        }else{
            r(0,'用户不存在','');
        }
    }


    //注册页面
    public function getRegister(Request $request)
    {
        //如果有推广人的手机,则写入session
        if($request->input('u','') != ''){
            Session::set('u',$request->input('u'));
        }
        return view('view.member.register');
    }

    //验证用户手机存不存在
    public function postCheckphone(Request $request)
    {
        if( User::where('phone',$request->input('username'))->first() ){
            r(1,'存在');
        }else{
            r(0,'不存在');
        }
    }
    //验证用户名存不存在
    public function postCheckname(Request $request)
    {
        if( User::where('name',$request->input('username'))->first() ){
            r(1,'存在');
        }else{
            r(0,'不存在');
        }
    }
    //验证用户email存不存在
    public function postCheckemail(Request $request)
    {
        if(User::checkUseradnpassword($request->input('email'))){
            r(1,'存在');
        }else{
            r(0,'不存在');
        }
    }
    //给手机发送code
    public function postSendcode(Request $request)
    {
        Cache::forget('r'.$request->input('phone'));
        $code=rand(1000,9999);
        $time=300;
        Cache::put('r'.$request->input('phone'),$code,$time);
        if ( Cache::get('r'.$request->input('phone')) ){
            Sendsms::sendCode($request->input('phone'),$code);
            r(1, '发关成功');
        }else{
            r(0, '发关失败');
        }
    }
    //给手机发送code
    public function postSendcode1(Request $request)
    {
        Cache::forget('r'.$request->input('phone'));
        $code=rand(1000,9999);
        $code=1111;
        $time=300;
        Cache::put('r'.$request->input('phone'),$code,$time);
        if ( Cache::get('r'.$request->input('phone')) ){
            Sendsms::sendCode($request->input('phone'),$code);
            r(1, '发关成功');
        }else{
            r(0, '发关失败');
        }
    }
    //验证code
    public function postCheckcode(Request $request)
    {
        $code = Cache::get('r'.$request->input('phone'));
        if(1){
            r(1,'通过');
        }else{
            r(0,'不通过');
        }
        if($code == $request->input('code')){
            r(1,'通过');
        }else{
            r(0,'不通过');
        }
    }


    //将注册的会员的信息插入表中
    public function postRegister(Request $request){
        //验证code
        if( Cache::get('r'.$request->input('phone')) == $request->input('code') ){
            r(2,'验证码不对','');
        }
        $member = new User;
        $member->name = $request->input('username');
        $member->phone = $request->input('phone');
//        $member->email = $request->input('email');
        $member->password = password($request->input('password'));
        if($member->save()){
            //注册成功触发相关业务
            User::regnotify($member->id);
            r(1,'添加成功','/view/member/login');
        }else{
            r(0,'添加失败','');
        }
    }
    //将注册的会员的信息插入表中
    public function postRegisterwap(Request $request){
        //验证code
        if( Cache::get('r'.$request->input('phone')) == $request->input('code') ){
            r(2,'验证码不对','');
        }
        //如果是微信用户则把手机号加进去
        if( ($user = Session::get('member')) && $user->openid ){
            $member=User::find($user->id);
            $member->phone = $request->input('username');
            $member->password = password($request->input('password'));
        }else{
            $member = new User;
//        $member->name = $request->input('username');
            $member->phone = $request->input('username');
//        $member->email = $request->input('email');
            $member->password = password($request->input('password'));
        }
        if($member->save()){
            //注册成功触发相关业务
            User::regnotify($member->id);
            r(1,'添加成功','/view/member/login');
        }else{
            r(0,'添加失败','');
        }
    }

    //订单页面
    public function getOrder()
    {
        //Session::get('member')->id;
        $order = Order::where('user_id',Session::get('member')->id)->get();
        print_r( $order[0]);exit;
        return view('view.member.order',[
            'order' => $order
        ]);
    }

    //删除商品
    public function postDelete(Request $request)
    {
        $order = Order::find($request->input('id'));
        $ordergood = Ordergoods::where('order_id',$request->input('id'));
        if( $ordergood->delete() && $order->delete()){
            r(1,'删除成功','/view/member/order');
        }else{
            r(0,'删除失败','');
        }
    }

    //未付款
    public function postIndex1()
    {
        //Session::get('member')->id;
        $order = Order::where('user_id',Session::get('member')->id)->where('status','7')->get();
       // print_r($order);exit;
        r(1,'删除成功','/view/member/order',['order'=>$order]);
    }

    //退货页面
    public function getRejectorder()
    {
        //Session::get('member')->id;
        $order = Order::where('user_id',Session::get('member')->id)->where('status','4')->get();

//         print_r( $order);exit;
        return view('view.member.rejectorder',[
            'order' => $order
        ]);
    }

    //申请退款
    public function postDelete1(Request $request)
    {

         // $goods = Goods::find($request->input('id'));
            $ordergood = Ordergoods::find($request->input('id'));
            $ordergood->status = '3';
            if( $ordergood->save()){
                r(1,'申请成功等待审核！','/view/member/order');
            }else{
                r(0,'申请失败！','');
            }

    }

}