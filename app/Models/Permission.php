<?php

namespace App\Models;

use App\Entity\M3result;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Zizaco\Entrust\Traits\EntrustPermissionTrait;

class Permission extends Model
{
    use EntrustPermissionTrait;
    protected $table = 'permission';
    protected $primaryKey = 'id';




    


}
