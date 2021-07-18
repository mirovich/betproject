<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Site;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $site = Site::where('id', SITE_ID)->first();
        $settings = $site->setting;
        return view('admin.pages.settings', compact('settings'));
    }

    public function save(Request $r)
    {
        $site = Site::where('id', SITE_ID)->first();
        $site->setting->update([
            'vk_group' => $r->get('vk_group'),
            'vk_token' => $r->get('vk_token'),
            'min_dep' => $r->get('min_dep'),
            'min_width' => $r->get('min_width'),
            'ref_percent' => $r->get('tttk'),
            'payment_type' => $r->get('payment_type'),
            'fk_id' => $r->get('fk_id'),
            'fk_secret1' => $r->get('fk_secret1'),
            'fk_secret2' => $r->get('fk_secret2'),
            'pt_shopid' => $r->get('pt_shopid'),
            'pt_secret' => $r->get('pt_secret'),
            'payeer_shopid' => $r->get('payeer_shopid'),
            'payeer_secret' => $r->get('payeer_secret'),
            'created_text' => $r->get('created_text'),
        ]);

        $r->session()->flash('alert-success', 'Настройки обновлены!');
        return redirect()->back();
    }
}
