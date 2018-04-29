<?php
namespace App\Http\Controllers\Admin\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity\M3result;
use App\Models\User;
use App\Models\Userbank;
use Illuminate\Support\Facades\Session;
use Log;

class MemberController extends Controller{

    public function getIndex(){
        return view('admin.member.index');
    }






}