<?php

namespace App\Models;

use App\Entity\M3result;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Orderworkdetail extends Model
{
    protected $table = 'orderworkdetail';
    protected $primaryKey = 'id';

    public function orderwork()
    {
        return $this->belongsTo('App\Models\Orderwork');
    }
    public function orderworkdetailfiles(){
        return $this->hasMany('App\Models\Orderworkdetailfile');
    }



}
