<?php

namespace App\Livewire;

use App\Models\WaterLog;
use App\Services\WaterCalculatorService;
use Illuminate\Support\Facades\Auth; 
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class WaterCalculator extends Component
{
    public string $record_date = '';
    public ?int $weight_kg = null;
    public ?int $height_cm = null;
    public string $activity_level = 'sedang';
    public ?int $actual_intake_ml = null;

    public ?int $result_requirement_ml = null;
    public ?string $result_status = null;

    public function mount(): void
    {
        $this->record_date = now()->format('Y-m-d');
        $this->weight_kg = Auth::user()->weight_kg;
        $this->height_cm = Auth::user()->height_cm;
    }

    protected function rules(): array
    {
        return [
            'record_date' => 'required|date',
            'weight_kg' => 'required|integer|min:10|max:300',
            'height_cm' => 'nullable|integer|min:50|max:250',
            'activity_level' => 'required|in:ringan,sedang,berat',
            'actual_intake_ml' => 'required|integer|min:0',
        ];
    }

    public function hitung(WaterCalculatorService $service): void
    {
        $this->validate();

        $requirement = $service->calculateRequirement($this->weight_kg, $this->activity_level);
        $status = $service->determineStatus($requirement, $this->actual_intake_ml);

        WaterLog::updateOrCreate(
            ['user_id' => Auth::id(), 'record_date' => $this->record_date],
            [
                'weight_kg' => $this->weight_kg,
                'height_cm' => $this->height_cm,
                'activity_level' => $this->activity_level,
                'calculated_requirement_ml' => $requirement,
                'actual_intake_ml' => $this->actual_intake_ml,
                'hydration_status' => $status,
            ]
        );

        $this->result_requirement_ml = $requirement;
        $this->result_status = $status;
    }

    public function render()
    {
        return view('livewire.water-calculator');
    }
}
