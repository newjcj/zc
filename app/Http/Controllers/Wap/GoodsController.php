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

class GoodsController extends Controller{

    //商品列表
    public function getList(Request $request)
    {

        if($request->input('up')!=""){
            $goods=Goods::where('category_id',$request->input('id'))->where('name','like','%'.$request->input('name').'%')->orderBy('price','asc')->get();
        }else if($request->input('down')!=""){
            $goods=Goods::where('category_id',$request->input('id'))->where('name','like','%'.$request->input('name').'%')->orderBy('price','desc')->get();
        }else{
            $goods=Goods::where('category_id',$request->input('id'))->where('name','like','%'.$request->input('name').'%')->get();
        }

        return view('wap.goods.list',[
            'goods'=>$goods,
            'id' => $request->input('id'),
            'name' =>$request->input('name'),
            'price'=>$request->input('price')
        ]);
    }

    //商品所有列表
    public function getAlllist(Request $request)
    {
        if($request->input('up')!=""){
            $goods=Goods::where('name','like','%'.$request->input('name').'%')->orderBy('price','asc')->get();
        }else if($request->input('down')!=""){
            $goods=Goods::where('name','like','%'.$request->input('name').'%')->orderBy('price','desc')->get();
        }else{
            $goods=Goods::where('name','like','%'.$request->input('name').'%')->get();
        }

        return view('wap.goods.alllist',[
            'goods'=>$goods,
            'name' =>$request->input('name')
        ]);
    }

    //商品的分类
    public  function  getCategory(Request $request){
        $category = Goodscategory::where('path','0-1-1-1-1')->get();
        $re=[];
        $good=[];
//        print_r($category[0]->name);exit;
        if(count($category)){
            foreach ($category as $k=>$cate){
                $pcate = Goodscategory::where('pid',$cate->id)->get();
                foreach ($pcate as $k=>$pc) {
                    $pgood = Goods::where('category_id',$pc->id)->get();
                    $good[$pc->id]= $pgood;
                }
                $re[$cate->id]= $pcate;
            }
        }
        // print_r($re[89]);exit;
        return view('wap.goods.category',[
            'category' => $category,
            'i' => 0,
            're' =>$re,
            'good' =>$good,
            'k' =>1
        ]);
    }
    //商品的分类jcj
    public  function  getCategory1(Request $request){

        return view('wap.goods.category1',[
            'categorys' => Goodscategory::where('pid',1)->get(),
        ]);
    }
    public  function  postCategorycontent(Request $request){
        return view('wap.goods.categorycontent',[
            'categorys' => Goodscategory::where('pid',$request->input('id'))->get(),
        ]);
    }


    //商品详情页
    public function getDetail(Request $request)
    {
//        print_r(Session::get('cart'));exit;
        $goods=Goods::find($request->input('id'));
        $ordergoods = Ordergoods::where("goods_id",$request->input('id'))->where("evaluate_status",3)->get();
        return view('wap.goods.detail',[
            'goods'=>$goods,
            'ordergoods'=>$ordergoods,
            'num'=>Cart::getGoodscartnum($goods->id),//取这个商品的购物车 没有则返回false
        ]);
    }

    //商品的评价页面
    public function getEval(Request $request){
        $ordergoods = Ordergoods::where("goods_id",$request->input('goodid'))->where("evaluate_status",3)->get();
        $re=[];
        if(count($ordergoods)){
            foreach ($ordergoods as $k=>$ordergood){
                $userid = Order::where('id',$ordergood->order_id)->first()->user_id;
                $re[$ordergood->id]['name'] =User::where('id',$userid)->first()->nickname;
                $re[$ordergood->id]['headimage'] =User::where('id',$userid)->first()->headimgurl;
            }
        }

        return view('wap.goods.eval',[
            'ordergoods'=>$ordergoods,
            're'=>$re
        ]);
    }

    //添加购物车
    public function postAddcart(Request $request)
    {
        if($member = Session::get('member')){
            //如果用户登录了
            $cart = new Cart;
            $cart->user_id=$member->id;
            $cart->goods_id = $request->input('goodsid');
            if($cart->save()){
                r(1,'保存成功','/',['cartcount'=>Cart::where('user_id',$member->id)->count()]);
            }else{
                r(2,'保存失败');
            }
        }else{
            r(0, '用户没有登录', '/view/wap/detail?id=' . $request->input('goodsid'));
        }
    }



    //显示购物车页面
    public function getCar(Request $request)
    {
        //1.登录
        if(Session::get('member') != ''){
            $user = Session::get('member');
            $carts=Cart::where('user_id',$user->id)->get();
            return view('wap.goods.car',[
                'carts'=>$carts,
                'status'=>1,
            ]);
        }else{
            //2.没登录
            //有session购物车
            if( $scart = Session::get('cart') ){
                $carts = Cart::sessionGetCarts($scart);
                return view('wap.goods.car',[
                    'carts'=>$carts,
                    'status'=>2,
                ]);
            }else{
                //没有session购物车
                return view('wap.goods.car',[
                    'carts'=>[],
                    'status'=>3,
                ]);
            }
        }
    }
    //删除购物车商品
    public function postDelcart(Request $request)
    {
        $cart = Cart::where('id',$request->input('id'))->first();
        if( $cart->delete() ){
            r(1,'删除购物车成功');
        }else{
            r(0,'删除购物车失败');
        }
    }

    //商品的分类
//    public  function  getCategory(Request $request){
//        $allgoods = Goods::all();
//        return view('wap.goods.category',[
//            'allgoods'=>$allgoods,
//        ]);
//    }



}