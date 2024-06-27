<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BalanceResource;
use App\Models\Balance;
use App\Models\BalanceDetail;
use App\Models\QR;
use App\Models\QrAddedBalance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BalanceController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $balances = Balance::where('user_id', $user->id)
            ->with([
                'balanceDetails' => function ($query) {
                    $query->orderBy('created_at', 'desc')->paginate(10);
                }
            ])
            ->get();

        // return response()->api($balances);
        return response()->api(BalanceResource::collection($balances));
    }



    public function addBalanceByQrCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $user = Auth::user();
        $qrCode = QR::where('code', $request->code)->first();

        if (!$qrCode) {
            return response()->json(['error' => 'Invalid QR code'], 400);
        }

        $existingQR = QRAddedBalance::where('qr_id', $qrCode->id)->first();
        if ($existingQR) {
            return response()->json(['error' => 'Duplicate QR code'], 400);
        }

        $balance = $this->getOrCreateUserBalance($user);

        $balanceDetail = new BalanceDetail();
        $balanceDetail->amount = $qrCode->qRvalue->value;
        $balanceDetail->balance_id = $balance->id;
        $balanceDetail->save();

        $balance->total += $balanceDetail->amount;
        $balance->save();

        $qrAddedBalance = new QRAddedBalance();
        $qrAddedBalance->balance_detail_id = $balanceDetail->id;
        $qrAddedBalance->qr_id = $qrCode->id;
        $qrAddedBalance->save();

        return response()->json(['message' => 'Balance added successfully'], 200);
    }

    public function show($id)
    {
        $user = Auth::user();
        $balance = Balance::where('user_id', $user->id)->with('balanceDetails')->findOrFail($id);
        return response()->json(['balance' => $balance], 200);
    }


    protected function getOrCreateUserBalance($user)
    {
        if ($user->balances->isEmpty()) {
            $balance = new Balance();
            $balance->total = 0;
            $balance->user_id = $user->id;
            $balance->save();
        } else {
            $balance = $user->balances->first();
        }

        return $balance;
    }
}
