<?php

namespace App\Http\Controllers;
use App\Entity\Curl;
use App\Entity\Kdn;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Express;
use App\Models\Goods;
use App\Models\Goodscategory;
use App\Models\Goodsimage;
use App\Models\Pay;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Shop;
use App\Tool\UUID;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity\M3result;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Log;

class ApiController extends Controller
{
    ////发关邮件接口  调用示例http://luck.voipgarden.cn/api/mail?subject=jcj&content=kjsd%E8%9D%87jsdk&to=18666015093@163.com
    ////发关邮件接口  调用示例http://invetofintech.com/api/mail?subject=jcj&content=kjsd%E8%9D%87jsdk&to=18666015093@163.com
    public function postMail(Request $request)
    {
        Curl::vget( 'http://luck.voipgarden.cn/api/mail?subject='.$request->input('subject').'&content='.$request->input('content').'&to='.$request->input('to') );
    }
    public function getMail(Request $request)
    {
        Curl::vget( 'http://luck.voipgarden.cn/api/mail?subject='.$request->input('subject').'&content='.$request->input('content').'&to='.$request->input('to') );
    }


}