<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Operation;
use App\User;
use Illuminate\Http\Request;
use FreeKassa;
use Redirect;
use Auth;

class PaymentController extends Controller
{
    public function pay_in(Request $request)
    {
        $operation = new Operation;
        $operation->amount = (int)$request->amount;
        $operation->user = Auth::user()->id;
        $operation->type = 1;
        $operation->status = 0;

        $operation->save();

        $url = FreeKassa::getPayUrl($request->amount, $operation->id);
        return response()->json(["method" => "get", "url" => $url ]);
    }

    public function result(Request $request)
    {
        $sign = md5(env(FREEKASSA_PROJECT_ID).':'.$request->amount.':'.enc(FREEKASSA_SECRET_KEY_SECOND).':'.$request->MERCHANT_ORDER_ID);

        if ($sign == $request->sign) {
            $order = Operation::where("id", $request->MERCHANT_ORDER_ID)->where('status', 0)->where('amount', $request->amount)->first();


            if ($order) {
                $order->status = 1;

                $user = User::where("id", $order->user)->first();
                $user->money += $order->amount;
                $user->save();
                $order->save();

                return true;
            }
        }
        return false;
    }


}
