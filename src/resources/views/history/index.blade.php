<x-app-layout>
    <x-slot name="header">
        <h2 class="font-display font-bold text-xl text-[var(--ink)]">Histori & Grafik</h2>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <p class="text-sm text-[var(--body-text)]">Menampilkan data 30 hari terakhir.</p>

        {{-- Ringkasan Mingguan --}}
        <div class="bg-white rounded-2xl shadow-sm p-6">
            <h3 class="font-display font-semibold text-lg text-[var(--ink)] mb-1">Ringkasan Minggu Ini</h3>
            <p class="text-xs text-[var(--body-text)] mb-5">Berdasarkan data 7 hari terakhir</p>

            <div class="grid sm:grid-cols-2 gap-5">
                <div class="rounded-xl bg-[var(--bg-mint)] p-5">
                    <p class="text-xs font-medium text-[var(--sage-600)] uppercase tracking-wide mb-2">Hidrasi</p>
                    @if ($weeklySummary['water_total_days'] > 0)
                        <p class="text-2xl font-display font-bold text-[var(--ink)]">
                            {{ $weeklySummary['water_avg_actual'] }} ml
                        </p>
                        <p class="text-sm text-[var(--body-text)] mt-1">
                            rata-rata per hari, dari target {{ $weeklySummary['water_avg_requirement'] }} ml
                        </p>
                        <p class="text-sm text-[var(--body-text)]">
                            {{ $weeklySummary['water_cukup_days'] }} dari {{ $weeklySummary['water_total_days'] }} hari tercatat cukup
                        </p>
                        @if ($waterTrend)
                            <p class="text-xs mt-3 {{ $waterTrend['direction'] === 'naik' ? 'text-[var(--sage-600)]' : ($waterTrend['direction'] === 'turun' ? 'text-amber-600' : 'text-[var(--body-text)]') }}">
                                @if ($waterTrend['direction'] === 'sama')
                                    Sama seperti minggu lalu
                                @else
                                    {{ $waterTrend['direction'] === 'naik' ? 'Naik' : 'Turun' }} {{ $waterTrend['diff'] > 0 ? $waterTrend['diff'] : $waterTrend['diff'] * -1 }} ml dari minggu lalu
                                @endif
                            </p>
                        @endif
                    @else
                        <p class="text-sm text-[var(--body-text)]">Belum ada data minggu ini.</p>
                    @endif
                </div>

                <div class="rounded-xl bg-[var(--bg-mint)] p-5">
                    <p class="text-xs font-medium text-[var(--sage-600)] uppercase tracking-wide mb-2">Tidur</p>
                    @if ($weeklySummary['sleep_total_days'] > 0)
                        <p class="text-2xl font-display font-bold text-[var(--ink)]">
                            {{ $weeklySummary['sleep_avg_actual_hours'] }} jam
                        </p>
                        <p class="text-sm text-[var(--body-text)] mt-1">
                            rata-rata per hari, dari target {{ $weeklySummary['sleep_avg_ideal_hours'] }} jam
                        </p>
                        <p class="text-sm text-[var(--body-text)]">
                            {{ $weeklySummary['sleep_debt_days'] }} dari {{ $weeklySummary['sleep_total_days'] }} hari ada hutang tidur
                        </p>
                        @if ($sleepTrend)
                            <p class="text-xs mt-3 {{ $sleepTrend['direction'] === 'membaik' ? 'text-[var(--sage-600)]' : ($sleepTrend['direction'] === 'memburuk' ? 'text-amber-600' : 'text-[var(--body-text)]') }}">
                                @if ($sleepTrend['direction'] === 'sama')
                                    Sama seperti minggu lalu
                                @else
                                    Kualitas tidur {{ $sleepTrend['direction'] }} dibanding minggu lalu
                                @endif
                            </p>
                        @endif
                    @else
                        <p class="text-sm text-[var(--body-text)]">Belum ada data minggu ini.</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Grafik Air --}}
        <div class="bg-white rounded-2xl shadow-sm p-6">
            <h3 class="font-display font-semibold text-lg text-[var(--ink)] mb-4">Tren Kebutuhan Air (ml)</h3>
            @if ($waterLogs->isEmpty())
                <p class="text-sm text-[var(--body-text)]">Belum ada data. Yuk hitung kebutuhan airmu dulu.</p>
            @else
                <canvas id="waterChart" height="90"></canvas>
            @endif
        </div>

        {{-- Grafik Tidur --}}
        <div class="bg-white rounded-2xl shadow-sm p-6">
            <h3 class="font-display font-semibold text-lg text-[var(--ink)] mb-4">Tren Durasi Tidur (jam)</h3>
            @if ($sleepLogs->isEmpty())
                <p class="text-sm text-[var(--body-text)]">Belum ada data. Yuk hitung kebutuhan tidurmu dulu.</p>
            @else
                <canvas id="sleepChart" height="90"></canvas>
            @endif
        </div>

        {{-- Tabel Histori Air --}}
        <div class="bg-white rounded-2xl shadow-sm p-6 overflow-x-auto">
            <h3 class="font-display font-semibold text-lg text-[var(--ink)] mb-4">Riwayat Air</h3>
            @if ($waterLogs->isEmpty())
                <p class="text-sm text-[var(--body-text)]">Belum ada riwayat.</p>
            @else
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-[var(--body-text)] border-b border-[var(--sage-100)]">
                            <th class="py-2 pr-4">Tanggal</th>
                            <th class="py-2 pr-4">Kebutuhan</th>
                            <th class="py-2 pr-4">Diminum</th>
                            <th class="py-2 pr-4">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($waterLogs as $log)
                            <tr class="border-b border-[var(--sage-100)] last:border-0">
                                <td class="py-2 pr-4">{{ $log->record_date->format('d M Y') }}</td>
                                <td class="py-2 pr-4">{{ $log->calculated_requirement_ml }} ml</td>
                                <td class="py-2 pr-4">{{ $log->actual_intake_ml }} ml</td>
                                <td class="py-2 pr-4">
                                    <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $log->hydration_status === 'cukup' ? 'bg-[var(--sage-100)] text-[var(--sage-600)]' : 'bg-amber-100 text-amber-700' }}">
                                        {{ ucfirst($log->hydration_status) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        {{-- Tabel Histori Tidur --}}
        <div class="bg-white rounded-2xl shadow-sm p-6 overflow-x-auto">
            <h3 class="font-display font-semibold text-lg text-[var(--ink)] mb-4">Riwayat Tidur</h3>
            @if ($sleepLogs->isEmpty())
                <p class="text-sm text-[var(--body-text)]">Belum ada riwayat.</p>
            @else
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-[var(--body-text)] border-b border-[var(--sage-100)]">
                            <th class="py-2 pr-4">Tanggal</th>
                            <th class="py-2 pr-4">Durasi</th>
                            <th class="py-2 pr-4">Ideal</th>
                            <th class="py-2 pr-4">Sleep Debt</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sleepLogs as $log)
                            <tr class="border-b border-[var(--sage-100)] last:border-0">
                                <td class="py-2 pr-4">{{ $log->record_date->format('d M Y') }}</td>
                                <td class="py-2 pr-4">{{ round($log->actual_duration_minutes / 60, 1) }} jam</td>
                                <td class="py-2 pr-4">{{ round($log->ideal_requirement_minutes / 60, 1) }} jam</td>
                                <td class="py-2 pr-4">
                                    @if ($log->sleep_debt_minutes > 0)
                                        <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-700">{{ $log->sleep_debt_minutes }} menit</span>
                                    @else
                                        <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-[var(--sage-100)] text-[var(--sage-600)]">Tidak ada</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

    </div>

    @if ($waterLogs->isNotEmpty() || $sleepLogs->isNotEmpty())
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
        <script>
            const sage500 = '#4F9E76';
            const sage300 = '#A9D4B7';
            const sageInk = '#1F2E27';

            @if ($waterLogs->isNotEmpty())
            new Chart(document.getElementById('waterChart'), {
                type: 'line',
                data: {
                    labels: @json($waterChart['labels']),
                    datasets: [
                        {
                            label: 'Kebutuhan (ml)',
                            data: @json($waterChart['requirement']),
                            borderColor: sage300,
                            backgroundColor: sage300,
                            tension: 0.3,
                        },
                        {
                            label: 'Diminum (ml)',
                            data: @json($waterChart['actual']),
                            borderColor: sage500,
                            backgroundColor: sage500,
                            tension: 0.3,
                        },
                    ],
                },
                options: {
                    plugins: { legend: { labels: { color: sageInk } } },
                    scales: {
                        x: { ticks: { color: sageInk } },
                        y: { ticks: { color: sageInk }, beginAtZero: true },
                    },
                },
            });
            @endif

            @if ($sleepLogs->isNotEmpty())
            new Chart(document.getElementById('sleepChart'), {
                type: 'line',
                data: {
                    labels: @json($sleepChart['labels']),
                    datasets: [
                        {
                            label: 'Durasi Tidur (jam)',
                            data: @json($sleepChart['actual']),
                            borderColor: sage500,
                            backgroundColor: sage500,
                            tension: 0.3,
                        },
                        {
                            label: 'Ideal (jam)',
                            data: @json($sleepChart['ideal']),
                            borderColor: sage300,
                            backgroundColor: sage300,
                            borderDash: [5, 5],
                            tension: 0.3,
                        },
                    ],
                },
                options: {
                    plugins: { legend: { labels: { color: sageInk } } },
                    scales: {
                        x: { ticks: { color: sageInk } },
                        y: { ticks: { color: sageInk }, beginAtZero: true },
                    },
                },
            });
            @endif
        </script>
    @endif
</x-app-layout>