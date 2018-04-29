<?php

namespace App\Models;

use App\Entity\M3result;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Zizaco\Entrust\Traits\EntrustRoleTrait;

class Role extends Model
{
    use EntrustRoleTrait;
    protected $table = 'role';
    protected $primaryKey = 'id';

    public function users(){
        return $this->belongsToMany('App\Models\User');
    }







}
