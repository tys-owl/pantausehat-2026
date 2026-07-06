<?php

namespace App\Filament\Admin\Pages;

use App\Models\WebsiteSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageWebsiteSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Pengaturan Website';
    protected static ?string $title = 'Pengaturan Website';
    protected static string $view = 'filament.admin.pages.manage-website-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(WebsiteSetting::current()->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('site_name')->required(),
                Forms\Components\FileUpload::make('logo')->image()->directory('logos'),

                Forms\Components\FileUpload::make('hero_image')
                    ->image()
                    ->directory('hero')
                    ->label('Foto Hero (halaman utama)')
                    ->helperText('Foto orang/aktivitas yang tampil di sisi kanan halaman utama.'),

                Forms\Components\RichEditor::make('about_content')->columnSpanFull(),
                Forms\Components\TextInput::make('contact_email')->email(),
                Forms\Components\TextInput::make('operational_hours'),
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        WebsiteSetting::current()->update($this->form->getState());

        Notification::make()
            ->title('Pengaturan berhasil disimpan')
            ->success()
            ->send();
    }
}
