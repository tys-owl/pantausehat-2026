<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    protected $fillable = [
        'site_name',
        'logo',
        'hero_image',
        'about_content',
        'contact_email',
        'operational_hours',
    ];

    // Karena cuma 1 baris (singleton settings)
    public static function current(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }
}