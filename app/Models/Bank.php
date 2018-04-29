<?php

namespace App\Models;

use App\Entity\M3result;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Bank extends Model
{
    protected $table = 'bank';
    protected $primaryKey = 'id';

    public function user()
    {
       return $this->belongsTo('App\Models\User');
    }


}
