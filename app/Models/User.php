<?php

namespace App\Models;

use App\Entity\Curl;
use App\Entity\M3result;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Intervention\Image\ImageManagerStatic as Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
class User extends Model
{
    use EntrustUserTrait;
    protected $table = 'user';
    protected $primaryKey = 'id';

    //发送邮件
    public static function sendMail($subject,$content,$to)
    {
        Curl::vget( 'http://luck.voipgarden.cn/api/mail?subject='.$subject.'&content='.$content.'&to='.$to);
    }
    ////取一个人的下面二,三级的用户的图表
    public static function UserGraph($userid)
    {
        $user = User::find($userid);
        $re = [];
        $l1[] = User::find($user->s1)?:'';
        $l1[] = User::find($user->s2)?:'';
        $l1[] = User::find($user->s2)?:'';
        $l2[]=self::getOneUserGraph($user->s1);
        $l2[]=self::getOneUserGraph($user->s2);
        $l2[]=self::getOneUserGraph($user->s3);
        $re[]=$l1;
        $re[]=$l2;
        return $re;
    }
    //取一个人的下面二级的用户的图表
    public static function getOneUserGraph($userid){
        $user = User::find($userid);
        if($user){
            $l1[] = User::find($user->s1)?:'';
            $l1[] = User::find($user->s2)?:'';
            $l1[] = User::find($user->s2)?:'';
        }else{
            $l1=['','',''];
        }

        return $l1;
    }
    //注册成功触发相关业务
    public static function regnotify($userid)
    {
        $mi = User::find($userid);
        //如果session有推广人的手机号
        if($user = User::where('phone',Session::get('u'))->first()){
            $mi->f_id = $user->id;
            //如果我的推广人的id有f_id，写入到我的ff_id
            if($user->f_id != '0'){
                $mi->ff_id=$user->f_id;
            }
            $mi->save();
        }
    }
    //设置user cookie信息
    public static function setUser($user)
    {
        $user->ip = $_SERVER["REMOTE_ADDR"];
        Session::set('member',$user);
        Session::set('wxf','1');//设置是标识是有微信服务号用
    }
    //用户相关验证
    public function checkPhoneNameEmail($username){
        $user = User::where('phone',$username)->where('name',$username)->where('email',$username)->first();
        if($user){
            return true;
        }else{
            return false;
        }
    }
    //判断用户有没有存在
    public static function isUser($username){
        if(User::where('phone',$username)->orWhere('name',$username)->orWhere('email',$username)->first()){
           return true;
        }else{
            return false;
        }
    }
    //验证用户名密码
    public static function checkUseradnpassword($password,$username){
        if($user = User::where('password',password($password))->where(function($query) use ($username){
            $query->where('phone',$username)->orWhere('name',$username)->orWhere('email',$username);
        })->first()){
            return $user;
        }else{
            return false;
        }
    }
    //验证用户名密码
    public static function checkUseradnpasswordadmin($password,$username,$s=''){
        if($user = User::where('password',password($password))->where(function($query) use ($username,$s){
            if($s){
                $query->where('phone',$username)->orWhere('name',$username)->orWhere('email',$username);
            }
            $query->where('phone',$username)->orWhere('name',$username)->orWhere('email',$username);
        })->where('admin','1')->first()){
            return $user;
        }else{
            return false;
        }
    }
    //public $timestamps = false;
    //多对多关联
//    public function take()
//    {
//        return $this->belongsToMany('App\Models\Take','take_has_user')->withTimestamps()->withPivot('luck_number','id','ip','created_at','updated_at','status');
//    }
    //一对多到关联
    public function goods()
    {
        return $this->hasMany('App\Models\Goods');
    }
    //一对多到关联
    public function userbank()
    {
        return $this->hasMany('App\Models\Userbank');
    }
    //一对多一
    public function shop()
    {
        return $this->hasOne('App\Models\Shop');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }
    //多对多
    public function goodss()
    {
        return $this->belongsToMany('App\Models\Goods','user_goods')->withPivot(['created_at','id','price','btcprice','payback']);
    }

    //获取礼包等级对应的价格，也就是用户购买等级的业绩，用于计算对碰奖
    public static function getLvmoney($lv){
        switch($lv){
            case 1:
                return 68000;
                break;
            case 2:
                return 300000;
                break;
            case 3:
                return 1000000;
                break;
            case 4:
                return 3000000;
                break;
            case 5:
                return 5800000;
                break;
            case 11:
                return 19900;
                break;
        }
        return 0;
    }

    //获取一个空位置-滑落机制核心 v1.0
    //2017-12-22 目前运作完美
    //第二个参数指定循环的次数，因为初始第一次循环不能查找兄弟位置（即父用户本身，不能找父用户的兄弟位置；而第二次循环以后可以查找兄弟位置）
    public static function getOnespace($uid,$r=0){
        //原理是循环上级的下线直到得到一个空位
        $tmpu=User::find($uid);
        if(!$tmpu['s1']){return [$uid,'s1'];}
        if(!$tmpu['s2']){return [$uid,'s2'];}
        if(!$tmpu['s3']){return [$uid,'s3'];}
        if($r>0){
            $r++;
            if($r<4) {
                $tmpu2 = User::find($tmpu['s' . $r]);
                if (!$tmpu2['s1']) {
                    return [$tmpu2['id'], 's1'];
                }
                if (!$tmpu2['s2']) {
                    return [$tmpu2['id'], 's2'];
                }
                if (!$tmpu2['s3']) {
                    return [$tmpu2['id'], 's3'];
                }
                return User::getOnespace($tmpu['s'.$r],$r);
            }else{
                $r=1;
                $tmpu2 = User::find($tmpu['s' . $r]);
                return User::getOnespace($tmpu2['s1'],$r);
            }

        }else{
            $r=1;
            return User::getOnespace($tmpu['s1'],$r);

        }
    }
    //获取等级对应的直推比例
    public static function getfPer($lv){
        switch($lv){
            case 1:
                return 0.04;
                break;
            case 2:
                return 0.08;
                break;
            case 3:
                return 0.1;
                break;
            case 4:
                return 0.15;
                break;
            case 5:
                return 0.2;
                break;
        }
    }
    //获取等级对应的二代奖比例
    public static function getffPer($lv){
        switch($lv){
            case 1:
                return 0.02;
                break;
            case 2:
                return 0.04;
                break;
            case 3:
                return 0.6;
                break;
            case 4:
                return 0.08;
                break;
            case 5:
                return 0.1;
                break;
        }
    }

    //生成推广注册的图片
    public static function img($url)
    {
        $user = Session::get('member');
        $st = '/upload/lg/' . rand(10000, 99999) . "ewm" . date('Y-m-d-h-i-s') . ".png";
        QrCode::format('png')->size(460)->generate($url, public_path($st));
//        print_r($st);exit;
        $ewm = Image::make(public_path($st));//二维码

//        $top = Image::make('http://wx.qlogo.cn/mmopen/GIC104VGkeibzVhjbuDSTMBbYk0DqcQheYRP9vjpHqOl64lUI7jQxghTYrNgvWx1ZCaDtvHLLDIFEjFTH9o3seTTleXB2XCAz/0');
//        $top = Image::make($request->input('userimg'));
        $img = Image::make(public_path('/upload/lg/lg.jpg'));
        $img->gamma(0.8);
        $bs = Image::make(public_path('/upload/lg/bs.png'));//白色图
        $wximg = Image::make($user->headimgurl);//微信头像
//        $img->text($request->input('username',222),50,308,function($constraint){
//            $constraint->file('/home/wwwroot/www.myweishengjin.com/public/view/font/wqy-microhei.ttc');
//            $constraint->size(18);
//            $constraint->color('#000');
//        });
//        $img->text($request->input('price',222),190,420,function($constraint){
//            $constraint->file('/home/wwwroot/www.myweishengjin.com/public/view/font/wqy-microhei.ttc');
//            $constraint->size(24);
//            $constraint->color('#f00');
//        });
        $bs->resize(55, 55);
        $wximg->resize(45, 45);
        $img->insert($ewm, 'bottom', -10, 90);
        $img->insert($bs, 'bottom', -15, 280);
        $img->insert($wximg, 'bottom', -27, 292);
//        $top->resize(90, 90);
//        $img->insert($top,'bottom',1,530);
//        return view('admin.goods.test');
        $nameimg = rand(100,999).date('Ymd').'.jpg';
        $imgurl='upload/'.$nameimg;
        $img->save(public_path($imgurl));
        return '/'.$imgurl;
    }

    //取用户
    public static function getUser(){
        if(Session::get('user')){
            return User::find(Session::get('user')->id);
        }else{
            return User::find(Session::get('member')->id);
        }

    }


    public function banks()
    {
        return $this->hasMany('App\Models\Bank');
    }

//一对多与活到关联
//    public function address()
//    {
//        return $this->hasMany('App\Models\Address');
//    }
//    //一对多与活到关联
    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
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
