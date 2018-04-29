<?php

namespace App\Http\Controllers;
use App\Entity\Curl;
use App\Entity\Kdn;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Express;
use App\Models\Goods;
use App\Models\Goods1;
use App\Models\Goods2;
use App\Models\Goodscategory;
use App\Models\Goodsimage;
use App\Models\Pay;
use App\Models\Payaddress;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Shop;
use App\Tool\UUID;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity\M3result;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Log;

class TestController extends Controller
{
    public function postJcj(Request $request)
    {
        $m3=new M3result();
        return $m3->build('y', '22', '');
        print_r($_GET);exit;
        print_r($request->input('_token'));exit;
    }
    public function getJcj(Request $request)
    {

        print_r(password('admin888'));exit;
        print_r(date('Y-m-d H:i:s',1523190542000));exit;
        print_r(time());exit;
        print_r(count(Payaddress::where('user_id','')->get()));exit;
        $a = [];//aaa
        $payaddress = Payaddress::all();
        foreach ($payaddress as $item) {
            $time = (time() - strtotime($item->created_at)) / 60;
            $a[] = $time;
            if($time > 10){
                $item->user_id='';
                $item->goods_id='';
                $item->price='';
                $item->btcprice='';
                $item->save();
            }
        }
//        Payaddress::where('user_id','!=','')->update(['user_id'=>'']);
        print_r($hasnum = count(Payaddress::where('user_id','')->get()) );exit;
        print_r(password('admin888'));exit;
        $aa = Mail::raw('参议会了',function($message){
            $message->to('18666015093@163.com')->subject('通知');
        });
        print_r($aa);exit;
        print_r(Cache::get('sms18666015093'));exit;
        print_r(password('admin888'));exit;
        print_r(date('Y-m-d H:i:s'));exit;
        $u = Goods1::whereNotNull('id')->lists('user_name')->toArray();
        print_r($u);exit;
        print_r(password('rexmall888'));exit;
        print_r(Goods::where('id','>=',1)->count());exit;
        print_r(urlencode("http://www.qq.com"));exit;
        header("Content-Type:text/html; charset=UTF-8");
        header("Access-Control-Allow-Origin:http://www.myweishengjin.com");
        header('Access-Control-Allow-Methods:GET,POST,OPTIONS');
        header('Access-Control-Allow-Headers:X-Requested-With, Content-Type');
        echo 1111;exit;
       $re = Goods::whereNotIn('shop_id',[1,2])->update(['shop_id'=>2]);
       print_r($re);exit;
        print_r($user = User::checkUseradnpassword('qqqqqq','18666015093'));exit;
        print_r($_SERVER);exit;
        $user = User::find(1);
        print_r($user->roles->pluck('id')->toArray());exit;
        print_r(in_array(1,User::whereNotNull('id')->pluck('id')->toArray()));exit;

        print_r(User::where('id',1)->first()->shop->id);exit;
        $a = 'aa';
        $ss = function() use($a){
            return $a;
        };
        print_r($ss());exit;
        $user = User::find(1)->increment('shop_id',2);
        print_r(2);exit;
        if(in_array(1,[1,2,3])){
            return 22;
        }
        return User::whereNotNull('id')->count();
        Cache::put('r18666015093',1111,10);
//        print_r(password('admin'));exit;
        print_r(Cache::get('r18666015093'));exit;
        $g=Goods::first();
        print_r($g->first_img);exit;
        print_r(2);exit;
        phpinfo();exit;
        $pay=Pay::where(array('order_uid'=>'2023877820171231231145'))->whereNull('openid')->first();
        if($pay) {
            print_r(111);exit;
        }
        print_r($_SERVER['HTTP_HOST']);exit;
        print_r(config('wechat.mchKey'));exit;
        print_r(config('wechat')['app_id']);exit;
        print_r($_SERVER['HTTP_HOST']);exit;
        DB::beginTransaction();
        $u=new User;
        $u->name = 111;
        $u->save();
        if($request->input('id') == 11){
            DB::commit();
        }else{
            DB::rollBack();
        }
        return 11;
        print_r(User::whereNotNull('id')->get()->column('id'));exit;
        print_r( (DB::select('select sum(id) sum from db_user'))[0]->sum );exit;
        print_r(!User::where('id','<',1)->update(['cardid'=>12]));exit;
        $kdn=new Kdn();
        print_r($kdn->getOrderTracesByJson('YD','1000928156811'));exit;
        print_r(Express::getInterflow('YD','1000928156811'));exit;
        print_r(base_path('app'.DIRECTORY_SEPARATOR.'Entity'.DIRECTORY_SEPARATOR.'Kdn.php'));exit;
       $user = User::find(1);
       $user->email='11121@163.com';
       $user->save();
        print_r($user->name);exit;

    }

    //导入goods
    public function getData()
    {
//        $goods1s=Goods1::where('id','>=',1)->update(['status'=>0]);exit;
        $num =100;
        $goods1s=Goods1::where('id','>=',1)->where('status','!=','1')->limit($num)->get();
        if(!count($goods1s)){
            return 111;
        }
        foreach($goods1s as $goods1){
            $goods = new Goods;
            $shop = Shop::where('name',$goods1->user_name)->first();
            $goods->shop_id=$shop->id;
            $goods->name=$goods1->goods_name;
            $goods->content=$goods1->goods_pc_info;
            $goods->mcontent=$goods1->goods_wap_info;
            $goods->price=$goods1->goods_price*100;
            $goods->seller_note=$goods1->seller_note;
            //分类
            $goods->category_id=(Goodscategory::where('name',$goods1->cat2)->first()->id);
            $goods->save();
            //图片处理
            $goodsimg = new Goodsimage();
            $goodsimg->goods_id=$goods->id;
            $goodsimg->smallimage=$goods1->goods_thumb;
            $goodsimg->bigimage=$goods1->goods_img;
            $goodsimg->image=$goods1->goods_img.',,,,,';
            $goodsimg->save();
            //更改零时表状态
            $goods1->status=1;
            $goods1->save();

        }


    }
    public function getShop111()
    {
        return 11;
        $num =1;
        $goods1s=Goods1::where('id','>=',1)->groupBy('cat2')->get();
        foreach ($goods1s as $goods1) {
            $goodscategory1=Goodscategory::where('name',$goods1->cat1)->first();
            $shop = new Goodscategory();
            $shop->pid = $goodscategory1->id;
            $shop->path = '0-1-1-1-1-'.$goodscategory1->id;
            $shop->name = $goods1->cat2;
            $shop->save();
        }
        return 11;


    }
    public function getClear111()
    {
        set_time_limit(80000);
        $goods1s=Goods::where('id','>=',1)->get();
        print_r(count($goods1s));exit;
        foreach ($goods1s as $goods1) {
            $goods2 = new Goods2;
            $goods2->id=$goods1->id;
            $goods2->category_id=$goods1->category_id;
            $goods2->shop_id=$goods1->shop_id;
            $goods2->name=$goods1->name;
            $goods2->price=$goods1->price;
            $goods2->base_price=$goods1->base_price;
            $goods2->gain_price=$goods1->gain_price;
            $goods2->content=$goods1->content;
            $goods2->mcontent=$goods1->mcontent;
            $goods2->is_hot=$goods1->is_hot;
            $goods2->is_ground=1;
            $goods2->gift_lv=$goods1->gift_lv;
            $goods2->category=$goods1->category;
            $goods2->seller_note=$goods1->seller_note;
            $goods2->save();
        }
        return 11;


    }
    public function getPhone1111()
    {
        $goods1s=User::where('id','>=',60)->get();
        foreach ($goods1s as $user) {
            $user->attachRole(Role::find(12));
        }
        return 11;


    }
    public function getUser1111()
    {
        return 11;
        $goods1s=Shop::where('id','>=',1)->get();
        foreach ($goods1s as $shop1) {
            $user = new User;
            $user->name=$shop1->name;
            $user->real_name=$shop1->name;
            $user->is_seller=1;
            $user->password=password('rexmall888');
            $user->phone='18666666666';


            $user->save();
            $shop1->user_id=$user->id;
            $shop1->save();
        }
        return 11;


    }

    public function getRole(Request $request)
    {
        $user=User::find(2);
//        print_r($user->can('create-post'));exit;
//        print_r($user->hasRole('owner'));exit;

//print_r($user->attachRole(12));exit;
//print_r($user->detachRole(12));exit;

//        $r = Role::where('id',13)->first();
//        $r->attachPermission([Permission::find(5)]);
        print_r($user->can('admin'));exit;

//        $shop = new Role();
//        $shop->name = 'admin';
//        $shop->display_name = '管理员角色';
//        $shop->description = '管理员角色';
//        $shop->save();
//        $shoppermission = new Permission();
//        $shoppermission->name = 'admin';
//        $shoppermission->display_name = '管理员权限';
//        $shoppermission->description = '管理员权限';
//        $shoppermission->save();
//        $shop->attachPermission([$shoppermission]);
//        return 1;
//
//        $shop = new Role();
//        $shop->name = 'shop';
//        $shop->display_name = '店铺角色';
//        $shop->description = '店铺角色';
//        $shop->save();
//        $shoppermission = new Permission();
//        $shoppermission->name = 'shop';
//        $shoppermission->display_name = '店铺权限';
//        $shoppermission->description = '店铺权限';
//        $shoppermission->save();
//        $shop->attachPermission([$shoppermission]);
//        return 1;

//
//        $admin = new Role();
//        $admin->name = 'admin';
//        $admin->display_name = 'User Administrator';
//        $admin->description = 'User is allowed to manage and edit other users';
//        $admin->save();
//
//        $user = User::where('name', '=', 'admin')->first();

//调用EntrustUserTrait提供的attachRole方法
//        $user->attachRole($owner); // 参数可以是Role对象，数组或id


//        $createPost = new Permission();
//        $createPost->name = 'create-post';
//        $createPost->display_name = 'Create Posts';
//        $createPost->description = 'create new blog posts';
//        $createPost->save();

//        $editUser = new Permission();
//        $editUser->name = 'edit-user';
//        $editUser->display_name = 'Edit Users';
//        $editUser->description = 'edit existing users';
//        $editUser->save();
        Role::find(10)->attachPermission(3);
        return 22;
//等价于 $owner->perms()->sync(array($createPost->id));

//        $admin->attachPermissions(array($createPost, $editUser));//用户角色添加权限
//等价于 $admin->perms()->sync(array($createPost->id, $editUser->id));

    }

    public function getInfo()
    {
        phpinfo();
    }


    public function getTest(Request $request)
    {
        print_r($request->session()->get('user'));exit;
    }


    public function getIndex()
    {
//        Cache::put('aa',11,5);
        return Cache::has('aa') ? Cache::get('aa') : 99;
        print_r(Session::get('member'));exit;
        print_r(User::all());exit;
        print_r(UUID::create('wx_'));exit;
//        return User::all()->lists('name','id');
        return User::whereNotIn('id',[1])->get();
        print_r($u);exit;
//        Session::set('member');
        if($u = Session::get('m1ember')){
            return 1;
        }else{
            return 3;
        }
    }


}