<?php
namespace App\Http\Controllers\Admin\Order;

use App\Models\Express;
use App\Models\Order;
use App\Models\Ordergoods;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Log;

class OrderController extends Controller{
    public function getIndex(Request $request)
    {
        $user = User::getUser();
        $express=Express::all();
        if(User::getUser()->can('admin')){
            $order=Order::all();

        }elseif(User::getUser()->can('shop')){
            $order=Order::where('shop_id',$user->id)->get();
        }else{
            return "没有权限";
        }
        return view('admin.order.order.index',[
            'order'=>$order,
            'express' =>$express
        ]);
    }

    //修改订单页面
    public function postIndex(Request $request)
    {
//        return User::all()->toArray();
      //  r(1,'更新成功','/admin/order/order/index',User::all());
        $order = Order::find($request->input('id'));
        $order->express = $request->input('express');
        $order->status = $request->input('status');
        $order->express_id = $request->input('knameid');
        if($order->save()){
            r(1,'更新成功','/admin/order/order/index');
        }else{
            r(0,'更新失败','');
        }
    }

    //显示订单内商品详情
    public function postOrdergoods(Request $request)
    {
//        return User::all()->toArray();
        //  r(1,'更新成功','/admin/order/order/index',User::all());
        $order = Order::find($request->input('id'));
//        print_r( ($order->goodss)[0]->name );exit;
        r(1,'更新成功','/admin/order/order/index',$order->goodss);
    }

    //删除订单的信息
    public function postDelete(Request $request)
    {
        $order = Order::find($request->input('id'));
        $ordergoods = Ordergoods::where('order_id',$request->input('id'))->get();
        if($order->delete() && $ordergoods->delete()){
            r(1,'删除成功','/admin/order/order/index');
        }else{
            r(0,'删除失败','');
        }
    }


//    //修改订单页面
//    public function getOrder_goods(Request $request)
//    {
//        $order=Order::all();
//        return view('admin.order.order.index',['order'=>$order]);
//    }

}