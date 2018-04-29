<?php
namespace App\Http\Controllers\Admin\Goods;
use App\Models\A;
use App\Models\B;
use App\Models\Goods;
use App\Models\Goodscategory;
use App\Models\Goodsimage;
use App\Models\Orderwork;
use App\Models\Usergoods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity\M3result;
use App\Models\User;
use App\Models\Shop;
use Illuminate\Support\Facades\Session;
use Log;
use Cache;

class GoodsController extends Controller{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex(Request $request)
    {
        $count = Goods::whereNotNull('id')->count();
        $num=10;
        //需要做判断是否是管理员或者普通供应商
//        if(User::getUser()->can('admin')){
            $goodss = Goods::whereNotNull('id');
            if($request->input('shopid','')){
                $goodss=$goodss->where('shop_id',$request->input('shopid'));
            }
            $goodss=$goodss->paginate(10);
//        }elseif(User::getUser()->can('shop')){
//            $goodss = Goods::where('shop_id',User::getUser()->shop->id)->paginate(10);
//        }else{
//            return "没有权限";
//        }
        $shop = Shop::all();
        return view('admin.goods.goods.index',[
            'goodss'=>$goodss,
            'shop'=>$shop,
            'shopid'=>$request->input('shopid',''),
            'count'=>$count
        ]);
    }
    public function getDetail(Request $request)
    {
        $users = Goods::find($request->input('id'))->users;
        return view('admin.goods.goods.detail',[
            'goodsid'=>$request->input('id'),
            'users'=>$users
        ]);
    }
    public function postSavegainprice(Request $request)
    {
        if( Goods::where('id',$request->input('id'))->update(['gain_price'=>$request->input('gain_price')*100]) ){
            r(1, 'ok');
        }
    }
    public function postSavebaseprice(Request $request)
    {
        if( Goods::where('id',$request->input('id'))->update([
            'gain_price'=>$request->input('gain_price')*100,
            'base_price'=>$request->input('base_price')*100,
        ]) ){
            r(1, 'ok');
        }
    }

    //添加商品
    public function getAdd(Request $request){
        $shop = Shop::all();
//        if(User::getUser()->can('admin')){
            return view('admin.goods.goods.add',[
                'shop'=>$shop,
                'category'=>new Goodscategory()
            ]);
//        }elseif(User::getUser()->can('shop')){
//            return view('admin.goods.goods.add',[
//                'shop'=>User::getUser()->shop,
//                'category'=>new Goodscategory()
//            ]);
//        }else{
//            return '没有权限';
//        }

    }
    //编辑商品
    public function getEdit(Request $request){
        $goods = Goods::find($request->input('id',''));
        $shop = Shop::all();
//        if(User::getUser()->can('admin')){
            return view('admin.goods.goods.edit',[
                'goods'=>$goods,
                'shop'=>$shop,
                'category'=>new Goodscategory(),
            ]);
//        }elseif(User::getUser()->can('shop')){
//            return view('admin.goods.goods.edit',[
//                'goods'=>$goods,
//                'shop'=>User::getUser()->shop,
//                'category'=>new Goodscategory(),
//            ]);
//        }else{
//            return '没有权限';
//        }

    }
    //执行添加商品
    public function postAdd(Request $request){
        $goods = new Goods;
        $goods->price = $request->input('price')*100;
        $goods->project_time = $request->input('project_time');
        $goods->gain_price = $request->input('gain_price')*100;
        $goods->name = $request->input('name');
        $goods->category_id = $request->input('categoryid');
        $goods->content = $request->input('content');
        $goods->mcontent = $request->input('mcontent');
        $goods->hot = $request->input('hot');
        $goods->seller_note = $request->input('seller_note');
        $goods->is_hot = $request->input('is_hot');
        $goods->is_ground = $request->input('is_ground');
        $goods->shop_id = $request->input('shop_id');
        $goods->gift_lv = $request->input('gift_lv');//礼包等级
        if($goods->save()){
            //发送给所有会员邮件提醒发布了商品
            $users = User::all();
            foreach ($users as $user) {
                User::sendMail('有新项目发布！','有新项目发布，项目名：'.$request->name,$user->email);
            }
            
            $goodsimage = new Goodsimage();
            $goodsimage->goods_id = $goods->id;
            $goodsimage->image = (new Goods())->getImage([$request->input('preview1'),$request->input('preview2'),$request->input('preview3'),$request->input('preview4'),$request->input('preview5')]);
            if($goodsimage->save()){
                r(1,'添加成功','/admin/goods/goods/index');
            }else{
                r(0,'商品图片添加失败','');
            }
        }else{
            r(0,'添加失败','');
        }
    }
    //执行更新商品
    public function postUpdate(Request $request){
//       Log::info($_POST);
        $goods = Goods::find($request->input('id'));
        $goods->price = $request->input('price')*100;
        $goods->project_time = $request->input('project_time');
        $goods->gain_price = $request->input('gain_price')*100;
        $goods->category_id = $request->input('categoryid');
        $goods->name = $request->input('name');
        $goods->hot = $request->input('hot');
        $goods->seller_note = $request->input('seller_note');
        $goods->is_ground = $request->input('is_ground');
        $goods->is_hot = $request->input('is_hot');
        $goods->mcontent = $request->input('mcontent');
        $goods->shop_id = $request->input('shop_id');
        $goods->content = $request->input('content');
        $goods->gift_lv = $request->input('gift_lv');//礼包等级
        if($goods->save()){
            $goodsimage = Goodsimage::where('goods_id',$request->input('id'))->first()?:new Goodsimage;
            $goodsimage->goods_id = $goods->id;
            $goodsimage->image = (new Goods())->getImage([$request->input('preview1'),$request->input('preview2'),$request->input('preview3'),$request->input('preview4'),$request->input('preview5')]);
            if($goodsimage->save()){
                r(1,'更新成功','/admin/goods/goods/index');
            }else{
                r(0,'商品图片更新失败','');
            }
        }else{
            r(0,'更新失败','');
        }
    }
    //删除商品
    public function postDelete(Request $request)
    {
        $goods = Goods::find($request->input('id'));
        $goodsimage = Goodsimage::where('goods_id',$goods->id)->first();
        if( $goods->delete() && $goodsimage->delete()){
            r(1,'删除成功','/admin/goods/goods/index');
        }else{
            r(0,'删除失败','');
        }
    }

    public function getTest()
    {
        return 33;
    }
    //商品属性
    public function gitSpecif(Request $request){

    }
    //设置全体会员发放回报
    public function postAllpay(Request $request)
    {
        Usergoods::where('goods_id',$request->input('goodsid'))->update(['payback'=>1]);
        r(1,'更新成功');
    }
    //设置单个会员发放回报
    public function postPayback(Request $request)
    {
        Usergoods::where('goods_id',$request->input('goodsid'))->where('user_id',$request->input('userid'))->update(['payback'=>1]);
        r(1,'更新成功');
    }

    public function getRand(Request $request)
    {
//        phpinfo();exit;
        return view('admin.goods.goods.rand');
    }
    public function postRand()
    {
        $pdo = new \PDO('mysql:host=invetofintech.com;dbname=db_invetofintech;port=3300', 'test', 'admin888');
//        $result = $pdo->query('select * from db_a');
//        $row = $result->fetch(\PDO::FETCH_ASSOC);
//        $insertSql="insert into db_a(number,value) values('333','dddd')";
//        $updateSql="update db_a set number='222' where number = '333'";
//        $deleteSql="delete from db_a where number = '222'";
//        $insert = $pdo->exec($updateSql);


        //连接数据库




        $re = '';
        $N=5;
        $n=$N;
        $R1=rand(1,$n);
        $R2=rand(1,$n);
        $R3=rand(1,$n);
        $a=[$R1,$R2,$R3];
        $result = $pdo->query('select * from db_s');
        $row = $result->fetch(\PDO::FETCH_ASSOC);
        $s = $row['s'];//从数据库取出的计数的数
        if($s && ($s <$n) ){
            $ss=$s+1;
            //下面实现 更新数据库s 加1
            $updateSql="update db_s set s={$ss} where id = '1'";
            $insert = $pdo->exec($updateSql);
        }else{
            $s=1;
            //设置数据库s = 1;
            $updateSql="update db_s set s='1' where id = '1'";
            $insert = $pdo->exec($updateSql);
        }
        //查出表a的所有数据
        $result = $pdo->query('select * from db_a');
        $as=[];
        while($row = $result->fetch(\PDO::FETCH_ASSOC)){
            $as[]=$row;
        }
        //查出表b的所有数据
        $result = $pdo->query('select * from db_b');
        $bs=[];
        while($row = $result->fetch(\PDO::FETCH_ASSOC)){
            $bs[]=$row;
        }
        $counta = count($as);
        $countb = count($bs);
        //判断 a转b 还是b转a
        $is_ab='ab';//初始值为ab
        $result = $pdo->query('select * from db_s');
        $row = $result->fetch(\PDO::FETCH_ASSOC);
        $ab = $row['ab'];//从数据库取出的计数的数
        if(($ab == 'ab') && !$counta){
            //操作 数据库查询s表ab字段判断是不是ab,并且a表的数据为空时 更新ab字段为ba
            $updateSql="update db_s set ab='ba' where id = '1'";
            $insert = $pdo->exec($updateSql);
        }elseif(($ab == 'ba') && !$countb){
            //操作 数据库查询s表ab字段判断是不是ba,并且a表的数据为空时 更新ab字段为ab
            $updateSql="update db_s set ab='ab' where id = '1'";
            $insert = $pdo->exec($updateSql);
        }
        if(in_array($s,$a)){
            //如果命中
            $result = $pdo->query('select * from db_s');
            $row = $result->fetch(\PDO::FETCH_ASSOC);
            $ab = $row['ab'];//从数据库取出的计数的数
            if($ab =='ab'){
                //查询s表ab字段 ，如果 是ab，随机取a表数据集的一个
                //查出表b的所有数据
                $result = $pdo->query('select * from db_a');
                $aas=[];
                while($row = $result->fetch(\PDO::FETCH_ASSOC)){
                    $aas[]=$row;
                }
                $address = $aas[rand(0,$counta-1)];
                //把a 表的此第数据转到b表，a表删除这条数据
                $insertSql="insert into db_b(number,value) values('{$address['number']}','{$address['value']}')";
                $insert = $pdo->exec($insertSql);
                $deleteSql="delete from db_a where number = '{$address['number']}'";
                $insert = $pdo->exec($deleteSql);
            }else{
                // 是ba，随机取b表数据集的一个
                $result = $pdo->query('select * from db_b');
                $bbs=[];
                while($row = $result->fetch(\PDO::FETCH_ASSOC)){
                    $bbs[]=$row;
                }
                $address = $bbs[rand(0,$countb-1)];
                //把b 表的此第数据转到a表，b表删除这条数据
                $insertSql="insert into db_a(number,value) values('{$address['number']}','{$address['value']}')";
                $insert = $pdo->exec($insertSql);
                $deleteSql="delete from db_b where number = '{$address['number']}'";
                $insert = $pdo->exec($deleteSql);
            }
            //返回结果 可以不用
            return response([
                'code'=>1,
                'message'=>'success!',
                'data'=>$re,
            ]);
        }else{
            //返回结果 可以不用
            return response([
                'code'=>0,
                'message'=>'没有取到!',
                'data'=>'',
            ]);
        }

    }








}