<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\QRRequest;
use App\Models\QR;
use App\Models\QRvalue;
use BaconQrCode\Encoder\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Milon\Barcode\DNS2D;

class QRController extends Controller
{
    public function index()
    {
        $qRvalues = QRvalue::all();
        return view('admin.qRs.index', compact('qRvalues'));
    }


    public function create()
    {
        $qRvalues = QRvalue::all();
        return view('admin.qRs.create', compact('qRvalues'));
    }


    public function store(QRRequest $request)
    {

        //return $request;

        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $number = $request->number;

        for ($j = 0; $j < $number; $j++) {
            $pin = mt_rand(1000000, 9999999)
                . mt_rand(1000000, 9999999)
                . $characters[rand(0, strlen($characters) - 1)];
            $string = str_shuffle($pin);

            /*Storage::disk('public')->put(
                'QR/' . $string . '.png', base64_decode(
                DNS2D::getBarcodePNG('QR/' . $string . '.png', 'QRCODE', 8, 8,array(0,0,200))));*/


            $qRs = QR::create([
                'code' => $string,
                'image' => $string . '.png',
                'q_rvalue_id' => $request->qRvalue_id
            ]);
            /*            Storage::disk('public')->put('QR/'.$string.'.png',base64_decode(DNS2D::getBarcodePNG('QR/'.$string.'.png','QRCODE',8,8)));*/


            Storage::disk('public')->put(
                'QR/' . $string . '.png', // path
                base64_decode((new DNS2D())->getBarcodePNG('QR/' . $string . '.png', 'QRCODE', 8, 8, array(200, 200, 0))));


            //DNS2D::getBarcodePNG('QR/' . 1 . '.png', 'QRCODE', 8, 8)
            //base64_decode((new DNS2D())->getBarcodePNG("$post->qr_code", DATAMATRIX'));


        }

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.QR.index');
    }


    public function show($id)
    {

        //return $id;
        $qRs = QR::WhenQrvalueId($id)->get();
        //$qRs=QR::all();
        //return  $qRs;
        return view('admin.qRs.show', compact('qRs'));
    }
}
