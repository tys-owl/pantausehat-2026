<?php

namespace App\Filament\Admin\Widgets;

use App\Filament\Admin\Pages\ManageWebsiteSettings;
use Filament\Widgets\Widget;

class WebsiteSettingsShortcut extends Widget
{
    protected static string $view = 'filament.admin.widgets.website-settings-shortcut';

    protected int|string|array $columnSpan = 1;

    protected static ?int $sort = 2;

    public function getSettingsUrl(): string
    {
        return ManageWebsiteSettings::getUrl();
    }
}
