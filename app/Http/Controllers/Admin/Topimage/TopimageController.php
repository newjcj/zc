<?php
namespace App\Http\Controllers\Admin\Topimage;
use App\Models\Topimage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Log;

class TopimageController extends Controller{
    public function getIndex(Request $request){
        $topimage=Topimage::all();
        return view('admin.topimage.topimage.index',['topimage'=>$topimage]);
    }

    //添加广告图片
    public function getAdd(Request $request){
        return view('admin.topimage.topimage.add',[]);
    }

    //执行添加广告图片
    public function postAdd(Request $request){
        $topimage = new Topimage;
        //$topimage->start = $request->input('start');
        $topimage->name = $request->input('name');
        $topimage->image = $request->input('preview1');
        $topimage->url = $request->input('url');
        $topimage->created_at = time();
        $start = explode('/',$request->input('start'));
        $end = explode('/',$request->input('end'));
        $start1=$start[2]."-".$start[0]."-".$start[1];
        $end1=$end[2]."-".$end[0]."-".$end[1];
        $topimage->start = $start1;
        $topimage->end = $end1;
//        print_r(trim($start1,'-'));exit;
//        Log::INFO($_POST);
        if($topimage->save()){
            r(1,'添加成功','/admin/topimage/topimage/index');
        }else{
            r(0,'添加失败','');
        }
    }

    //编辑广告图片
    public function getEdit(Request $request){
        if($topimage = Topimage::find($request->input('id',''))) {
//            return $goods->category_id;
            return view('admin.topimage.topimage.edit', [
                'topimage'=>$topimage
            ]);
        }else{
            return redirect('/admin/topimage/topimage/index');
        }

    }

    //执更新加广告图片
    public function postUpdate(Request $request){
//       Log::info($_POST);
        $topimage = Topimage::find($request->input('id'));
        $topimage->url = $request->input('url');
        $topimage->image = $request->input('preview1');
        $topimage->name = $request->input('name');
        $topimage->updated_at = time();
        $start = explode('/',$request->input('start'));
        $end = explode('/',$request->input('end'));
        $start1=$start[2]."-".$start[0]."-".$start[1];
        $end1=$end[2]."-".$end[0]."-".$end[1];
        $topimage->start = $start1;
        $topimage->end = $end1;
        if($topimage->save()){
            r(1,'更新成功','/admin/goods/goods/index');
        }else{
            r(0,'更新失败','');
        }
    }

    //删除商品
    public function postDelete(Request $request)
    {
        $topimage = Topimage::find($request->input('id'));
        if( $topimage->delete()){
            r(1,'删除成功','/admin/topimage/topimage/index');
        }else{
            r(0,'删除失败','');
        }
    }







}