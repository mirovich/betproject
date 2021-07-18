<?php


namespace App\Services;


use App\Models\Bookmaker;
use App\Models\Game;
use App\Models\Odd;
use App\Models\Team;
use App\Models\Tournament;
use Illuminate\Support\Carbon;

class ProcessGameService
{
    private $games = [];
    private $tournament;

    public function __construct($games, Tournament $tournament, UploadCountryLogoService $logoService)
    {
        $this->games = $games;
        $this->tournament = $tournament;
        $this->logoService = $logoService;
    }

    public function save()
    {
        if (count($this->games)) {
            foreach ($this->games as $match) {
                if (!$homeTeam = Team::whereApiId($match->homeTeam->id)->first()) {
                    $homeTeam = new Team();
                    $homeTeam->team_logo = $this->logoService->storeTeamLogo($match->homeTeam->logo);
                    $homeTeam->team_name = $match->homeTeam->name;
                    $homeTeam->api_id = $match->homeTeam->id;
                    $homeTeam->save();
                }
                if (!$awayTeam = Team::whereApiId($match->awayTeam->id)->first()) {
                    $awayTeam = new Team();
                    $awayTeam->team_logo = $this->logoService->storeTeamLogo($match->awayTeam->logo);
                    $awayTeam->team_name = $match->awayTeam->name;
                    $awayTeam->api_id = $match->awayTeam->id;
                    $awayTeam->save();
                }

                $matchModel = Game::whereApiId($match->fixture_id)->first() ?? new Game();
                $matchModel->event_date = Carbon::parse($match->event_date)->toDateTimeString();
                $matchModel->status = 0;
                $matchModel->scoreHome = $match->goalsHomeTeam;
                $matchModel->scoreAway = $match->goalsAwayTeam;
                $matchModel->api_id = $match->fixture_id;
                $matchModel->homeTeam()->associate($homeTeam);
                $matchModel->awayTeam()->associate($awayTeam);
                $matchModel->tournament()->associate($this->tournament);
                $matchModel->save();

                if ($match->odds) {
                    if (!$bookmakerModel = Bookmaker::whereApiId($match->odds->bookmaker_id)->first()) {
                        $bookmakerModel = new Bookmaker;
                        $bookmakerModel->api_id = $match->odds->bookmaker_id;
                        $bookmakerModel->bookmaker_name = $match->odds->bookmaker_name;
                        $bookmakerModel->save();
                    }

                    foreach ($match->odds->bets as $bet) {
                        foreach ($bet->values as $value) {
                            $odd = new Odd;
                            $odd->label_id = $bet->label_id;
                            $odd->label_name = $bet->label_name;
                            $odd->value = $value->value;
                            $odd->odd = $value->odd;
                            $odd->bookmaker()->associate($bookmakerModel);
                            $odd->game()->associate($matchModel);
                            $odd->save();
                        }
                    }
                }
            }
        }
    }
}
