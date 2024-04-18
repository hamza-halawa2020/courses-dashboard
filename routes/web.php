<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::group(['middleware' => ['guest']],function(){
    Route::get('/', function () {
        return view('auth.login');
    });
});

Auth::routes(['register' => false]);
Route::get('/test', function () {



    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

// generate a pin based on 2 * 7 digits + a random character

    $number =10;
    $pins = array();
    for ($j=0; $j < $number; $j++) {
        $pin = mt_rand(1000000, 9999999)
            . mt_rand(1000000, 9999999)
            . $characters[rand(0, strlen($characters) - 1)];
        $string = str_shuffle($pin);
        Storage::disk('public')->put('QR/'.$string.'.png',base64_decode(DNS2D::getBarcodePNG('QR/'.$string.'.png','QRCODE',8,8)));
    }

    /*$image = base64_decode(DNS2D::getBarcodePNG("4", "PDF417"));
    $image->store('public/uploads/QR');*/
   //Storage::disk('public')->put('QR/test.png',base64_decode(DNS2D::getBarcodePNG("4", "PDF417")));

    /* for ($i=10; $i--; $i>0) {
         //$number .= mt_rand(0,9);
         Storage::disk('public')->put('QR/'.$i.'.png',base64_decode(DNS2D::getBarcodePNG('QR/'.$i.'.png','QRCODE',8,8)));

         //return DNS2D::getBarcodeHTML($i, 'QRCODE');
     }*/
    /*return DNS1D::getBarcodeSVG('4445645656', 'C39');
    //return DNS2D::getBarcodeHTML('4445645656', 'QRCODE')
    return DNS2D::getBarcodeHTML('4445645656', 'QRCODE');
    return '<img src="data:image/png,' . DNS1D::getBarcodePNG('4', 'C39+') . '" alt="barcode"   />';
    return DNS1D::getBarcodeSVG('4445645656', 'PHARMA2T');*/
});

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
    return 'done';
});
