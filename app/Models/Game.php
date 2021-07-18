<?php

namespace App\Models;

use App\Services\ApiFootballService;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $guarded = [''];

    protected static function booted()
    {
        static::created(function ($match) {
            $bookmakers = (new ApiFootballService())->getOdds($match->api_id);
            $bookmakersCollection = collect($bookmakers)->first();
            if (isset($bookmakersCollection->bookmakers)) {
                $collection = collect($bookmakersCollection->bookmakers);
                $mapped[0] = (object)$collection->map(function ($bk, $key) {
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
                        })->toArray()
                    ];
                })->first();
                foreach ($mapped as $bookmaker) {
                    if (!$bookmakerModel = Bookmaker::whereApiId($bookmaker->bookmaker_id)->first()) {
                        $bookmakerModel = new Bookmaker;
                        $bookmakerModel->api_id = $bookmaker->bookmaker_id;
                        $bookmakerModel->bookmaker_name = $bookmaker->bookmaker_name;
                        $bookmakerModel->save();
                    }
                    foreach ($bookmaker->bets as $bet) {
                        if ($bet->label_id === 1 || $bet->label_id === 5) {
                            foreach ($bet->values as $value) {
                                $odd = new Odd;
                                $odd->label_id = $bet->label_id;
                                $odd->label_name = $bet->label_name;
                                $odd->value = $value->value;
                                $odd->odd = $value->odd;
                                $odd->bookmaker()->associate($bookmakerModel);
                                $odd->game()->associate($match);
                                $odd->save();
                            }
                        }
                    }
                }
            }
        });
    }

    public function odds()
    {
        return $this->hasMany(\App\Models\Odd::class, 'game_id', 'id');
    }

    public function homeTeam()
    {
        return $this->belongsTo(Team::class, 'home_team_id', 'id');
    }

    public function tournament()
    {
        return $this->belongsTo(Tournament::class, 'league_id', 'id');
    }

    public function awayTeam()
    {
        return $this->belongsTo(Team::class, 'away_team_id', 'id');
    }
}
