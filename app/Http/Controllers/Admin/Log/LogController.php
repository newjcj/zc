<?php
namespace App\Http\Controllers\Admin\Log;
use App\Models\Goods;
use App\Models\Goodscategory;
use App\Models\Goodsimage;
use App\Models\Logs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity\M3result;
use App\Models\User;
use App\Models\Shop;
use Illuminate\Support\Facades\Session;
use Log;

class LogController extends Controller{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getLog(Request $request)
    {
        $logs = Logs::all();
        return view('admin.log.log',[
            'logs'=>$logs,
        ]);
    }








}