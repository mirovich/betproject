<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ApiFootballService;
use App\Services\ApiFootballV3Service;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ParserController extends Controller
{

    public function betsByMatchId(Request $request)
    {

        try {
            $bookmakers = (new ApiFootballService())->getOdds($request->match_id);
          //  $bookmakers = \Cache::get('bets');
            //\Cache::forever('bets', $bookmakers);

            $bookmakersCollection = collect($bookmakers)->first();
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
              return response()->json(['error' => "not found"], 404);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function matchesByLeagueId(Request $request, ApiFootballV3Service $service)
    {
        $currentDate = Carbon::now()->addDays(1)->format("Y-m-d");
        $twoWeekLater = Carbon::now()->addWeeks(1)->format("Y-m-d");
        $matches = collect([]);

        try {
            //$matches->push($service->getActiveMatchesTwoWeek($request->league_id, $currentDate, $twoWeekLater, $request->season));
            for($i=1; $i<=14; $i++) {
                $matches = (new ApiFootballService)->getActiveMatchesTwoWeek($request->league_id, $currentDate);
                $res[] = $matches;
                $currentDate = Carbon::now()->addDays($i)->format("Y-m-d");
            }
            $response = array();
            $response['matches'] = array();
            $d = false;
            foreach ($res as $key => $value){
              if($value->fixtures){
                $re[] = (object)$value->fixtures;
              }
                foreach($value->fixtures as $match){
                if (isset($match->league) && $d == false){

                  $response += [
                    "id"  => $request->league_id,
                    "name" => $match->league->name,
                    "logo" => $match->league->logo,
                    "country" => $match->league->country
                  ];
                  $d = true;
                }
                array_push($response["matches"],[
                        'event_date' => $match->event_date,
                        'status' => $match->status,
                        'statusShort' => $match->statusShort,
                        'venue' => $match->venue,
                        'fixture_id' => $match->fixture_id,
                        'homeTeam' => $match->homeTeam,
                        'awayTeam' => $match->awayTeam,
                        'goalsHomeTeam' => $match->goalsHomeTeam ?? 0,
                        'goalsAwayTeam' => $match->goalsAwayTeam ?? 0,
                        'odds' => null
                    ]);
                }
            }
            //$response = json_encode($response,);
            return response()->json(['matches' => $response]);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function leagues(Request $request, ApiFootballV3Service $service)
    {
        $leagues = collect([]);


        try {

            $leagues = (new ApiFootballService())->getActiveLeagues();
            $leagues = collect($leagues);
            $leagues = $leagues->filter(function ($value, $key) {
                return $value->season_end > Carbon::now() && $value->season_start < Carbon::now();
              });
              //return dd($leagues);
            $response = $leagues->map(function ($league, $key) {
                return [
                    'text' => $league->name . ' (' . $league->country . ')',
                    'id' => $league->league_id,
                    'league' => $league->name,
                    'country' => $league->country,
                    'season' => (string)$league->season
                ];

            })->reject(function ($league) {
                return $league['season'] === null;
            })->values()->toJson();
            return response()->json(['leagues' => $response]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
