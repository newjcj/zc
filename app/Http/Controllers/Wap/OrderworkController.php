<?php
namespace App\Http\Controllers\Wap;
use App\Entity\Kdn;
use App\Models\Cart;
use App\Models\Express;
use App\Models\Goods;
use App\Models\Goodscategory;
use App\Models\Order;
use App\Models\Ordergoods;
use App\Models\Orderwork;
use App\Models\Orderworkdetail;
use App\Models\Orderworkdetailfile;
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

class OrderworkController extends Controller{

    //创建工单
    public function postCreate(Request $request)
    {
        $user = Session::get('member');
        $orderwork = new Orderwork();
        $orderwork->user_id = $user->id;
        $orderwork->save();
        $orderworkdetail = new Orderworkdetail;
        $orderworkdetail->orderwork_id = $orderwork->id;
        $orderworkdetail->content = $request->input('content');
        $r = $orderworkdetail->save();
        if( count($request->input('imgs',[])) ){
            foreach ($request->input('imgs',[]) as $img) {
                $orderworkdetailfile = new Orderworkdetailfile();
                $orderworkdetailfile->orderworkdetail_id = $orderworkdetail->id;
                $orderworkdetailfile->img = $img['content'];
                if(!$orderworkdetailfile->save()){
                    $st=false;
                };
            }
            //图片 文件上传
            if($r){
                r(1,'保存成功','',$orderworkdetail->id);
            }else{
                r(0,'保存失败','',$orderworkdetail->id);
            }
        }else{
            if($r){
                r(1,'保存成功','',$orderworkdetail->id);
            }else{
                r(0,'保存失败','',$orderworkdetail->id);
            }
        }

    }
    //取工单列表
    public function getList(Request $request)
    {
        $page = $request->input('page');
        $orderworks = Orderwork::where('id','>',1)->offset(($page-1)*5)->limit(5)->get();
        if($count = Orderwork::where('id','>',1)->count()){
            r(floor($count/5)+1,'工单列表','',$orderworks);
        }else{
            r(0,'工单列表空','',$orderworks);
        }
    }
    //取工单流水列表
    public function getDetail(Request $request)
    {
        $count = Orderwork::find($request->input('id'))->orderworkdetails()->count();
        $page = $request->input('page');
        $orderworkdetails = Orderwork::find($request->input('id'))->orderworkdetails()->with('orderworkdetailfiles')->orderBy('id','desc')->offset(($page-1)*3)->limit(3)->get();
        if($count){
            r(floor($count/3)+1,'工单列表','',$orderworkdetails);
        }else{
            r(0,'工单列表空','',$orderworkdetails);
        }
    }
    //上传工单流水
    public function postDetail(Request $request)
    {
        //更新工单状态为未回复
        Orderwork::where('id',$request->id)->update(['status'=>'']);
        $orderworkdetail = new Orderworkdetail();
        $orderworkdetail->orderwork_id = $request->input('id');
        $orderworkdetail->content = $request->input('content');
        $orderworkdetail->save();
        $st=true;
        foreach ($request->input('imgs',[]) as $img) {
            $orderworkdetailfile = new Orderworkdetailfile();
            $orderworkdetailfile->orderworkdetail_id = $orderworkdetail->id;
            $orderworkdetailfile->img = $img['content'];
            if(!$orderworkdetailfile->save()){
                $st=false;
            };
        }
        //图片 文件上传
        if($st){
            r(1,'保存成功','');
        }else{
            r(0,'保存失败','');
        }
    }
    //上传文件
    public function postFile(Request $request)
    {
        $filename = '/upload/files/' . $_FILES["file"]["name"];
        $id = $request->input('id');//工单流水id
        $orderworkdetail = Orderwork::find($id)->orderworkdetails()->where('id','>',0)->orderBy('id','desc')->first();
        $orderworkdetailfile = new Orderworkdetailfile();
        $orderworkdetailfile->orderworkdetail_id = $orderworkdetail->id;
        $orderworkdetailfile->file = $filename;
        move_uploaded_file($_FILES["file"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'].'/upload/files/' . $_FILES["file"]["name"]);
        if($orderworkdetailfile->save()){
            r(1, '上传成功', '');
        }
    }



}