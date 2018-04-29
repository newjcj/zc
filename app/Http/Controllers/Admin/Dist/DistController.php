<?php
namespace App\Http\Controllers\Admin\Dist;
use App\Models\Dist;
use App\Models\Dists;
use App\Models\Goods;
use App\Models\Goodscategory;
use App\Models\Goodsimage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity\M3result;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Log;

class DistController extends Controller{
    //dist列表11223344556677
    public function getDist(Request $request)
    {
        return view('admin.dist.dist',[
            'dists'=>Dists::all(),
        ]);
    }

    //上传
    public function getUpl(Request $request)
    {
        return view('admin.dist.upl');
    }

    //上传
    public function postUpl(Request $request)
    {
        $dists = new Dists();
        $dists->img = 'http://'.$_SERVER['SERVER_NAME'].$request->input('img');
        $dists->iconname = $request->input('iconname');
        if($dists->save()){
            r(1,'上传成功');
        }else{
            r(0, '上传失败');
        }
    }
    //删除
    public function postDel(Request $request)
    {
        $dists = Dists::find($request->input('id'));
        if($dists->delete()){
            r(1,'删除成功');
        }else{
            r(0, '删除失败');
        }
    }









}