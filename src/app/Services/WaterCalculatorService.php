<?php


namespace App\Services;

class WaterCalculatorService
{
    private const BASE_ML_PER_KG = 30;

    private const ACTIVITY_FACTORS = [
        'ringan' => 1.0,
        'sedang' => 1.2,
        'berat' => 1.4,
    ];

    public function calculateRequirement(int $weightKg, string $activityLevel): int
    {
        $factor = self::ACTIVITY_FACTORS[$activityLevel] ?? 1.0;

        return (int) round($weightKg * self::BASE_ML_PER_KG * $factor);
    }

    public function determineStatus(int $requirementMl, int $actualIntakeMl): string
    {
        return $actualIntakeMl >= $requirementMl ? 'cukup' : 'kurang';
    }
}