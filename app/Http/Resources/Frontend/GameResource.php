<?php

namespace App\Http\Resources\Frontend;

use Illuminate\Http\Resources\Json\JsonResource;

class GameResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
             'id' => $this->id,
            'startDate' => $this->event_date,
            'isActive' => true,
            'homeTeamName' => $this->homeTeam->team_name,
            'guestTeamName' => $this->awayTeam->team_name,
            'homeTeamIcon' => $this->homeTeam->team_logo,
            'guestTeamIcon' => $this->awayTeam->team_logo,
            'homeTeamGoals' => $this->scoreHome,
            'guestTeamGoals' => $this->scoreAway,
            'bets' => $this->odds,
        ];
    }
}
