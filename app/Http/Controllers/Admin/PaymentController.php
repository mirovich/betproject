<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use DB;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $managers = User::whereIn('role', [10, 11])->get();
        $a = DB::table('operations')
            ->where('type', 0)
            ->where('is_fake', '<>', 1)
            ->orderBy('id', 'desc')
            ->where('status', 1)
            ->get();
        $c = [];
        $itogo = 0;
        foreach ($a as $b) {
            if ($u = User::find($b->user)) {
                $b->name = $u->username;
                $b->name_id = $u->id;
                $b->manager = $u->manager_id && $u->manager && !in_array($u->role, [10, 11]) ? $u->manager->name : '';
                $b->amount = round($b->amount * .94, 2);
                $c[] = $b;
                $itogo += $b->amount;
            }
        }
        $zarabotano = $itogo * 20 / 100;
        $a = $c;
        return view('admin.payments.payments', compact('a', 'itogo', 'zarabotano', 'managers'));
    }
}
