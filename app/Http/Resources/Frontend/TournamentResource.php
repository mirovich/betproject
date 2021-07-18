<?php

namespace App\Http\Resources\Frontend;

use Illuminate\Http\Resources\Json\JsonResource;

class TournamentResource extends JsonResource
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
            'status' => $this->status,
            'name' => $this->name,
            'shortName' => $this->name,
            'buyin' => $this->entrance_fee,
            'capacity' => $this->max_participant,
            'currentRegCount' => 1, // TODO: current participant
            'startDate' => $this->start_date,
            'endDate' => $this->end_date,
            'prizFund' => $this->ensure_won,
            'regStartDate' => $this->register_end,
            'tournamentType' => 'Default',
            'isActive' => $this->status,
            'leagus' => '1',
            'icon' => $this->logo,
            'regStatus' => false,
            'regEndDate' => $this->register_end,
            'tournamentStatus' => $this->status,
            'link'  => Route("show_tournament",["tournament" => $this->id]),
        ];
    }
}
