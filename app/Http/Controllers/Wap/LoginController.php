<?php
namespace App\Http\Controllers\Wap;
use App\Models\Cart;
use App\Models\Goods;
use App\Models\Goodscategory;
use App\Models\Order;
use App\Models\Ordergoods;
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

class LoginController extends Controller{

    //上传身份证
    public function postIdentify(Request $request)
    {
        $user = Session::get('member');
        $user = User::find($user->id);
        $user->cardimage1=$request->input('cardimage1');
        $user->cardimage2=$request->input('cardimage2');
        $user->passport=$request->input('passport');

        if ($user->save()){
            r(1,'上传成功');
        }else{
            r(0,'上传失败');
        }
    }
    //上传 kyc文件
    public function postKyc(Request $request)
    {
        $user  = Session::get('member');
        $user = User::find($user->id);
        //上传文件
        $filename = '/upload/files/' . $_FILES["file"]["name"];
        move_uploaded_file($_FILES["file"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'].'/upload/files/' . $_FILES["file"]["name"]);
        $user->kyc=$filename;
        if ($user->save()){
            r(1,'上传成功');
        }else{
            r(0,'上传失败');
        }
    }
    public function postTest(){
        print_r(333);exit;
    }

    public function getSend(Request $request)
    {
        $mobile=$request->input('mobile');
        $randcode=rand(111111,999999);
        Session::put('code',$randcode);
        return Sendsms::sendCode($mobile,$randcode);
    }

    public function getLogin1(Request $request)
    {
        $return_url = $request->input('return_url','');
        $return_url = urldecode($return_url);
        return view('m.login.login1',[
            'return_url' => $return_url,
        ]);
    }

    public function getLogin(Request $request)
    {
        if(Session::get('member')){
            return Session::get('member');
        }
        return 1;
        $return_url = $request->input('return_url','');
        $return_url = urldecode($return_url);
        return view('wap.login.login',[
            'return_url' => $return_url,
        ]);
    }


    ////执行登录
    public function postLogin(Request $request){
        $u = Session::get('member');
        //微信进来没有手机号的
        if(1==0 && $u && User::find($u->id)->phone =='' && User::find($u->id)->openid !=''){
            $m3 = new M3result();
            //username 可以是phone name email
            //微信进来了 如果我之前注册过 则同步微信的信息到我原来的账号信息
            if($user = User::checkUseradnpassword($request->input('password'),$request->input('username'))){
                //同步微信的信息到我原来的账号信息
                $user->openid=$u->openid;
                $user->access_token_get_time=$u->access_token_get_time;
                $user->headimgurl=$u->headimgurl;
                $user->country=$u->country;
                $user->city=$u->city;
                $user->province=$u->province;
                $user->sex=$u->sex;
                $user->access_token=$u->access_token;
                $user->nickname=$u->nickname;
                $user->save();
                //删除原来的微信用户身份
                User::find($u->id)->delete();
                Session::set('member',$user);//登录成功写入session
                //用户登录后做购物车的同步处理
                $scart = Session::get('cart');
                $cartstatus = false;
                //分为用户在线和不在线
                //1.有session购物车
                if($scart){
                    if( Order::saveScartTocart($scart) ){
                        $cartstatus = true;
                        Session::forget('cart');
                        return $m3->build(1, '登录成功', '/wap/home/index');
                    }else{
                        return $m3->build(0, '登录失败', '/wap/login/login');
                    }
                }else{
                    return $m3->build(1, '登录成功', '/wap/home/index');
                }
            }else{
                r(0,'用户名或密码错误111','/wap/home/index');
            }
        }else{
            $m3 = new M3result();
            //username 可以是phone name email
            if($user = User::checkUseradnpassword( $request->input('password'),$request->input('username') )){
                Session::set('member',$user);//登录成功写入session
                //用户登录后做购物车的同步处理
                $scart = Session::get('cart');
                $cartstatus = false;
                //分为用户在线和不在线
                //1.有session购物车
                if($scart){
                    if( Order::saveScartTocart($scart) ){
                        $cartstatus = true;
                        Session::forget('cart');
                        return $m3->build(1, '登录成功', '/wap/home/index');
                    }else{
                        return $m3->build(0, '登录失败', '/wap/login/login');
                    }
                }else{
                    return $m3->build(1, '登录成功', '/wap/home/index');
                }
            }else{
                r(0,'用户名或密码错误1','/wap/home/index');
            }
        }

    }
    //发送验证码
    public function postSms(Request $request){
        header("Content-Type: text/html; charset=UTF-8");
        //以下信息自己填以下
        $code=rand(1000,9999);


        $flag = 0;
        $params='';//要post的数据
        $argv = array(
            'name'=>'15000238179',     //必填参数。用户账号
            'pwd'=>'4A385D8F103FBCB53BC7182132BA',     //必填参数。（web平台：基本资料中的接口密码）
            'content'=>"您在".date('Y-m-d H:i:s')."要求发送的注册验证码是:".$code."，请在3分钟内输入。",   //必填参数。发送内容（1-500 个汉字）UTF-8编码
            'mobile'=>$request->input('phone'),   //必填参数。手机号码。多个以英文逗号隔开
            'stime'=>'',   //可选参数。发送时间，填写时已填写的时间发送，不填时为当前时间发送
            'sign'=>'微音国际',    //必填参数。用户签名。
            'type'=>'pt',  //必填参数。固定值 pt
            'extno'=>''    //可选参数，扩展码，用户定义扩展码，只能为数字
        );
        //print_r($argv);exit;
        //构造要post的字符串
        //echo $argv['content'];
        foreach ($argv as $key=>$value) {
            if ($flag!=0) {
                $params .= "&";
                $flag = 1;
            }
            $params.= $key."="; $params.= urlencode($value);// urlencode($value);
            $flag = 1;
        }
        $url = "http://web.duanxinwang.cc/asmx/smsservice.aspx?".$params; //提交的url地址
        $result= substr( file_get_contents($url), 0, 1 );  //获取信息发送后的状态

        if($result == '0'){
            Cache::put('sms'.$request->input('phone'),$code,5);//保存5分钟
            r('1','发送成功');
        }else{
            r('0','发送失败');
        }
    }

    //完善个人信息
    public function getAdjective(Request $request)
    {
        $user = Session::get('member');
        $user = User::find($user->id);
        r(1,'获取个人信息成功','',$user);
    }
    //提交个人信息
    public function postAdjective(Request $request)
    {
        $user = Session::get('member');
        $user = User::find($user->id);
        $user->name=$request->input('name');
        $user->email=$request->input('email');
        $user->people_id=$request->input('people_id');//客户号
        $user->social=$request->input('social');//社交帐号
        $user->sex=$request->input('sex');
        $user->country=$request->input('country');
        $user->btc=$request->input('btc');
        $user->eth=$request->input('eth');
        $user->cardid=$request->input('cardid');
        if($user->save()){
            Session::set('member',$user);
            r(1,'保存成功');
        }else{
            r(0, '保存失败');
        }
    }

    public function postMkpasswd(Request $request)
    {
        $user = Session::get('member');
        if(User::where('id',$user->id)->update(['password'=>password($request->password)])){
            r(1,'设置密码成功！','');
        }else{
            r(0,'设置密码失败！','');
        }
    }

    //退出
    public function postLogout(Request $request)
    {
        Session::flush();
        $m3=new M3result();
        return $m3->build(1, '退出登录1');
    }

    //判断用户是否存在
    public function postIsuser(Request $request)
    {
        if (User::isUser($request->input('username'))) {
            r(1, '用户存在', '');
        } else {
            r(0, '用户不存在', '');
        }
    }


    //注册页面
    public function getReg(Request $request)
    {//推荐注册链接类似 register?u=13818493635
        $u=$request->input('u')?$request->input('u'):Session::get('u');
        if( $u ){
            Session::set('u',$u);
            $fid=User::where('phone',$u)->first()->id;
            $ffid=User::where('phone',$u)->first()->fid;
            $fphone=$fid>0?substr_replace($u, '****', 3, 4):'';
        }else{
            $fid=0;
            $ffid=0;
            $fphone='';
        }
        return view('wap.login.reg',[
            'fid'=>$fid,
            'ffid'=>$ffid,
            'fphone'=>$fphone,
        ]);
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
    //表单ajax验证用户手机存不存在
    public function postCheckphone1(Request $request)
    {
        if( User::where('phone',$request->input('param'))->first() ){
            $m3=new M3result();
            return $m3->build(2, '', '');
        }else{
            r('y','存在');
        }
    }
    //表单ajax验证用户手机存不存在
    public function postCheckphone2(Request $request)
    {
        if( User::where('phone',$request->input('param'))->first() ){
            r('y','存在');
        }else{
            $m3=new M3result();
            return $m3->build(2, '', '');
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


    //给手机发关code
    public function postSendcode(Request $request)
    {
        $code = '111111';
        Cache::forget('r'.$request->input('phone'));
        if (Cache::set('r'.$request->input('phone'),$code)){
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
        $member = new User;
//        $fid=$request->input('fid')?$request->input('fid'):0;
//        $ffid=$request->input('ffid')?$request->input('ffid'):0;
        //echo $fid;exit;
//        $member->name = $request->input('username');
        if( Cache::get('sms'.$request->input('phone'))!=$request->input('code') ){
            r(2,'验证码错误！');
        }
        if( User::where('phone',$request->input('phone','1'))->first() ){
            r(3,'手机存在了！');
        }
        $member->phone = $request->input('phone');
//        $member->f_id = $fid;
//        $member->ff_id = $ffid;
//        $member->email = $request->input('email');
        $member->password = password($request->input('password'));
        if($member->save()){
            r(1,'注册成功','/view/member/login');
        }else{
            r(0,'注册失败','');
        }
    }
    //忘记密码
    //将注册的会员的信息插入表中
    public function postReseting(Request $request){
        if( Cache::get('sms'.$request->input('phone'))!=$request->input('code') ){
            r(2,'验证码错误！');
        }
        if( !User::where('phone',$request->input('phone','1'))->first() ){
            r(3,'用户不存在！');
        }
        if(User::where('phone',$request->phone)->update(['password'=>password($request->password)])){
            r(1,'重置密码成功','/view/member/login');
        }else{
            r(0,'重置密码失败','');
        }
    }

    /**
     * @param Request $request
     * 退出
     */
    public function getLogout(){
        Session::flush();
        return redirect('/wap/home/index');
    }

    public function getWxh5pay(){
        return view('wap.login.wxh5pay');
    }

    public function postCooke(){
        $user = Session::get('member');
        if(isset($user->id)){
            r(1,'cooke ok','',$user->toJson());
        }else{
            r(0,'cooke emplet','');
        }
    }












}