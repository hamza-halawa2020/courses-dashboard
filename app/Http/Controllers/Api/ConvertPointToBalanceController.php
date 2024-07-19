<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Balance;
use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ConvertPointToBalance;
use App\Models\BalanceDetail;
use App\Models\PointDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ConvertPointToBalanceController extends Controller
{

    public function index()
    {
        //
    }

    public function convert(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:10000',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);

        }

        $point = Point::where('user_id', $user->id)->first();

        if ($point->total < $request->amount) {
            return response()->json(['error' => 1, 'message' => 'Not enough points'], 200);
        }

        // Define conversion rate
        $conversionRate = 200;
        $balanceAmount = $request->amount / $conversionRate;

        // Create PointDetail and deduct points
        $pointDetail = new PointDetail();
        $pointDetail->amount = -$request->amount;
        $pointDetail->point_id = $point->id;
        $pointDetail->save();

        // Update Point total
        $point->total += $pointDetail->amount;
        $point->save();

        // Create BalanceDetail and add balance
        $balance = Balance::where('user_id', $user->id)->first();

        $balanceDetail = new BalanceDetail();
        $balanceDetail->amount = $balanceAmount;
        $balanceDetail->balance_id = $balance->id;
        $balanceDetail->save();

        // Update Balance total
        $balance->total += $balanceDetail->amount;
        $balance->save();

        // Create conversion record
        ConvertPointToBalance::create([
            'balance_detail_id' => $balanceDetail->id,
            'point_detail_id' => $pointDetail->id,
            'amount' => $request->amount,
        ]);

        return response()->json(['success' => 'Points converted to balance successfully'], 200);
    }


    public function store(Request $request)
    {

    }


    public function show($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
