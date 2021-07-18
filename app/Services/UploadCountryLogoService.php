<?php


namespace App\Services;

use Illuminate\Support\Facades\Storage;

class UploadCountryLogoService
{
    public function store($url)
    {
        $contents = file_get_contents($url);
        $name = substr($url, strrpos($url, '/') + 1);
        if (\Storage::disk('country_logo')->put($name, $contents)) {
            return Storage::disk('country_logo')->url($name);
        }
        return 'empty.jpg';
    }

    public function storeTeamLogo($url)
    {
        $contents = file_get_contents($url);
        $name = substr($url, strrpos($url, '/') + 1);
        if (\Storage::disk('team_logo')->put($name, $contents)) {
            return Storage::disk('team_logo')->url($name);
        }
        return 'empty.jpg';
    }

    public function storeTournamentLogo($url)
    {
        $contents = file_get_contents($url);
        $name = substr($url, strrpos($url, '/') + 1);
        if (\Storage::disk('league_logo')->put($name, $contents)) {
            return Storage::disk('league_logo')->url($name);
        }
        return 'empty.jpg';
    }
}
