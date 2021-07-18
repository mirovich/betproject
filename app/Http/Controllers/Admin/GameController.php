<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\News;
use App\Models\Team;
use App\Services\ApiFootballService;
use App\Services\UploadCountryLogoService;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function create()
    {
        return view('admin.game.create');
    }

    public function store(Request $request, UploadCountryLogoService $logoService)
    {
        $matches = [];
        $matches[] = $request->match;
        foreach ($matches as $match) {
            if (!$homeTeam = Team::whereApiId($match['homeTeam']['team_id'])->first()) {
                $homeTeam = new Team();
                $homeTeam->team_logo = $logoService->storeTeamLogo($match['homeTeam']['logo']);
                $homeTeam->team_name = $match['homeTeam']['team_name'];
                $homeTeam->api_id = $match['homeTeam']['team_id'];
                $homeTeam->save();
            }
            if (!$awayTeam = Team::whereApiId($match['awayTeam']['team_id'])->first()) {
                $awayTeam = new Team();
                $awayTeam->team_logo = $logoService->storeTeamLogo($match['awayTeam']['logo']);
                $awayTeam->team_name = $match['awayTeam']['team_name'];
                $awayTeam->api_id = $match['awayTeam']['team_id'];
                $awayTeam->save();
            }
            $matchModel = new Game();
            $matchModel->event_date = \Carbon\Carbon::parse($match['event_date'])->toDateTimeString();
            $matchModel->status = 0;
            $matchModel->scoreHome = $match['goalsHomeTeam'];
            $matchModel->scoreAway = $match['goalsAwayTeam'];
            $matchModel->api_id = $match['fixture_id'];
            $matchModel->homeTeam()->associate($homeTeam);
            $matchModel->awayTeam()->associate($awayTeam);
            $matchModel->save();
        }

        return response()->json(['message' => 'Матчи сохранены'], 200);
    }

    public function index()
    {
        $games = Game::all();
        return view('admin.game.index', compact('games'));
    }

    public function parse(Request $request, ApiFootballService $apiFootballService)
    {
        return $apiFootballService->getMatches($request->get('date'));
    }

    public function destroy(Request $request, $id)
    {
        try {
            $news = Game::findOrFail($id);
            $news->delete();
            $request->session()->flash('alert-success', 'Игра удалена!');
            return redirect()->route('matches');
        } catch (\Exception $exception) {
            $request->session()->flash('alert-error', 'Ошибка при удалении!');
            return redirect()->route('matches');
        }
    }
}
