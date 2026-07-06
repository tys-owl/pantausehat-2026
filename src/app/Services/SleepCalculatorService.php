<?php

namespace App\Services;

use Carbon\Carbon;

class SleepCalculatorService
{
    // menit, titik tengah rentang di BRD
    private const IDEAL_BY_AGE = [
        ['min' => 14, 'max' => 17, 'ideal' => 540], // 8-10 jam
        ['min' => 18, 'max' => 64, 'ideal' => 480], // 7-9 jam
        ['min' => 65, 'max' => 200, 'ideal' => 450], // 7-8 jam
    ];

    public function idealMinutesForAge(int $age): int
    {
        foreach (self::IDEAL_BY_AGE as $bracket) {
            if ($age >= $bracket['min'] && $age <= $bracket['max']) {
                return $bracket['ideal'];
            }
        }

        return 480; // fallback dewasa
    }

    public function actualDurationMinutes(Carbon $sleepStart, Carbon $wakeTime): int
    {
        if ($wakeTime->lessThanOrEqualTo($sleepStart)) {
            $wakeTime = $wakeTime->copy()->addDay(); // tidur lewat tengah malam
        }

        return $sleepStart->diffInMinutes($wakeTime);
    }

    public function sleepDebtMinutes(int $idealMinutes, int $actualMinutes): int
    {
        return max(0, $idealMinutes - $actualMinutes);
    }
}