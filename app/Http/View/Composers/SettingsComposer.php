<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Helpers\SettingsHelper;

class SettingsComposer
{
    protected $settings;

    public function __construct()
    {
        // Mendapatkan semua pengaturan menggunakan helper
        $this->settings = SettingsHelper::getAllSettings();
    }

    public function compose(View $view)
    {
        // Memasukkan data pengaturan ke dalam view
        $view->with('settings', $this->settings);
    }
}
