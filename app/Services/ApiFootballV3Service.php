<?php


namespace App\Services;


class ApiFootballV3Service
{
    public $endpoint = null;

    private $response;

    const LEAGUE_ENDPOINT = '/leagues?';

    const FIXTURE_ENDPOINT = '/fixtures?';

    private function makeRequest()
    {
        $this->response = \Unirest\Request::get('https://api-football-beta.p.rapidapi.com/' . $this->endpoint,
            [
                'Accept' => 'application/json',
                'x-rapidapi-host' => 'api-football-beta.p.rapidapi.com',
                'x-rapidapi-key' => config('services.rapid_api.API_KEY')
            ]);
        return $this->getResponse();
    }

    public function getActiveMatchesTwoWeek($league_id, $from, $to, $season)
    {
        $this->endpoint = self::FIXTURE_ENDPOINT . http_build_query([
                'league' => $league_id,
                'season' => $season,
                'from' => $from,
                'to' => $to
            ]);
        return $this->makeRequest();
    }

    public function getActiveLeagues($season, $current = true)
    {
        $this->endpoint = self::LEAGUE_ENDPOINT . http_build_query(['season' => $season, 'current' => 'true']);
        return $this->makeRequest();
    }


    private function getResponse()
    {
        if ($this->response->code !== 200) {
            //throw new \Exception('Error while request');
            return dd($this->response);
        }
        if (count($this->response->body->errors)) {
            //throw new \Exception('Error while request');
            return dd($this->response);
        }
        return $this->response->body->response;
    }
}
