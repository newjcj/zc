<?php

namespace App\Models;

use App\Entity\Kdn;
use App\Entity\M3result;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Express extends Model
{
    protected $table = 'express';
    protected $primaryKey = 'id';

    public static function getInterflow($intername,$interid)
    {
        if (!$intername || !$interid){
            return false;
        }
        $kdn = new Kdn;
        return $kdn->getOrderTracesByJson($intername,$interid);
    }


}
