<?php
declare(strict_types=1);

namespace App\Composers;

use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class FrontendLayoutComposer
{
    /**
     * @var Setting
     */
    private $settings;

    public function __construct(Setting $settings)
    {
        $this->settings = $settings->where('site_id', SITE_ID)->first();
    }

    public function compose(View $view): void
    {
        $view->with($this->getData());
    }

    private function getData(): array
    {
        return [
            'baseUrl' => url('/'),
            'settings' => $this->settings
        ];
    }
}
