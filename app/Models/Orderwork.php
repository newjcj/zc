<?php

namespace App\Models;

use App\Entity\M3result;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Orderwork extends Model
{
    protected $table = 'orderwork';
    protected $primaryKey = 'id';
    public function orderworkdetails(){
        return $this->hasMany('App\Models\Orderworkdetail');
    }



}
