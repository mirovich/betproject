<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Cards;
use App\Models\Items;
use App\Models\Game;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class ProfileController extends Controller
{
    protected function showTaxSwift()
    {
        $ops = DB::table('operations')->where('user', Auth::user()->id)->where('type', 1)->where('status', 0)->first();
        if ($ops) {
            $show_swift = !$ops->swift;
            $show_tax = $ops->swift && !$ops->tax;
            $tax_amount = round($ops->amount * .13, 2);
            View::share('tax_amount', $tax_amount);
        } else {
            $show_swift = null;
            $show_tax = null;
        }
        View::share('show_swift', $show_swift);
        View::share('show_tax', $show_tax);
    }

    public function index()
    {
        if (Auth::guest()) {
            return redirect('/');
        }
        $usr_pos = User::where('profit', '>', Auth::user()->profit)->count() + 1;
        $history = Game::limit(24)->orderBy('id', 'desc')->get();
        $last_g = 0;
        // foreach ($history as $h) {
        //     $card = Cards::where('id', $h->card)->first();
        //     if (!empty($card)) {
        //         $h->name = $card->name;
        //         $item = Items::where('id', $h->drop_item)->first();
        //         if ($item == true) {
        //             $h->image = $item->image;
        //         }
        //     }
        //     $last_g = $h->id;
        // }
        $this->showTaxSwift();
        return view($this->folder . '.pages.profile', compact('usr_pos', 'history', 'last_g'));
    }

    public function partner()
    {
        if (Auth::guest()) {
            return redirect('/');
        }
        $this->showTaxSwift();
        $usr_pos = User::where('profit', '>', Auth::user()->profit)->count() + 1;
        $history = Games::limit(24)->orderBy('id', 'desc')->get();
        $referals = User::where('ref_user', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view($this->folder . '.pages.partner', compact('usr_pos', 'history', 'usr_pos', 'referals'));
    }

    public function finance()
    {
        if (Auth::guest()) {
            return redirect()->back();
        }

        $this->showTaxSwift();

        $show_taxes = DB::table('operations')->where('user', Auth::user()->id)->where('is_swift', 1)->where('status', 1)->where('is_fake', 0)->count();
        $operations = DB::table('operations')->where('user', Auth::user()->id)->orderBy('id', 'desc')->limit(100)->get();
        if ($show_taxes)
            $operations = DB::table('operations')->where('user', Auth::user()->id)->orderBy('id', 'desc')->limit(100)->get();
        else
            $operations = DB::table('operations')->where('user', Auth::user()->id)->where('is_tax', 0)->orderBy('id', 'desc')->limit(100)->get();
        $usr_pos = User::where('profit', '>', Auth::user()->profit)->count() + 1;
        $o = null;
        return view($this->folder . '.pages.finance', compact('usr_pos', 'operations', 'o'));
    }

}
