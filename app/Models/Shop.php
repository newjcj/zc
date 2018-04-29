<?php

namespace App\Models;

use App\Entity\M3result;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Shop extends Model
{
    protected $table = 'shop';
    protected $primaryKey = 'id';

    public function goods(){
        return $this->hasMany('App\Models\Shop');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

}
