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

class TestController extends Controller{
    public function getIndex(Request $request)
    {
       return 1;
       $users = DB::table('user')->select("select * from user where id=? and name = ?",[])->get();
    }









}