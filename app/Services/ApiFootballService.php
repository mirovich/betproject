<?php


namespace App\Services;


class ApiFootballService
{
    private $response = null;

    public $endpoint = null;

    const LEAGUE_ENDPOINT = '/leagues/current/';

    const LEAGUE_SEARCH_ENDPOINT = '/leagues/search/';

    const MATCHES_OODS = '/odds/fixture/';

    const LEAGUE_ODDS = "/odds/league/";

    const LEAGUE_MATCHES_ENDPOINT = '/fixtures/';

    const LEAGUE_w_ENDPOINT = "/fixtures/league/";

    const LEAGUE_MATCH_ENDPOINT = '/fixtures/date/';

    public function getResponseAsArray($returnField = null)
    {
        $errors = [];
        if ($this->response->code !== 200) {
            return response()->json(['messages' => 'Ошибка при выполнении запроса!'], 400);
        }
        if (isset($this->response->body->api->error)) {
            return response()->json(['message' => $this->response->body->api->error], 400);
        }
        if($returnField == null){
            return $this->response->body->api;
        }
        return $this->response->body->api->{$returnField};
    }


    public function getResponse($returnField = null)
    {
        $errors = [];
        if ($this->response->code !== 200) {
            return response()->json(['messages' => 'Ошибка при выполнении запроса!', "res" => $this->response,"url" => config('services.rapid_api.API_URL') . $this->endpoint], 400);
        }
        if (isset($this->response->body->api->error)) {
            return response()->json(['message' => $this->response->body->api->error], 400);
        }
        if($returnField == null){
            return $this->response->body->api;
        }
        return response()->json(['message' => null, $returnField => $this->response->body->api->{$returnField}], 200);
    }



    private function makeRequest2($field)
    {
        $this->response = \Unirest\Request::get(config('services.rapid_api.API_URL') . $this->endpoint,
            [
                'Accept' => 'application/json',
                'X-RapidAPI-Key' => config('services.rapid_api.API_KEY')
            ]);
        return $this->getResponseAsArray($field);
    }

    private function makeRequest($field)
    {
        $this->response = \Unirest\Request::get(config('services.rapid_api.API_URL') . $this->endpoint,
            [
                'Accept' => 'application/json',
                'X-RapidAPI-Key' => config('services.rapid_api.API_KEY')
            ]);
        return $this->getResponse($field);
    }

    public function getOdds($id)
    {
        $this->endpoint = self::MATCHES_OODS . $id;
        return $this->makeRequest2('odds');
    }

    public function getActiveLeagues()
    {
        $this->endpoint = self::LEAGUE_ENDPOINT ;
        return $this->makeRequest2('leagues');
    }

    public function getActiveMatchesTwoWeek($league_id , $from)
    {
        $this->endpoint = self::LEAGUE_w_ENDPOINT.$league_id."/".$from;//."/season/".$season;
        //
        return $this->makeRequest(null);
    }

    public function getCountries()
    {
        $this->endpoint = "/countries";
        return $this->makeRequest('countries');
    }

    public function getActiveMatches($date)
    {
        $this->endpoint = self::LEAGUE_MATCHES_ENDPOINT . '/date/' . $date . '?timezone=Europe/London';
        return $this->makeRequest2('fixtures');
    }

    public function getMatches($date)
    {
        $this->endpoint = self::LEAGUE_MATCH_ENDPOINT . $date . '?timezone=Europe/London';
        return $this->makeRequest('fixtures');
    }

    public function searchLeague($searchString)
    {
        $this->endpoint = self::LEAGUE_SEARCH_ENDPOINT . str_replace(' ', '_', $searchString);
        return $this->makeRequest('leagues');
    }

    public function getLeagues($endpoint)
    {
        $this->endpoint = $endpoint;
        $this->response = \Unirest\Request::post(config('services.rapid_api.API_URL'), $this->endpoint,
            [
                'Accept' => 'application/json',
                'X-RapidAPI-Key' => config('services.rapid_api.API_KEY')
            ]);
    }

    public function getLeaguesOdds($id){

       $this->endpoint = self::LEAGUE_ODDS . $id ;
       return $this->makeRequest2(null);

    }
}
