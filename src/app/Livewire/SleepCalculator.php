<?php

namespace App\Livewire;

use App\Models\SleepLog;
use App\Services\SleepCalculatorService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class SleepCalculator extends Component
{
    public string $record_date = '';
    public ?int $age_years = null;
    public string $sleep_start_time = '';
    public string $wake_time = '';

    public ?int $result_ideal_minutes = null;
    public ?int $result_actual_minutes = null;
    public ?int $result_debt_minutes = null;

    public function mount(): void
    {
        $this->record_date = now()->format('Y-m-d');
        $this->age_years = Auth::user()->age_years;
    }

    protected function rules(): array
    {
        return [
            'record_date' => 'required|date',
            'age_years' => 'required|integer|min:1|max:120',
            'sleep_start_time' => 'required|date_format:H:i',
            'wake_time' => 'required|date_format:H:i',
        ];
    }

    public function hitung(SleepCalculatorService $service): void
    {
        $this->validate();

        $start = Carbon::parse("{$this->record_date} {$this->sleep_start_time}");
        $wake = Carbon::parse("{$this->record_date} {$this->wake_time}");

        $actualMinutes = $service->actualDurationMinutes($start, $wake);
        $idealMinutes = $service->idealMinutesForAge($this->age_years);
        $debtMinutes = $service->sleepDebtMinutes($idealMinutes, $actualMinutes);

        $wakeStored = $wake->lessThanOrEqualTo($start) ? $wake->copy()->addDay() : $wake;

        SleepLog::updateOrCreate(
            ['user_id' => Auth::id(), 'record_date' => $this->record_date],
            [
                'age_years' => $this->age_years,
                'sleep_start_time' => $start,
                'wake_time' => $wakeStored,
                'actual_duration_minutes' => $actualMinutes,
                'ideal_requirement_minutes' => $idealMinutes,
                'sleep_debt_minutes' => $debtMinutes,
            ]
        );

        $this->result_ideal_minutes = $idealMinutes;
        $this->result_actual_minutes = $actualMinutes;
        $this->result_debt_minutes = $debtMinutes;
    }

    public function render()
    {
        return view('livewire.sleep-calculator');
    }
}