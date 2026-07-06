{{-- resources/views/components/validation-errors.blade.php --}}
@if ($errors->any())
    <div {{ $attributes->merge(['class' => 'font-medium']) }}>
        <ul class="list-disc list-inside space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif