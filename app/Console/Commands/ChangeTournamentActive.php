<?php

namespace App\Console\Commands;

use App\Models\Tournament;
use Illuminate\Console\Command;

class ChangeTournamentActive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tournament:over';

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
        $tournaments = Tournament::where('end_date', '<=', \Carbon\Carbon::now()->toDateTimeString())
            ->where('status', '=', 2)
            ->get();
        foreach ($tournaments as $tournament) {
            $tournament->status = 4;
            $tournament->save();
        }
        return 0;
    }
}
