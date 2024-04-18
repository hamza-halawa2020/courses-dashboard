<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use BaconQrCode\Encoder\QrCode;
use Illuminate\Http\Request;

class QRController extends Controller
{
    public function  index()
    {
        QrCode::generate();
    }
}
