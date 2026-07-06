@php($setting = \App\Models\WebsiteSetting::current())

@if ($setting->logo)
    <img src="{{ asset('storage/' . $setting->logo) }}" {{ $attributes->merge(['class' => 'h-8 w-8 object-contain']) }}>
@else
    <span {{ $attributes->merge(['class' => 'font-display font-bold text-lg']) }}>{{ $setting->site_name }}</span>
@endif
