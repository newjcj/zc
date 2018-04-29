<?php
namespace App\Http\Controllers\Wap;
use App\Models\Goods;
use App\Models\Goodscategory;
use App\Models\Orderwork;
use App\Models\User;
use App\Models\Usergoods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller{
    public function getIndex(Request $request)
    {
       //取所有没有过期的项目
        $data = Goods::getAlltimeok($request->input('page'));
        $count = Goods::whereNotNull('id')->count();
        r($count/10,'获取成功','',$data);
    }
    //取一个商品
    public function getGoods(Request $request)
    {
        $data = Goods::getOnetimeok($request->input('id'));
        r(1,'获取成功','',$data[0]);
    }
    //商品列表
    public function getList(Request $request)
    {
        $goodss = Goods::all();
        return view('wap.home.list',[
            'goods'=>22222,
            'goodss'=>$goodss,
        ]);
    }
    //已投项目明细
    public function getDetail(Request $request)
    {
        $user = Session::get('member');
        $data = User::find($user->id)->goodss;
//        print_r($data[0]->times);exit;
//        print_r($data);exit;
        foreach ($data as $item) {
            $item->times = $item->times;
            $item->status = Goods::status($item->id);
            $item->payback = Usergoods::where(['goods_id'=>$item->id,'user_id'=>$user->id])->value('payback');
        }
//        print_r($data[0]->pivot->price);exit;
        r(1,'获取成功','', $data);
    }
    //项目进度接口
    public function getProgress(Request $request)
    {
        r(1,'获取成功','',Goods::progress($request->input('id')));
    }
    //项目状态
    public function getGoodsstatus(Request $request)
    {
        $msg = '项目状态:';
        $status = Goods::status($request->input('goodsid'));
        switch ($status) {
            case 1:
                $msg.='完成';
                break;
            case 2:
                $msg.='过期';
                break;
            case 3:
                $msg.='进行中';
                break;
        }
        r(1,'成功','',$msg);
    }
    //提交工单
    public function postOrderworkadd(Request $request)
    {
        $orderwork = new Orderwork();
        $user = Session::get('member');
        $orderwork->user_id = $user->id;
        $orderwork->content = $request->input('content');
        if($orderwork->save()){
            r('1','保存成功');
        }else{
            r('0','保存失败');
        }
    }
    //取工单 列表
    public function postOrderwork(Request $request)
    {
        $pageCount = 10;
        $user = Session::get('member');
        $orderworks = Orderwork::where('user_id',$user->id)->offset(($request->input('page')-1) * $pageCount)->limit($pageCount)->get();
        $count = Orderwork::where('user_id',$user->id)->count();
        if(count($orderworks)){
            r($count/$pageCount,'获取成功','',$orderworks);
        }else{
            r('0','没有记录');
        }
    }
    //后台回复工单
    public function postOrderworkback(Request $request)
    {
        $orderwork = Orderwork::find($request->input('id'));
        $orderwork->back = $request->input('back');
        $orderwork->status = 1;
        if($orderwork->save()){
            r('1','保存成功');
        }else{
            r('0','保存失败');
        }
    }












}