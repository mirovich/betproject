<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $folder = 'goldenmines';

    public function __construct(Request $request)
    {

        $site = Site::where('url', 'like', '%' . $request->getHost() . '%')->first();
        define('SITE_ID', $site->id);
        $this->folder = $site->folder;
        $this->site = $site;
    }

}
