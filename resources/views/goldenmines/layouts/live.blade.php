<div class="live-win">
    <div class="container">
      
		<?php
			$users = \DB::table('users')->count();
			$drops = \DB::table('games')->count();
			$last_drop = \DB::table('games')->orderBy('id', 'desc')->limit(15)->get();
			foreach($last_drop as $d)
			{
				$item = \DB::table('items')->where('id', $d->drop_item)->first();
				$user = \DB::table('users')->where('id', $d->user)->first();
				
				$d->price = $item->cost;
				$d->avatar = "/img/avatar2.png";
			}
		?>
        <div class="live-win__stat-wrapper">
                        <div class="live-win__stat-line">
                <div class="live-win__stat-block live-win__stat-block_gold">
                    <div class="live-win__stat-key">{{ trans('Online') }}:&nbsp;</div>
                    <div id="online-counter" class="live-win__stat-value" data-value="201">201</div>
                </div>
                <div class="live-win__stat-block live-win__stat-block_red">
                    <div class="live-win__stat-key">{{ trans('Users') }}:&nbsp;</div>
                    <div id="user-counter" class="live-win__stat-value" data-value="{{169000 + $users}}">{{ 169000 + $users}}</div>
                </div>
                <div class="live-win__stat-block live-win__stat-block_blue">
                    <div class="live-win__stat-key">{{ trans('Games') }}:&nbsp;</div>
                    <div id="case-counter" class="live-win__stat-value" data-value="{{2780000 + $drops}}">{{2780000 + $drops}}</div>
                </div>
            </div>
        </div>

    </div>
</div>  