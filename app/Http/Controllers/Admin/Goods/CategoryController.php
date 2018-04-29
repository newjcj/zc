<?php
namespace App\Http\Controllers\Admin\Goods;
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

class CategoryController extends Controller{
    //分类列表
    public function getIndex(Request $request)
    {
        $category=DB::table('goods_category')
            ->select(DB::raw('image,id, name,path, concat(path,"-",id) as orderpath'))
            ->orderBy('orderpath')
            ->where('id','!=',0)->get();
        return view('admin.goods.category.index',['categorys'=>$category]);
    }
    //编辑分类
    public function getEdit(Request $request){
        $category = Goodscategory::find($request->input('id'));
        return view('admin.goods.category.edit',['category'=>$category]);
    }
    //添加分类
    public function getAdd(Request $request)
    {
        return view('admin.goods.category.add',['category'=>new Goodscategory()]);
    }
    //执行添加分类
    public function postAdd(Request $request){
        if(!$request->input('pid','') || !$request->input('name','')){

            r(0,'参数不全','/admin/goods/category/index');
        }
        $category = new Goodscategory;
        $category->pid=$request->input('pid');
        $category->name=$request->input('name');
        $category->path=$category->getPath($request->input('pid'));
        $category->image=$request->input('image','');
        $category->image2=$request->input('image2','');
        if($category->save()){
             r(1,'添加成功','');
        }else{
             r(2,'保存失败','');
        }
    }
    //执行编辑分类
    public function postEdit(Request $request){
        $pid = $request->input('pid');
        $id = $request->input('id');
        $pcategory = Goodscategory::find($pid);
        $category = Goodscategory::find($id);
        $ppath = $pcategory->path;
        $path = $category->path.'-'.$id;//本身子类配置的path
        $spath = $pcategory->path.'-'.$pid;//本身要更改成的path
        $pspath = $pcategory->path.'-'.$pid.'-'.$id;//本身要更改成的path
        $sspath = $spath.'-'.$id;//本身子分类要替换的前缀path
        //更新
        Log::info($_POST);
        //更新所有自己类目下的分类path
        //判断自己类目下有没有分类
        if($category->haveCategory($id)){
            $return = DB::update('update db_goods_category set path = replace(path,?,?) where path like ?', [$path,$pspath,$path.'%']);
        }else{
            $return = true;
        }

        //更新自己的path
         $category->path=$spath;
         $category->name=$request->input('name');
         $category->image=$request->input('image');
         $category->image2=$request->input('image2');
        if ($category->save() && $return){
            r(1,'更新成功','/admin/goods/category/index');
        }else{
            r(0,'更新失败','admin/goods/category/index');
        }
    }
    //删除分类
    public function postDelete(Request $request)
    {
        //分类下还有分类则不能删除
        if(!Goodscategory::haveCategory($request->input('id')) && !Goodscategory::haveGoods($request->input('id'))){
            if(Goodscategory::find($request->input('id'))->delete()){
                r(1,'删除成功','/admin/goods/category/index');
            }else{
                r(0,'删除失败','admin/goods/category/index');
            }
        }else{
            r(2,'分类下有商品或还有了分类','admin/goods/category/index');
        }

    }









}