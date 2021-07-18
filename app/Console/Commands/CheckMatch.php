<?php

namespace App\Console\Commands;

use App\Models\Tournament;
use App\Services\ApiFootballService;
use Illuminate\Console\Command;

class CheckMatch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'match:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tournaments = Tournament::where('status', 2)
            ->get();
        foreach ($tournaments as $tournament) {
            foreach ($tournament->games as $key => $game) {
                $check = $this->getodds($game->api_id);
                dd ($check);
            }
        }
        return 0;
    }

    public function getodds($id){
        $check = (new ApiFootballService())->getOdds($id);
        $bookmakersCollection = collect($check)->first();
        if (isset($bookmakersCollection->bookmakers)) {
            $collection = collect($bookmakersCollection->bookmakers);
            $mapped = (object)$collection->map(function ($bk, $key) {
                return [
                    'bookmaker_id' => $bk->bookmaker_id,
                    'bookmaker_name' => $bk->bookmaker_name,
                    'bets' => collect($bk->bets)->filter(function ($bk, $key) {
                        return $bk->label_id === 1 || $bk->label_id === 5;
                    })->map(function ($bk, $key) {
                        if ($bk->label_id === 5) {
                            return (object)[
                                'label_id' => $bk->label_id,
                                'label_name' => $bk->label_name,
                                'values' => collect($bk->values)->filter(function ($val, $key) {
                                    return $val->value === 'Over 2.5' || $val->value === 'Under 2.5';
                                })->values()->toArray()
                            ];
                        }
                        return $bk;
                    })->values()->toArray()
                ];
            })->first();

            return response()->json(['odds' => $mapped]);
        }
        return 0;
    }
}
