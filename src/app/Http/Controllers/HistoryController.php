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
        $startDate = Carbon::now()->subDays(13)->startOfDay();

        $waterLogs = WaterLog::where('user_id', Auth::id())
            ->where('record_date', '>=', $startDate)
            ->orderBy('record_date')
            ->get();

        $sleepLogs = SleepLog::where('user_id', Auth::id())
            ->where('record_date', '>=', $startDate)
            ->orderBy('record_date')
            ->get();

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
        ]);
    }
}
