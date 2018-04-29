<?php
namespace App\Http\Controllers\Admin\Shop;

use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Log;

class ShopController extends Controller{

    //待办的供应商
    public function getIndex(Request $request)
    {
        $shop=Shop::whereNotIn('certify',[1])->get();
        return view('admin.shop.shop.index',['shop'=>$shop]);
    }

    public function postIndex(Request $request)
    {
        $shop = Shop::find($request->input('id'));
        $shop->certify = $request->input('regionid');
        if($shop->save()){
            r(1,'更新成功','/admin/shop/shop/index');
        }else{
            r(0,'更新失败','');
        }
    }

    //办结的供应商
    public function getIndex1(Request $request)
    {
        $shop=Shop::where('certify',[1])->get();
        return view('admin.shop.shop.index1',['shop'=>$shop]);
    }







}