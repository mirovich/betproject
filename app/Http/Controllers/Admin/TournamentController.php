<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTournamentRequest;
use App\Models\Game;
use App\Models\News;
use App\Models\Team;
use App\Models\Tournament;
use App\Services\ApiFootballService;
use App\Services\ApiFootballV3Service;
use App\Services\ProcessGameService;
use App\Services\UploadCountryLogoService;
use App\Traits\UploadTrait;
use Cache;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use function Symfony\Component\String\s;

class TournamentController extends Controller
{
    use UploadTrait;

    public function index()
    {
        $tournaments = Tournament::all();
        return view('admin.tournament.index', compact('tournaments'));
    }

    public function create(ApiFootballService $footballService)
    {
        $matches = collect([]);
//        foreach (range(0, 1) as $number) {
//            $date = Carbon::now()->addDays($number)->toDateString();
//            $matches->push($footballService->getActiveMatches($date));
//        }
//        $map = $matches->flatten()->groupBy('league_id')->map(function ($s, $key) {
//            return $s->map(function ($league, $key) use ($s) {
//                return [
//                    'league_id' => $league->league_id,
//                    'league_name' => $league->league->name,
//                    'league_country' => $league->league->country,
//                    'league_logo' => $league->league->logo,
//                    'matches' => $s->map(function ($item, $key) use ($league) {
//                        return [
//                            'event_date' => $item->event_date,
//                            'status' => $item->status,
//                            'statusShort' => $item->statusShort,
//                            'venue' => $item->venue,
//                            'fixture_id' => $item->fixture_id,
//                            'homeTeam' => $item->homeTeam,
//                            'awayTeam' => $item->awayTeam,
//                            'goalsHomeTeam' => $item->goalsHomeTeam,
//                            'goalsAwayTeam' => $item->goalsAwayTeam
//                        ];
//                    })->toArray()
//                ];
//            });
//        });
        return view('admin.tournament.create', ['matches' => []]);
//        return view('admin.tournament.create', ['matches' => $map->flatten(1)->unique('league_id')->values()->toArray()]);
    }

    public function store(CreateTournamentRequest $request, UploadCountryLogoService $logoService)
    {
        try {
            $logo = $request->file('logo');
            $name = Str::slug($request->input('logo')) . '_' . time() . '.' . $request->logo->extension();
            $tournament = new Tournament();
            $tournament->name = $request->name;
            $tournament->start_date = Carbon::parse($request->start_date . ' ' . $request->start_date_time)->toDateTimeString();
            $tournament->end_date = Carbon::parse($request->end_date . ' ' . $request->end_date_time)->toDateTimeString();
            $tournament->register_end = Carbon::parse($request->register_end . ' ' . $request->register_end_time)->toDateTimeString();
            $tournament->entrance_fee = $request->entrance_fee;
            $tournament->max_participant = $request->max_participant;
            $tournament->ensure_won = $request->ensure_won;
            $tournament->status = $request->status;
            $tournament->logo = $this->uploadToStorage($logo->getRealPath(), $name, 'league_logo');
            $tournament->save();
            (new ProcessGameService(json_decode($request->matches), $tournament, $logoService))->save();
            $request->session()->flash('alert-success', 'Турнир создан!');
            return redirect()->route('tournaments');
        } catch (\Exception $exception) {
            $request->session()->flash('alert-error', 'Ошибка при создании турнира!');
            return redirect()->route('tournaments');
        }
    }

    public function edit($id, ApiFootballService $footballService)
    {
        $tournament = Tournament::findOrFail($id);
        $matches = collect([]);
        foreach (range(0, 1) as $number) {
            $date = Carbon::now()->addDays($number)->toDateString();
            $matches->push($footballService->getActiveMatches($date));
        }
        $map = $matches->flatten()->groupBy('league_id')->map(function ($s, $key) {
            return $s->map(function ($league, $key) use ($s) {
                return [
                    'league_id' => $league->league_id,
                    'league_name' => $league->league->name,
                    'league_country' => $league->league->country,
                    'league_logo' => $league->league->logo,
                    'matches' => $s->map(function ($item, $key) use ($league) {
                        return [
                            'event_date' => $item->event_date,
                            'status' => $item->status,
                            'statusShort' => $item->statusShort,
                            'venue' => $item->venue,
                            'fixture_id' => $item->fixture_id,
                            'homeTeam' => $item->homeTeam,
                            'awayTeam' => $item->awayTeam,
                            'goalsHomeTeam' => $item->goalsHomeTeam,
                            'goalsAwayTeam' => $item->goalsAwayTeam
                        ];
                    })->toArray()
                ];
            });
        });
        return view('admin.tournament.edit', ['tournament' => $tournament, 'matches' => $map->flatten(1)->unique('league_id')->values()->toArray()]);
    }

    public function update(Request $request, $id)
    {
        try {
            $tournament = Tournament::findOrFail($id);
            $tournament->update($request->except('logo'));
            $request->session()->flash('alert-success', 'Турнир обновлена!');
            return redirect()->route('tournaments');
        } catch (\Exception $exception) {
            $request->session()->flash('alert-error', 'Ошибка при обновлении!');
            return redirect()->route('tournaments');
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            $news = Tournament::findOrFail($id);
            $news->delete();
            $request->session()->flash('alert-success', 'Турнир удален!');
            return redirect()->route('tournaments');
        } catch (\Exception $exception) {
            $request->session()->flash('alert-error', 'Ошибка при удалении!');
            return redirect()->route('tournaments');
        }
    }
}
