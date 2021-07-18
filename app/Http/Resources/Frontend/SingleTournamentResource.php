<?php

namespace App\Http\Resources\Frontend;

use Illuminate\Http\Resources\Json\JsonResource;

class SingleTournamentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $total = [];
        foreach(GameResource::collection($this->games) as $bets) {
            array_push($total , $bets->odds);
        }
        return [
            'id' => $this->id,
            'tournamentName' => $this->name,
            'regStatus' => false,
            'buyin' => $this->entrance_fee,
            'leagueName' => $this->name,
            'pdfFile' => null,
            'events' => GameResource::collection($this->games),
            'eventBets' => $total,
            'betTypes' => [],
            'betTypeOutcomes' => [],
            'users' => [],
            'tournamentType' => 'Default',
            'icon' => $this->logo,
            'description' => null
        ];
    }
}
