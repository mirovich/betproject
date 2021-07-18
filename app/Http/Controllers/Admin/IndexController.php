<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;

class IndexController extends Controller
{
    public function index()
    // {
    //     $user_money = \DB::table('users')->where('money', '!=', 0)->sum('money');
    //     $user_today = \DB::table('users')->where('created_at', '>=', \Carbon\Carbon::today())->count();
    //     return view('admin.index');
    // }
    {
        $user_money = DB::table('users')->where('money', '!=', 0)->sum('money');
        $user_today = DB::table('users')->where('created_at', '>=', Carbon::today())->count();
        $opened_today = DB::table('games')->where('updated_at', '>=', Carbon::today())->count();
        $pay_today = DB::table('operations')->where('updated_at', '>=', Carbon::today())->where('status', 1)->where('type', 0)->sum('amount');
        $pay_week = DB::table('operations')->where('updated_at', '>=', Carbon::now()->subDays(7))->where('type', 0)->where('status', 1)->sum('amount');
        $pay_month = DB::table('operations')->where('updated_at', '>=', Carbon::now()->subDays(30))->where('status', 1)->where('type', 0)->sum('amount');
        $pay_all = DB::table('operations')->where('status', 1)->where('type', 0)->sum('amount');


        /*Подробная статистика*/
        $pay_yesterday = DB::table('operations')->where('updated_at', '>=', Carbon::now()->subDays(1)->format('Y-m-d 00:00:01'))->where('updated_at', '<=', Carbon::now()->subDays(1)->format('Y-m-d 23:59:59'))->where('type', 0)->where('status', 1)->sum('amount');
        $pay_3dn = DB::table('operations')->where('updated_at', '>=', Carbon::now()->subDays(2)->format('Y-m-d 00:00:01'))->where('updated_at', '<=', Carbon::now()->subDays(2)->format('Y-m-d 23:59:59'))->where('type', 0)->where('status', 1)->sum('amount');
        $pay_4dn = DB::table('operations')->where('updated_at', '>=', Carbon::now()->subDays(3)->format('Y-m-d 00:00:01'))->where('updated_at', '<=', Carbon::now()->subDays(3)->format('Y-m-d 23:59:59'))->where('type', 0)->where('status', 1)->sum('amount');
        $pay_5dn = DB::table('operations')->where('updated_at', '>=', Carbon::now()->subDays(4)->format('Y-m-d 00:00:01'))->where('updated_at', '<=', Carbon::now()->subDays(4)->format('Y-m-d 23:59:59'))->where('type', 0)->where('status', 1)->sum('amount');



        $pay_last_week = DB::table('operations')->where('updated_at', '<=', Carbon::now()->subWeeks(1))->where('updated_at', '>=', Carbon::now()->subWeeks(2))->where('type', 0)->where('status', 1)->sum('amount');
        $pay_week_ago = DB::table('operations')->where('updated_at', '<=', Carbon::now()->subWeeks(2))->where('updated_at', '>=', Carbon::now()->subWeeks(3))->where('type', 0)->where('status', 1)->sum('amount');
        $pay_week_ago1 = DB::table('operations')->where('updated_at', '<=', Carbon::now()->subWeeks(3))->where('updated_at', '>=', Carbon::now()->subWeeks(4))->where('type', 0)->where('status', 1)->sum('amount');
        $pay_week_ago2 = DB::table('operations')->where('updated_at', '<=', Carbon::now()->subWeeks(4))->where('updated_at', '>=', Carbon::now()->subWeeks(5))->where('type', 0)->where('status', 1)->sum('amount');




        $pay_last_month = DB::table('operations')->where('updated_at', '<=', Carbon::now()->subMonths(1))->where('updated_at', '>=', Carbon::now()->subMonths(2))->where('type', 0)->where('status', 1)->sum('amount');
        $pay_last_month1 = DB::table('operations')->where('updated_at', '<=', Carbon::now()->subMonths(2))->where('updated_at', '>=', Carbon::now()->subMonths(3))->where('type', 0)->where('status', 1)->sum('amount');
        $pay_last_month2 = DB::table('operations')->where('updated_at', '<=', Carbon::now()->subMonths(3))->where('updated_at', '>=', Carbon::now()->subMonths(4))->where('type', 0)->where('status', 1)->sum('amount');
        $pay_last_month3 = DB::table('operations')->where('updated_at', '<=', Carbon::now()->subMonths(4))->where('updated_at', '>=', Carbon::now()->subMonths(5))->where('type', 0)->where('status', 1)->sum('amount');

        /*Подробная статистика*/


        /*Статистика пользователей*/

        $reg_yesterday = DB::table('users')->where('created_at', '>=', Carbon::now()->subDays(1)->format('Y-m-d 00:00:01'))->where('created_at', '<=', Carbon::now()->subDays(1)->format('Y-m-d 23:59:59'))->count();
        $reg_3dn = DB::table('users')->where('created_at', '>=', Carbon::now()->subDays(2)->format('Y-m-d 00:00:01'))->where('created_at', '<=', Carbon::now()->subDays(2)->format('Y-m-d 23:59:59'))->count();
        $reg_4dn = DB::table('users')->where('created_at', '>=', Carbon::now()->subDays(3)->format('Y-m-d 00:00:01'))->where('created_at', '<=', Carbon::now()->subDays(3)->format('Y-m-d 23:59:59'))->count();
        $reg_5dn = DB::table('users')->where('created_at', '>=', Carbon::now()->subDays(4)->format('Y-m-d 00:00:01'))->where('created_at', '<=', Carbon::now()->subDays(4)->format('Y-m-d 23:59:59'))->count();



        $reg_this_week = DB::table('users')->where('created_at', '<=', Carbon::now()->subWeeks(0))->where('created_at', '>=', Carbon::now()->subWeeks(1))->count();
        $reg_last_week = DB::table('users')->where('created_at', '<=', Carbon::now()->subWeeks(1))->where('created_at', '>=', Carbon::now()->subWeeks(2))->count();
        $reg_week_ago = DB::table('users')->where('created_at', '<=', Carbon::now()->subWeeks(2))->where('created_at', '>=', Carbon::now()->subWeeks(3))->count();
        $reg_week_ago1 = DB::table('users')->where('created_at', '<=', Carbon::now()->subWeeks(3))->where('created_at', '>=', Carbon::now()->subWeeks(4))->count();
        /*Статистика пользователей*/


        //->where('created_at', '<', Carbon::now()->subDays(14))->where('type', 0)->where('status', 1)
        //dd(Carbon::now()->subDays(2)->format('Y-m-d 00:00:01'));
        //dd(Carbon::now()->subDays(2)->format('Y-m-d 23:59:59'));


        if (!$user_money) $user_money = 0;
        if (!$user_today) $user_today = 0;
        if (!$opened_today) $opened_today = 0;
        if (!$pay_today) $pay_today = 0;
        if (!$pay_week) $pay_week = 0;
        if (!$pay_month) $pay_month = 0;
        if (!$pay_all) $pay_all = 0;
        if (!$pay_yesterday) $pay_yesterday = 0;
        if (!$pay_3dn) $pay_3dn = 0;
        if (!$pay_4dn) $pay_4dn = 0;
        if (!$pay_5dn) $pay_5dn = 0;
        if (!$pay_last_week) $pay_last_week = 0;
        if (!$pay_week_ago) $pay_week_ago = 0;
        if (!$pay_week_ago1) $pay_week_ago1 = 0;
        if (!$pay_week_ago2) $pay_week_ago2 = 0;
        if (!$pay_last_month) $pay_last_month = 0;
        if (!$pay_last_month1) $pay_last_month1 = 0;
        if (!$pay_last_month2) $pay_last_month2 = 0;
        if (!$pay_last_month3) $pay_last_month3 = 0;
        if (!$reg_yesterday) $reg_yesterday = 0;
        if (!$reg_3dn) $reg_3dn = 0;
        if (!$reg_4dn) $reg_4dn = 0;
        if (!$reg_5dn) $reg_5dn = 0;

        if (!$reg_this_week) $reg_this_week = 0;
        if (!$reg_last_week) $reg_last_week = 0;
        if (!$reg_week_ago) $reg_week_ago = 0;
        if (!$reg_week_ago1) $reg_week_ago1 = 0;

        return view('admin.index', compact('user_money', 'user_today', 'opened_today', 'pay_today', 'pay_week', 'pay_month', 'pay_all', 'pay_yesterday', 'pay_3dn', 'pay_4dn', 'pay_5dn', 'pay_last_week', 'pay_week_ago', 'pay_week_ago1', 'pay_week_ago2', 'pay_last_month', 'pay_last_month1', 'pay_last_month2', 'pay_last_month3', 'reg_yesterday', 'reg_3dn', 'reg_4dn', 'reg_5dn', 'reg_last_week', 'reg_week_ago', 'reg_week_ago1', 'reg_this_week'));
    }
}
