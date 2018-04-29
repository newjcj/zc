<?php
namespace App\Http\Controllers\Admin\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity\M3result;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Log;

class LoginController extends Controller{
    /**
     * @return int
     * http://www.myweishengjin.com/admin/login/test
     */

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 注册
     */
    public function getRegister(Request $request){

    }
    public function getIndex(Request $request){
        $return_url = $request->input('return_url','');
        $return_url = urldecode($return_url);
        return view('admin.user.login.index',[
            'return_url' => $return_url,
        ]);
    }

    /**
     * @param Request $request
     *
     */
    public function postLogin(Request $request){
        //验证用户名和密码
        if($user = User::checkUseradnpasswordadmin($request->input('password',''),$request->input('name',''),1)){
            //用户信息存入session
            Session::set('user',$user);
            $m3= new M3result();
            return $m3->build(1, "验证通过","/admin/goods/goods/index");
        }else{
             r(0,"用户名或密码不对");
        }
    }

    /**
     * @param Request $request
     * 退出
     */
    public function getLogout(){
        Session::flush();
        return redirect('/admin/user/login/index');
    }


}