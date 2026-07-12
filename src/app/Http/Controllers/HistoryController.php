<?php

namespace App\Http\Controllers;

use App\Models\WaterLog;
use App\Models\SleepLog;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
     public function index()
    {
        $startDate = Carbon::now()->subDays(29)->startOfDay();
        $weekStart = Carbon::now()->subDays(6)->startOfDay();
        $prevWeekStart = $weekStart->copy()->subDays(7);

        $waterLogs = WaterLog::where('user_id', Auth::id())
            ->where('record_date', '>=', $startDate)
            ->orderBy('record_date')
            ->get();

        $sleepLogs = SleepLog::where('user_id', Auth::id())
            ->where('record_date', '>=', $startDate)
            ->orderBy('record_date')
            ->get();

       $todayEnd = Carbon::now()->endOfDay();

        $weekWaterLogs = $waterLogs->whereBetween('record_date', [$weekStart, $todayEnd]);
        $weekSleepLogs = $sleepLogs->whereBetween('record_date', [$weekStart, $todayEnd]);

        $prevWeekWaterLogs = $waterLogs->where('record_date', '<', $weekStart);
        $prevWeekSleepLogs = $sleepLogs->where('record_date', '<', $weekStart);

        $weeklySummary = [
            'water_avg_actual' => $weekWaterLogs->isNotEmpty() ? round($weekWaterLogs->avg('actual_intake_ml')) : null,
            'water_avg_requirement' => $weekWaterLogs->isNotEmpty() ? round($weekWaterLogs->avg('calculated_requirement_ml')) : null,
            'water_cukup_days' => $weekWaterLogs->where('hydration_status', 'cukup')->count(),
            'water_total_days' => $weekWaterLogs->count(),

            'sleep_avg_actual_hours' => $weekSleepLogs->isNotEmpty() ? round($weekSleepLogs->avg('actual_duration_minutes') / 60, 1) : null,
            'sleep_avg_ideal_hours' => $weekSleepLogs->isNotEmpty() ? round($weekSleepLogs->avg('ideal_requirement_minutes') / 60, 1) : null,
            'sleep_debt_days' => $weekSleepLogs->where('sleep_debt_minutes', '>', 0)->count(),
            'sleep_total_days' => $weekSleepLogs->count(),
        ];

        // Perbandingan dengan minggu sebelumnya
        $waterTrend = null;
        if ($weekWaterLogs->isNotEmpty() && $prevWeekWaterLogs->isNotEmpty()) {
            $diff = $weeklySummary['water_avg_actual'] - round($prevWeekWaterLogs->avg('actual_intake_ml'));
            $waterTrend = ['diff' => $diff, 'direction' => $diff > 0 ? 'naik' : ($diff < 0 ? 'turun' : 'sama')];
        }

        $sleepTrend = null;
        if ($weekSleepLogs->isNotEmpty() && $prevWeekSleepLogs->isNotEmpty()) {
            $prevAvgDebt = round($prevWeekSleepLogs->avg('sleep_debt_minutes'));
            $currAvgDebt = round($weekSleepLogs->avg('sleep_debt_minutes'));
            $diff = $currAvgDebt - $prevAvgDebt;
            // debt turun = membaik, debt naik = memburuk
            $sleepTrend = ['diff' => abs($diff), 'direction' => $diff < 0 ? 'membaik' : ($diff > 0 ? 'memburuk' : 'sama')];
        }

        $waterChart = [
            'labels' => $waterLogs->map(fn ($log) => $log->record_date->format('d M'))->values(),
            'requirement' => $waterLogs->pluck('calculated_requirement_ml')->values(),
            'actual' => $waterLogs->pluck('actual_intake_ml')->values(),
        ];

        $sleepChart = [
            'labels' => $sleepLogs->map(fn ($log) => $log->record_date->format('d M'))->values(),
            'actual' => $sleepLogs->map(fn ($log) => round($log->actual_duration_minutes / 60, 1))->values(),
            'ideal' => $sleepLogs->map(fn ($log) => round($log->ideal_requirement_minutes / 60, 1))->values(),
            'debt' => $sleepLogs->pluck('sleep_debt_minutes')->values(),
        ];

        return view('history.index', [
            'waterLogs' => $waterLogs->sortByDesc('record_date'),
            'sleepLogs' => $sleepLogs->sortByDesc('record_date'),
            'waterChart' => $waterChart,
            'sleepChart' => $sleepChart,
            'weeklySummary' => $weeklySummary,
            'waterTrend' => $waterTrend,
            'sleepTrend' => $sleepTrend,
        ]);
    }
}