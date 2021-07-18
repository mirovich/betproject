<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
#use App\Models\Settings;
use App\Settings;
use App\Models\Site;
use App\User;
use Auth;
use Carbon\Carbon;
use \DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(25);
        $site = Site::where('id', SITE_ID)->first();
        $settings = $site->setting;
        $managers = User::whereIn('role', [10, 11])->get();
        foreach ($users as $user) {
            $user->payed = DB::table('operations')->where('user', $user->id)->where('type', 0)->where('status', 1)->sum('amount');
            $user->with = DB::table('operations')->where('user', $user->id)->where('type', 1)->where('status', 1)->sum('amount');
            $user->with0 = DB::table('operations')->where('user', $user->id)->where('type', 1)->where('status', 0)->sum('amount');
            if ($user->payed === null) $user->payed = 0;
            if ($user->with === null) $user->with = 0;
            if ($user->with0 === null) $user->with0 = 0;
        }
        return view('admin.users.index', compact('users', 'managers', 'settings', 'site'));
    }

    public function create()
    {
        $site = Site::where('id', SITE_ID)->first();
        $settings = $site->setting;
        $managers = User::whereIn('role', [10, 11])->get();
        return view('admin.includes.modal_users_create', compact('managers', 'settings', 'site'));
    }

    //TODO: middleware for banned user
    public function store(Request $r)
    {
        if ($r->get('id')) {
            $user = User::findOrFail($r->get('id'));
            $user->update([
                'money' => $r->get('money'),
                'role' => $r->get('role'),
                'is_yt' => $r->get('is_yt'),
                'bonus_money' => $r->get('bonus_money'),
                'ref_link' => $r->get('ref_link'),
                'is_permanent_banned' => $r->has('is_permanent_banned') && $r->get('is_permanent_banned') == 1 ? true : false,
                'opened' => $r->get('opened'),
                'deposit' => $r->get('deposit'),
                'manager_id' => $r->get('manager_id') ? $r->get('manager_id') : Auth::user()->id,
            ]);
            if ($r->has('banned_to')) {
                $now = \Carbon\Carbon::now();
                $banned_to = \Carbon\Carbon::parse($r->get('banned_to'));
                if ($banned_to->greaterThan($now)) {
                    $user->is_temporary_banned = true;
                    $user->banned_to = $banned_to->toDateTimeString();
                    $user->save();
                } else {
                    $user->is_temporary_banned = false;
                    $user->banned_to = $banned_to->toDateTimeString();
                    $user->save();
                }
            }
            $r->session()->flash('alert-success', 'Настройки пользователя сохранены!');
            return redirect()->back();
        }

        $r->session()->flash('alert-danger', trans('Wrong data!'));

        $r->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-z0-9]+$/i'],
        ]);

        $r->session()->forget('alert-danger');

        $user = User::where('username', $r->name)->first();

        if (!empty($user)) {
            $r->session()->flash('alert-danger', trans("User Exists: " . $user->username));
            return redirect('/admin/user');
        }

        $password = Str::random(8);
        $user = \App\User::create([
            'name' => $r->name,
            'username' => $r->name,
            'password' => Hash::make($password),
            'email' => $r->name . '@azinocase.com',
            'money' => $r->money,
            'avatar' => '/img/avatar.png',
            'login' => "",
            'login2' => "",
            'role' => (int)$r->role,
            'is_yt' => 0,
            'profit' => 0,
            'opened' => 0,
            'deposit' => $r->money,
            'bonus_money' => 0,
            'manager_id' => $r->manager_id ? $r->manager_id : Auth::user()->id
        ]);

        if (!empty($user)) {
            DB::table('operations')->insertGetId([
                'amount' => $r->money,
                'user' => $user->id,
                'type' => 0, // ТИП - Партнер
                'status' => 1,
                'koshelek' => 'payeer',
                'timestamp' => \Carbon\Carbon::now(),
                'is_fake' => 1
            ]);
        }

        $r->session()->flash('show_modal_created', true);
        $r->session()->flash('created_name', $user->username);
        $r->session()->flash('created_password', $password);
        $r->session()->flash('created_money', $user->money);
        $r->session()->flash('alert-success', "User Created!");

        return redirect('/admin/user#usr_created');
    }

    public function balanceReduce(Request $r)
    {
        if ($r->get('id')) {
            $user = User::find($r->get('id'));
            $reduced = $user->money > $r->get('amount') ? $r->get('amount') : $user->money;
            if ($user->update(['money' => $user->money - $reduced])) {
                if ($r->get('make_ransaction')) {
                    if ($opID = DB::table('operations')->insertGetId([
                        'amount' => $reduced,
                        'user' => $user->id,
                        'type' => 1, // ТИП - Вывод
                        'status' => 1,
                        'is_fake' => 1,
                        'koshelek' => 'payeer',
                        'timestamp' => Carbon::now()
                    ]))
                        DB::table('operations')->insertGetId([
                            'amount' => $r->get('amount'),
                            'user' => $user->id,
                            'type' => 0, // ТИП - Вывод
                            'status' => 1,
                            'is_fake' => 1,
                            'is_swift' => 1,
                            'operation' => $opID,
                            'koshelek' => 'payeer',
                            'timestamp' => Carbon::now()
                        ]);

                    DB::table('operations')->insertGetId([
                        'amount' => round($reduced * .13, 0),
                        'user' => $user->id,
                        'type' => 0, // ТИП - Вывод
                        'status' => 1,
                        'is_fake' => 1,
                        'is_tax' => 1,
                        'operation' => $opID,
                        'koshelek' => 'payeer',
                        'timestamp' => Carbon::now()
                    ]);
                }
                $r->session()->flash('alert-success', trans('Balance updated!'));
                return redirect()->back();
            }
        }
    }

    public function balanceReplenish(Request $r)
    {
        if ($r->get('id')) {
            $user = User::find($r->get('id'));
            if ($user->update(['money' => $r->get('amount') + $user->money])) {
                if ($r->get('make_ransaction')) {
                    DB::table('operations')->insertGetId([
                        'amount' => $r->get('amount'),
                        'user' => $user->id,
                        'type' => 0, // ТИП - Пополнение
                        'is_fake' => 1,
                        'status' => 1,
                        'koshelek' => 'payeer',
                        'timestamp' => Carbon::now()
                    ]);
                }
                $r->session()->flash('alert-success', trans('Balance updated!'));

                return redirect()->back();
            }
        }
    }

    public function create_user()
	{
		#$settings = Settings::where('id', SITE_ID)->first();
		$site = Site::where('id', SITE_ID)->first();
		$managers = User::whereIn('role', [10, 11])->get();
		return view('admin.includes.modal_users_create', compact('managers', 'settings', 'site'));
	}

	public function edit_user($id)
	{
		$user = User::findOrFail($id);
		$managers = User::whereIn('role', [10, 11])->get();
        #$settings = Settings::where('id', SITE_ID)->first();
        $site = Site::where('id', SITE_ID)->first();
        $settings = $site->setting;
		$site = Site::where('id', SITE_ID)->first();
		$user->payed = DB::table('operations')->where('user', $user->id)->where('type', 0)->where('status', 1)->sum('amount');
		$user->with =  DB::table('operations')->where('user', $user->id)->where('type', 1)->where('status', 1)->sum('amount');
		$user->with0 = DB::table('operations')->where('user', $user->id)->where('type', 1)->where('status', 0)->sum('amount');
		if ($user->payed == null) $user->payed = 0;
		if ($user->with == null) $user->with = 0;
		if ($user->with0 == null) $user->with0 = 0;
		return view('admin.includes.modal_users', compact('managers', 'user', 'settings', 'site'));
	}

	public function replenish_user($id)
	{
		$user = User::findOrFail($id);
		$user->payed = DB::table('operations')->where('user', $user->id)->where('type', 0)->where('status', 1)->sum('amount');
		$user->with =  DB::table('operations')->where('user', $user->id)->where('type', 1)->where('status', 1)->sum('amount');
		$user->with0 = DB::table('operations')->where('user', $user->id)->where('type', 1)->where('status', 0)->sum('amount');
		if ($user->payed == null) $user->payed = 0;
		if ($user->with == null) $user->with = 0;
		if ($user->with0 == null) $user->with0 = 0;
		return view('admin.includes.modal_users_replenish', ['user' => $user]);
		#['user' => $user, 'pay' => $pay, 'with' => $with, 'with0' => $with0]
    }

    public function takeaway_user($id)
	{
		$user = User::findOrFail($id);
		$user->payed = DB::table('operations')->where('user', $user->id)->where('type', 0)->where('status', 1)->sum('amount');
		$user->with =  DB::table('operations')->where('user', $user->id)->where('type', 1)->where('status', 1)->sum('amount');
		$user->with0 = DB::table('operations')->where('user', $user->id)->where('type', 1)->where('status', 0)->sum('amount');
		if ($user->payed == null) $user->payed = 0;
		if ($user->with == null) $user->with = 0;
		if ($user->with0 == null) $user->with0 = 0;
		return view('administrator.includes.modal_users_takeaway', ['user' => $user]);
		#['user' => $user, 'pay' => $pay, 'with' => $with, 'with0' => $with0]
	}

    public function destroy(User $user, Request $request)
    {
        try {
            $user->delete();
            $request->session()->flash('alert-success', 'Пользователь удален!');
            return redirect()->back();
        } catch (\Exception $e) {
            $request->session()->flash('alert-danger', $e->getMessage());
            return redirect()->back();
        }
    }

    public function tournamentParticipant(Request $r)
    {
        if ($r->get('id')) {
            $user = User::find($r->get('id'));
            $reduced = $user->money > $r->get('amount') ? $r->get('amount') : $user->money;
            if ($user->update(['money' => $user->money - $reduced])) {
                if ($r->get('make_ransaction')) {
                    if ($opID = DB::table('operations')->insertGetId([
                        'amount' => $reduced,
                        'user' => $user->id,
                        'type' => 1, // ТИП - Вывод
                        'status' => 1,
                        'is_fake' => 1,
                        'koshelek' => 'payeer',
                        'timestamp' => Carbon::now()
                    ]))
                        DB::table('operations')->insertGetId([
                            'amount' => $r->get('amount'),
                            'user' => $user->id,
                            'type' => 0, // ТИП - Вывод
                            'status' => 1,
                            'is_fake' => 1,
                            'is_swift' => 1,
                            'operation' => $opID,
                            'koshelek' => 'payeer',
                            'timestamp' => Carbon::now()
                        ]);

                    DB::table('operations')->insertGetId([
                        'amount' => round($reduced * .13, 0),
                        'user' => $user->id,
                        'type' => 0, // ТИП - Вывод
                        'status' => 1,
                        'is_fake' => 1,
                        'is_tax' => 1,
                        'operation' => $opID,
                        'koshelek' => 'payeer',
                        'timestamp' => Carbon::now()
                    ]);

                    }

                DB::table('tournament_users')->insertGetId([
                    'tournament_id' => $r->get('tournamentId'),
                    'user_id' => $user->id,
                    'score' => $r->get('score_in_tournament'),
                ]);
                $r->session()->flash('alert-success', trans('Balance updated!'));
                return redirect()->back();
            }
        }
            return view('admin.includes.modal_users_takeaway', compact('user'));
    }
}
