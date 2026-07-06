<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaterLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'record_date',
        'weight_kg',
        'height_cm',
        'activity_level',
        'calculated_requirement_ml',
        'actual_intake_ml',
        'hydration_status',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'record_date' => 'date',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
