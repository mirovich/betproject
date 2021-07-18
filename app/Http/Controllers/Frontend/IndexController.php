<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Ticket;
use App\TicketAttachment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Tournament;
use App\User;
use Illuminate\Support\Facades\View;
use Auth;
use File;
use Str;

class IndexController extends Controller
{
    const currency = 643; // pay-trio


    public function index(Request $r)
        {
            $tournaments = Tournament::get();
            $top_users = User::orderBy('profit', 'desc')->limit(10)->get();

            if (isset($r->utm_term)) {
                $utm = User::where('id', $r->utm_term)->first();
                if ($utm == true) {
                    $utm_name = $utm->username;
                    $utm_avatar = $utm->avatar;
                    return view($this->folder . '.pages.index', compact('tournaments', 'top_users', 'utm_name', 'utm_avatar'));
                } else {
                    return view($this->folder . '.pages.index', compact('tournaments', 'top_users'));
                }
            } else {
                return view($this->folder . '.pages.index', compact('tournaments', 'top_users'));
            }
        }

    public function terms()
    {
        return view($this->folder . '.pages.terms');
    }

    public function privacy()
    {
        return view($this->folder . '.pages.privacy');
    }

    public function bonus()
    {
        return view($this->folder . '.pages.bonus');
    }

    public function help()
    {
        return view($this->folder . '.pages.help');
    }

    public function faq()
    {
        return view($this->folder . '.pages.faq');
    }

    public function ticket()
    {
        $tickets = Ticket::where("user_id", Auth::user()->id)->get();
        return view($this->folder.".tickets.index", compact("tickets"));
    }

    public function ticket_post(Request $request){

        if (isset($request->text) && $request->text != "") {
            $ticket  = new Ticket;
            $ticket->user_id = Auth::user()->id;
            $ticket->manager_id = Auth::user()->manager_id;
            $ticket->text = $request->text;
            $ticket->direction = "question";
            $ticket->ip = $request->ip();
            $ticket->save();

            if ($ticket){
                if ($request->hasFile('attachments')) {
                    foreach ($request->file('attachments') as $file) {
                        $type = stristr($file->getMimeType(), '/', true);
                        if($type == "image") {
                            @mkdir(public_path() . '/uploads/tickets/' . $ticket->id . '/', 0755, true);
                            $newfile = Str::random(20) . '.' . $file->getClientOriginalExtension();
                            if ($file->move(public_path() . '/uploads/tickets/' . $ticket->id . '/', $newfile)) {
                                TicketAttachment::create([
                                    'ticket_id' => $ticket->id,
                                    'file' => $newfile,
                                    'filename' => $file->getClientOriginalName()
                                ]);
                            }
                        }
                    }
                }
            }
            $request->session()->flash('alert-success', __('Ticket sent!'));
        }else{
            $request->session()->flash('alert-danger', __('Вы не написали сообщение!'));
        }
        return redirect()->back();
    }


}
