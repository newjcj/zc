<?php
namespace App\Http\Controllers\Admin\User;
use App\Models\Bank;
use App\Models\Role;
use App\Models\Shop;
use App\Tool\Common;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity\M3result;
use App\Models\User;
use App\Models\Userbank;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Log;

class UserController extends Controller{

    public function getIndex(Request $request)
    {
        $user = User::where('id','>=',1)->where('admin','!=',1)->get();
        return view('admin.user.user.index', ['users' => $user]);
    }
    //设置二代奖
    public function postFfuserprice(Request $request)
    {
        if( User::where('id',$request->input('id'))->update(['ff_user_price'=>$request->input('ff_user_price')*100]) ){
            r(1, 'ok');
        }else{
            r(0,'err');
        }
    }
//编辑页面
    public function getEdit(Request $request)
    {
        $userbank = Userbank::where("user_id",$request->input('id'));
        if ($user = User::find($request->input('id', ''))) {
//            return $goods->category_id;
            return view('admin.user.user.edit', [
                'user' => $user,
                'userbank' => $userbank
            ]);
        } else {
            return redirect('/admin/user/user/index');
        }

    }

    //执更新加商品
    public function postUpdate(Request $request){
//       Log::info($_POST);
        $user = User::find($request->input('id'));
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->cardid = $request->input('cardid');
        if($user->save()){
            r(1,'更新成功','/admin/user/user/index');
        }else{
            r(0,'更新失败','/admin/user/user/index');
        }
    }

    //删除商品
    public function postDelete(Request $request)
    {
        $user = User::find($request->input('id'));
        if( $user->delete()){
            r(1,'删除成功','/admin/user/user/index');
        }else{
            r(0,'删除失败','');
        }
    }

    //审核会员提现
    public function getCash(Request $request)
    {
        //查找所有的申请提现的
        $banks = Bank::where('status',8)->get();
        return view('admin.user.user.cash', ['banks' => $banks]);
    }

    public function postCash(Request $request)
    {
        $bank = Bank::where('id',$request->input('id'));
        //审核
        if($bank->update(['rate'=>$request->input('regionid')])){
            if($request->input('regionid') == 0){
                //审核通过将提现金额的17%转为积分
                $bank->first()->user->increment('shop_coin',$bank->first()->money*17);
            }
            r(1,'操作成功','/admin/user/user/cash');
        }else{
            r(0,'操作失败','');
        }
    }

    //查看通过的会员
    public function getIndex2(Request $request)
    {
        $user = User::where('is_true',2)->get();
        return view('admin.user.user.index2', ['user' => $user]);
    }

    //会员实名认证列表
    public function getVerify(Request $request)
    {
        //取所有要实名认证的用户
        $users = User::all();
        return view('admin.user.user.verify',[
            'users'=>$users,
        ]);
    }

    /**
     * @param Request $request  userid  is_true
     *
     */
    public function postVerify(Request $request)
    {
        if( $u = User::where('id',$request->input('userid'))->update(['is_true'=>$request->input('is_true')]) ){
            r(1, '更新成功');
        }else{
            r(0, '更新失败');
        }
    }
    public function postIdentify(Request $request)
    {
        if( $u = User::where('id',$request->input('id'))->update(['status'=>$request->input('status')]) ){
            r(1, '更新成功');
        }else{
            r(0, '更新失败');
        }
    }
    //删了用户
    public function postDelete1(Request $request)
    {
        $u = User::where('id',$request->input('id'))->first();
        if( $u->delete() ){
            r(1, '删除成功');
        }else{
            r(0, '删除失败');
        }
    }

    //会员开店认证列表
    public function getVerifyshop(Request $request)
    {
        $shops = Shop::all();
        return view('admin.user.user.verifyshop',[
            'shops'=>$shops,
        ]);
    }

    /**
     * @param Request $request userid certify
     */
    public function postVerifyshop(Request $request)
    {
        if( $shop = Shop::where('id',$request->input('shopid'))->update(['certify'=>$request->input('certify')]) ){
            r(1, '更新成功');
        }else{
            r(0, '更新失败');
        }
    }

    /**
     * @param Request $request
     */
    public function getRole(Request $request)
    {
        $roles = Role::all();
        return view('admin.user.user.role',[
            'roles'=>$roles,
            'users'=>User::all(),
        ]);
    }
    /**
     * 添加角色
     * @param Request $request   userid roleid
     */
    public function postAddrole(Request $request)
    {
        $user = User::find($request->input('userid'));
        //判断这个用户有没有这个角色
        if( in_array($request->input('roleid'),$user->roles->pluck('id')->toArray()) ){
            r(0, '已经有这个角色了');
        }
        $user->attachRole(Role::find($request->input('roleid')));
        r(1, '添加角色成功');
    }
    /**
     * 删除角色
     * @param Request $request   userid roleid
     */
    public function postDelrole(Request $request)
    {
        $user = User::find($request->input('userid'));
        $user->detachRole($request->input('roleid'));
        r(1, '删除角色成功');
    }






}