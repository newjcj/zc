<?php
namespace App\Http\Controllers\Wap;
use App\Models\Cart;
use App\Models\Goods;
use App\Models\Goodscategory;
use App\Models\Order;
use App\Models\Ordergoods;
use App\Models\User;
use App\Models\Useraddress;
use App\Tool\Discuz;
use App\Tool\SMS\Sendsms;
use App\Tool\UUID;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity\M3result;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Log;

class WloginController extends Controller{

    //获取openid
    public function getOpenid(Request $request)
    {
        $spreaduserid=$request->input('spreaduserid','');

        $doman = "http://".$_SERVER['SERVER_NAME'];//没有/
        $appid = config('wechat.app_id');
        $uri = $doman."/wap/wlogin/openiddo";
        $uri = urlencode($uri);
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}&redirect_uri={$uri}&response_type=code&scope=snsapi_base&state=123#wechat_redirect";
        return redirect($url);
    }

    public function getOpeniddo(Request $request)
    {
        //获取openid
        $code=$request->input('code','');
        $doman = "http://".$_SERVER['SERVER_NAME'];//没有/
        $appid = config('wechat.app_id');
        if($code != ''){
            $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".config('wechat.app_id')."&secret=".config('wechat.secret')."&code={$code}&grant_type=authorization_code";
            $re = $this->vget($url);
            $re = json_decode($re,1);
            $openid = $re['openid'];
        }
        $user = User::where('openid',$openid)->first();//看用户存不存在
        if($user){
            //判断access_token有没有过期
            $time = (time() - strtotime($user->access_token_get_time)) / (60*60*24);
//            print_r($time);die;头像头像
            if($time < 10){
                User::setUser($user);
//                $request->session()->set('user',$user);//保存sesssion
                return redirect('/wap/user/center');
            }else{
                //更新access_token
                $uri = $doman."/wap/wlogin/login";
                $uri = urlencode($uri);
                $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}&redirect_uri={$uri}&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
                return redirect($url);
            }
        }else{
            Log::info(1111111);
            //没有这个用户 添加用户
            $uri = $doman."/wap/wlogin/reg";
            $uri = urlencode($uri);
            $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}&redirect_uri={$uri}&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
            return redirect($url);
        }
    }
    public function getLogin(Request $request){
        $code=$request->input('code','');
        $state=$_GET['state'];
        if($code != ''){
            //第一次获取蔘access_token
            $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".config('wechat.app_id')."&secret=".config('wechat.secret')."&code={$code}&grant_type=authorization_code";
            $re = $this->vget($url);
            $re = json_decode($re,1);
            //第二次获取access_token
            $url = "https://api.weixin.qq.com/sns/oauth2/refresh_token?appid=".config('wechat.app_id')."&grant_type=refresh_token&refresh_token={$re['refresh_token']}";
            $re = json_decode($this->vget($url),true);
            //用户access_token 获取用户信息
            $access_token = $re['access_token'];
            $openid = $re['openid'];
            $url = "https://api.weixin.qq.com/sns/userinfo?access_token={$access_token}&openid={$openid}&lang=zh_CN ";
            $user = json_decode($this->vget($url),true);
        }
        $user1 = User::where('openid',$user['openid'])->first();
        if($user1){
            $user1->access_token_get_time=date("Y-m-d H:i:s",time());
            $user1->access_token=$access_token;

            //用户access_token 获取用户信息
            $access_token = $re['access_token'];
            $openid = $re['openid'];
            $url = "https://api.weixin.qq.com/sns/userinfo?access_token={$access_token}&openid={$openid}&lang=zh_CN ";
            $user2 = json_decode($this->vget($url),true);

            $user1->headimgurl=$user2['headimgurl'];//更新用户头像$user['headimgurl']
            if($user1->save()){
                User::setUser($user1);
//                $request->session()->set('user',$user1);
                return redirect('/wap/user/center');
            }
        }
    }
//注册
    public function getReg(Request $request)
    {
        $code=$request->input('code','');
        $state=$_GET['state'];
        if($code != ''){
            //第一次获取蔘access_token
            $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".config('wechat.app_id')."&secret=".config('wechat.secret')."&code={$code}&grant_type=authorization_code";
            $re = $this->vget($url);
            $re = json_decode($re,1);
            //第二次获取access_token
            $refresh_token = $re['refresh_token'];
            $url = "https://api.weixin.qq.com/sns/oauth2/refresh_token?appid=".config('wechat.app_id')."&grant_type=refresh_token&refresh_token={$refresh_token}";
            $re = json_decode($this->vget($url),true);
            //用户access_token 获取用户信息
            $access_token = $re['access_token'];
            $openid = $re['openid'];
            $url = "https://api.weixin.qq.com/sns/userinfo?access_token={$access_token}&openid={$openid}&lang=zh_CN ";
            $user = json_decode($this->vget($url),true);
        }
        $user1 = new User;
        $user1->openid=$user['openid'];
        $user1->access_token=$access_token;
        $user1->nickname=$user['nickname'];
        $user1->sex=$user['sex'];
        $user1->province=$user['province'];
        $user1->city=$user['city'];
        $user1->country=$user['country'];
        $user1->headimgurl=$user['headimgurl'];
        $user1->access_token_get_time=date('Y-m-d H:i:s',time());
//        $user1->privilege=json_encode($user['privilege'],1);
        //加入我扫码的人的id
        if($spreaduserid = Session::get('spreaduserid')){
            $user1->spreaduserid=$spreaduserid;
        }
        if($user1->save()){
            User::setUser($user1);
//            $request->session()->set('user',$user1);
            return redirect('/wap/user/center');
        }
    }
    /**
     * @param $url
     * @param bool $cookies
     * @param string $cookie_file
     * @return mixed
     */
    private function vget($url,$cookies=false,$cookie_file=''){
        $curl = curl_init(); // 启动一个CURL会话
        $headers[] = 'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
        $headers[] = 'Connection: Keep-Alive';
        $user_agent = 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.0.3705; .NET CLR 1.1.4322; Media Center PC 4.0)';
        if($cookies){
            if (file_exists($cookie_file)) {
                $cookie_file=$cookie_file;
            } else {
                if($h = fopen($cookie_file,'w')){
                    $cookie_file=$cookie_file;
                    fclose($h);
                } else {
                    echo 'The cookie file could not be opened. Make sure this directory has the correct permissions';die;
                }
            }
        }
        //$this->headers[] = 'Content-type: application/x-www-form-urlencoded;charset=GBK';
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); // 从证书中检查SSL加密算法是否存在
        curl_setopt($curl, CURLOPT_USERAGENT, $user_agent); // 模拟用户使用的浏览器
        //curl_setopt($curl, CURLOPT_NOBODY, 0);
        //if ($this->cookies == TRUE) curl_setopt($curl, CURLOPT_COOKIEFILE, $this->cookie_file);
        if ($cookies == TRUE) curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie_file);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
        curl_setopt($curl, CURLOPT_MAXREDIRS,6); //跟随 重定向 跳转的次数
        //curl_setopt($curl, CURLOPT_POST, 0); // 发送一个常规的Post请求
        //curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包
        curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
        curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
        $tmpInfo = curl_exec($curl); // 执行操作
        if (curl_errno($curl)) {
            echo 'Errno'.curl_error($curl);//捕抓异常
        }
        curl_close($curl); // 关闭CURL会话
        return $tmpInfo; // 返回数据
    }













}