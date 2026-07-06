<div> 

    <div class="bg-white border-b border-[var(--sage-100)]">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-display font-bold text-xl text-[var(--ink)]">Kebutuhan Air</h2>
        </div>
    </div>

    <div class="max-w-5xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

        <div class="max-w-md mx-auto">

            <form wire:submit="hitung" class="space-y-4">
                <div>
                    <label>Tanggal</label>
                    <input type="date" wire:model="record_date" class="w-full border rounded p-2">
                    @error('record_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label>Berat Badan (kg)</label>
                    <input type="number" wire:model="weight_kg" class="w-full border rounded p-2">
                    @error('weight_kg') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label>Tinggi Badan (cm)</label>
                    <input type="number" wire:model="height_cm" class="w-full border rounded p-2">
                </div>
                <div>
                    <label>Tingkat Aktivitas</label>
                    <select wire:model="activity_level" class="w-full border rounded p-2">
                        <option value="ringan">Ringan</option>
                        <option value="sedang">Sedang</option>
                        <option value="berat">Berat</option>
                    </select>
                </div>
                <div>
                    <label>Air yang Sudah Diminum (ml)</label>
                    <input type="number" wire:model="actual_intake_ml" class="w-full border rounded p-2">
                    @error('actual_intake_ml') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Hitung</button>
            </form>

            @if ($result_requirement_ml !== null)
                <div class="mt-6 p-4 rounded border">
                    <p>Kebutuhan air kamu: <strong>{{ $result_requirement_ml }} ml</strong></p>
                    <p>Status: <strong>{{ ucfirst($result_status) }}</strong></p>
                </div>
            @endif
        </div>

    </div>
</div>