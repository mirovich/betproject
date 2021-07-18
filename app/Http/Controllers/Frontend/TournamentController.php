<?php


namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Http\Resources\Frontend\SingleTournamentResource;
use App\Http\Resources\Frontend\TournamentResource;
use App\Models\Tournament;
use Carbon\Carbon;

class TournamentController extends Controller
{
    public function active()
    {
        $tournaments = Tournament::whereStatus(4)->get();

        // $result_games = [];
        // $result_bets = [];

        // foreach ($tournaments as $tournament) {
        //     foreach ($tournament->games as $game){
        //         array_push($result_games , $game);
        //         foreach($game->odds as $odd){
        //             array_push($result_bets , $odd);
        //         }

        //     }
        // }

        // dd($result_bets);
        return view($this->folder . '.pages.tournaments', compact('tournaments'));
    }

    public function getInfo($id)
    {
        return new SingleTournamentResource(Tournament::findOrFail($id));
    }

    public function getAll()
    {
        return TournamentResource::collection(Tournament::all());
    }


    public function show(Tournament $tournament)
    {
        // $usersInTournaments = $tournament->users;
        // $count_users = $tournament->max_participant;
        // $score = 0;

        // if($count_users <= 10)
        // {
        //     $usersInTournaments;
        // }

        return view($this->folder . '.tournaments.show', compact('tournament'));
    }

    public function over()
    {
        $tournaments = Tournament::whereStatus(4)->get();
        return view($this->folder . '.pages.tournaments', compact('tournaments'));
    }

    public function tournamentWiner(Tournament $tournament){
        $usersInTournaments = $tournament->users;
        $count_users = $tournament->max_participant;
        $score = 0;
        if($count_users <= 10){
            $usersInTournaments;
        }

    }
}
