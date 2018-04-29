<?php

namespace App\Tool\SMS;


use App\Models\User;

class Sendsms
{
    public static function sendCode($mobile,$codenum)//发送验证码
    {
        $content=urlencode("您的验证码是：{$codenum}。请不要把验证码泄露给其他人。");
        $url="http://106.ihuyi.com/webservice/sms.php?method=Submit&account=C07039328&password=afe64938818df4a367739b2e23c7c9ed&mobile={$mobile}&content={$content}";
        //$url="http://utf8.api.smschinese.cn/?Uid=rexmall&Key=2094c892418cb5511136&smsMob={$mobile}&smsText={$content}";
        return file_get_contents($url);
    }

    public static function sendMoneyTips($mobile,$money)//发送提现放款提示短信
    {
        $content=urlencode("您的提现申请金额{$money}元已发放，请注意查收您的绑定银行卡！");
        $url="http://106.ihuyi.com/webservice/sms.php?method=Submit&account=C07039328&password=afe64938818df4a367739b2e23c7c9ed&mobile={$mobile}&content={$content}";
        //$url="http://utf8.api.smschinese.cn/?Uid=rexmall&Key=2094c892418cb5511136&smsMob={$mobile}&smsText={$content}";
        return file_get_contents($url);
    }

}

