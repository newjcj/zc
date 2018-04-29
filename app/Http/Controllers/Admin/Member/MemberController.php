<?php
namespace App\Http\Controllers\Admin\Member;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//显示页面
class MemberController extends Controller
{
    public function getIndex(Request $request)
    {
        $member = Member::all();
        return view('admin.member.member.index', ['member' => $member]);
    }

//编辑页面
    public function getEdit(Request $request)
    {
        if ($member = Member::find($request->input('id', ''))) {
//            return $goods->category_id;
            return view('admin.member.member.edit', [
                'member' => $member
            ]);
        } else {
            return redirect('/admin/member/member/index');
        }

    }

    //执更新加商品
    public function postUpdate(Request $request){
//       Log::info($_POST);
        $member = Member::find($request->input('id'));
        $member->name = $request->input('name');
        $member->phone = $request->input('phone');
        $member->email = $request->input('email');
        $member->password = $request->input('password');
        if($member->save()){
            r(1,'更新成功','/admin/member/member/index');
        }else{
            r(0,'更新失败','/admin/member/member/index');
        }
    }

    //删除商品
    public function postDelete(Request $request)
    {
        $member = Member::find($request->input('id'));
        if( $member->delete()){
            r(1,'删除成功','/admin/member/member/index');
        }else{
            r(0,'删除失败','');
        }
    }





}