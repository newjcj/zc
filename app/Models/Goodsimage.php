<?php

namespace App\Models;

use App\Entity\M3result;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Goodsimage extends Model
{
    protected $table = 'goods_image';
    protected $primaryKey = 'id';
    public function goods()
    {
        return $this->belongsTo('App\Model\Goods');
    }
   
}
