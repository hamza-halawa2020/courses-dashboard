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
        for ($i = 0; $i < $request->number; $i++) {
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $pin = mt_rand(1000000, 9999999) . mt_rand(1000000, 9999999) . $characters[rand(0, strlen($characters) - 1)];
            $string = str_shuffle($pin);

            $dns2d = new \Milon\Barcode\DNS2D();

            $qrImage = $dns2d->getBarcodePNG($string, 'QRCODE', 8, 8);

            $folderPath = 'qr/';
            $fileName = $string . '.png';
            $filePath = public_path($folderPath . $fileName);
            file_put_contents($filePath, base64_decode($qrImage));

            QR::create([
                'code' => $string,
                'image' => $folderPath . $fileName,
                'q_rvalue_id' => $request->qRvalue_id
            ]);
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
    public function destroy($id)
    {
        $qr = QR::findOrFail($id);
        $qr->delete();
        session()->flash('success', __('site.deleted_successfully'));
    }

}
