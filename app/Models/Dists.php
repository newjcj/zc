<?php

namespace App\Models;

use App\Entity\M3result;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Dists extends Model
{
    protected $table = 'dists';
    protected $primaryKey = 'id';

    //通过名字取img
    public static function img($imgname)
    {
        return Dists::where('iconname',$imgname)->first()->img;
    }



}
