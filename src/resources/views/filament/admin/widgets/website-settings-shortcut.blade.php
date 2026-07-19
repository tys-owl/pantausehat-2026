
<x-filament-widgets::widget>

    <x-filament::section>

        <a href="{{ $this->getSettingsUrl() }}" class="flex items-center gap-4 group">

            <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-primary-50 dark:bg-primary-500/10">

                <x-filament::icon icon="heroicon-o-cog-6-tooth" class="w-6 h-6 text-primary-600 dark:text-primary-400" />

            </div>

            <div>

                <div class="text-sm font-medium text-gray-500 dark:text-gray-400">

                    Pengaturan

                </div>

                <div class="text-base font-semibold text-gray-950 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400">

                    Website Settings

                </div>

            </div>

        </a>

    </x-filament::section>

</x-filament-widgets::widget>

