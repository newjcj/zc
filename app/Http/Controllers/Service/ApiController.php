<?php namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Tool\UUID;
use App\Entity\M3result;
use Log;
use Intervention\Image\ImageManagerStatic as Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ApiController extends Controller
{
    public function img(Request $request)
    {
        User::img();
    }


}