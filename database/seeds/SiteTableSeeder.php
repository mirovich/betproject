<?php

use App\Models\Site;
use Illuminate\Database\Seeder;

class SiteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sites')->insert([
            'id' => 2,
            'title' => 'СRYPTO СUBE',
            'url' => url('/'),
            'folder' => 'goldenmines'
        ]);

        DB::table('settings')->insert([
            'min_dep' => 250,
            'min_width' => 1500,
            'ref_percent' => 5,
            'vk_group' => 'https://vk.com/',
            'vk_token' => '11',
            'payment_type' => 0,
            'fk_id' => 213276,
            'fk_secret1' => 'tifja8d3',
            'fk_secret2' => '8ocpj0ul',
            'pt_shopid' => '34545',
            'pt_secret' => '43534',
            'payeer_shopid' => '54344',
            'payeer_secret' => '454',
            'created_text' => null,

            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'site_id' => 2
        ]);
    }
}
