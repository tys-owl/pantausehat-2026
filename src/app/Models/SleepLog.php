<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SleepLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'record_date',
        'age_years',
        'sleep_start_time',
        'wake_time',
        'actual_duration_minutes',
        'ideal_requirement_minutes',
        'sleep_debt_minutes',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'record_date' => 'date',
            'sleep_start_time' => 'datetime',
            'wake_time' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
