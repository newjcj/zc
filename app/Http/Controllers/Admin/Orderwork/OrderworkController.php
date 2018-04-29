<?php
namespace App\Http\Controllers\Admin\Orderwork;
use App\Models\Goods;
use App\Models\Goodscategory;
use App\Models\Goodsimage;
use App\Models\Orderwork;
use App\Models\Orderworkdetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity\M3result;
use App\Models\User;
use App\Models\Shop;
use Illuminate\Support\Facades\Session;
use Log;

class OrderworkController extends Controller{

    //客服列表 
    public function getOrderwork(Request $request)
    {
        $orderworks = Orderwork::whereNull('status')->get();
        $orderworks = Orderwork::whereNotNull('id')->paginate(10);
        return view('admin.orderwork.orderwork.orderwork',[
            'orderworks'=>$orderworks
        ]);
    }
    //工单流水列表
    public function getOrderworklist(Request $request)
    {
        $orderworkdetails = Orderwork::find($request->id)->orderworkdetails()->paginate(10);
        return view('admin.orderwork.orderwork.orderworklist',[
            'orderworkdetails'=>$orderworkdetails,
            'id'=>$request->id,
        ]);
    }
    //工单详细
    public function getOrderworkdetail(Request $request)
    {
        $orderworkdetail = Orderworkdetail::find($request->input('id'));
        return view('admin.orderwork.orderwork.orderworkdetail',[
            'orderworkdetail'=>$orderworkdetail,
            'orderworkid'=>$orderworkdetail->orderwork->id,
        ]);
    }
    //工单回复
    public function postOrderworkback(Request $request){
        $orderworkdetail = Orderworkdetail::find($request->input('id'));
        $orderworkdetail->back=$request->input('back');
        $orderwork = $orderworkdetail->orderwork;
        $orderwork->status=1;
        $orderwork->save();
        if($orderworkdetail->save()){
            r(1,'回复成功');
        }else{
            r(0,'回复失败');
        }
    }

    public function postDelete(Request $request)
    {
        $orderwork = Orderwork::find($request->input('id'));
        if($orderwork->delete()){
            r(1, '删了成功');
        }else{
            r(1, '删了失败');
        }
    }








}