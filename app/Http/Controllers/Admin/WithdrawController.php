<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    public function edit($id)
    {
        $user = DB::table('operations')->where('id', $id)->first();
        $user->user = User::where('id', $user->user)->first();
        return view('admin.includes.modal_withdrows', compact('user'));
    }

    public function save(Request $r)
    {
        if ($r->get('status') < 1) {
            DB::table('operations')->where('id', $r->id)->update([
                'status' => $r->get('status')
            ]);
        } elseif ($r->get('status') === 2) {
            $withdraw = DB::table('operations')->where('id', $r->id)->first();
            $user = User::where('id', $withdraw->user)->first();
            $user->money += $withdraw->amount;
            $user->save();
            DB::table('operations')->where('id', $r->id)->update(["status" => 2]);
        }
        $r->session()->flash('alert-success', 'Статус выплаты обновлен!');
        return redirect()->back();
    }

    public function index()
    {
        $managers = User::whereIn('role', [10, 11])->get();
        $withdrows = DB::table('operations')->where('type', 1)->get();
        $c = [];
        foreach ($withdrows as $w) {
            if ($user = DB::table('users')->where('id', $w->user)->first()) {
                $user->payed = DB::table('operations')->where('user', $user->id)->where('type', 0)->where('status', 1)->sum('amount');
                $user->with = DB::table('operations')->where('user', $user->id)->where('type', 1)->where('status', 1)->sum('amount');
                $user->with0 = DB::table('operations')->where('user', $user->id)->where('type', 1)->where('status', 0)->sum('amount');
                if ($user->payed == null) $user->payed = 0;
                if ($user->with == null) $user->with = 0;
                if ($user->with0 == null) $user->with0 = 0;

                $w->user = $user;
                $manager = User::find($w->user->manager_id);
                $w->manager = $manager && !in_array($w->user->role, [10, 11]) ? $manager->name : '';
                $date = $w->timestamp;
                Carbon::setlocale('ru');
                $w->dfh = Carbon::createFromFormat('Y-m-d H:i:s', $date)->diffForHumans();
                $c[] = $w;
            }
        }
        $withdrows = $c;
        return view('admin.pages.withdraw', compact('withdrows', 'managers'));
    }
}
