<div>
    <div class="bg-white border-b border-[var(--sage-100)]">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-display font-bold text-xl text-[var(--ink)]">Kebutuhan Tidur</h2>
        </div>
    </div>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

        <div class="max-w-md mx-auto">

            <form wire:submit="hitung" class="space-y-4">
                <div>
                    <label>Tanggal</label>
                    <input type="date" wire:model="record_date" class="w-full border rounded p-2">
                    @error('record_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label>Usia (tahun)</label>
                    <input type="number" wire:model="age_years" class="w-full border rounded p-2">
                    @error('age_years') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label>Jam Mulai Tidur</label>
                    <input type="time" wire:model="sleep_start_time" class="w-full border rounded p-2">
                    @error('sleep_start_time') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label>Jam Bangun</label>
                    <input type="time" wire:model="wake_time" class="w-full border rounded p-2">
                    @error('wake_time') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Hitung</button>
            </form>

            @if ($result_debt_minutes !== null)
                <div class="mt-6 p-4 rounded border">
                    <p>Durasi tidur ideal: <strong>{{ $result_ideal_minutes }} menit</strong></p>
                    <p>Durasi tidur kamu: <strong>{{ $result_actual_minutes }} menit</strong></p>
                    <p>Sleep debt: <strong>{{ $result_debt_minutes }} menit</strong>
                        {{ $result_debt_minutes > 0 ? '(kurang tidur)' : '(cukup/lebih)' }}
                    </p>
                </div>
            @endif
        </div>

    </div>
</div>