<?php

namespace App\Models;

use App\Entity\M3result;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Logs extends Model
{
    protected $table = 'logs';
    protected $primaryKey = 'id';
    /***
     * 写入一条日志 v1.0
     * monkey 2017-12-22
     * 向数据表中新增一条日志数据
     * 参数说明：
     * $ztype  varchar(233) 日志类型，可中文
     * $uid     int(11) 日志针对的用户ID
     * $zinfo   varchar(233) 中文，该日志的说明，详情
     * $change_money   int(11) 改变用户的余额。默认0，不改变用户余额
     * $change_frozen_money   改变用户的冻结金额。默认-1，不改变用户冻结金额
     *
     * 比如当用户申请提现36元，可使用以下语句(可用金额减少36，冻结金额增加36)：
     * writeOne("申请提现",1,"用户申请提现",-3600,3600);
     *
     * */
    public static function writeOne($ztype,$uid,$zinfo,$change_money=0,$change_frozen_money=0){
        $log=new Logs;
        $log->ztype=$ztype;
        $log->uid=$uid;
        $log->zinfo=$zinfo;
        $log->change_money=$change_money;
        $log->change_frozen_money=$change_frozen_money;
        $log->ztime=time();
        $log->save();
        return $log->id;
    }
}
