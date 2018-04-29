<?php

namespace App\Models;

use App\Entity\M3result;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Orderworkdetailfile extends Model
{
    protected $table = 'orderworkdetailfile';
    protected $primaryKey = 'id';

    public function orderworkdetail()
    {
        return $this->belongsTo('App\Models\Orderworkdetail');
    }



}
