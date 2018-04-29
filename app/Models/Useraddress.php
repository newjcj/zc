<?php

namespace App\Models;

use App\Entity\M3result;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Useraddress extends Model
{
    protected $table = 'useraddress';
    protected $primaryKey = 'id';


    public function order()
    {
        return $this->hasOne('App\Models\Order');
    }



}
