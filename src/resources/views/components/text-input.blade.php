@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full rounded-xl border border-[var(--sage-100)] bg-[var(--bg-mint)] px-4 py-2.5 text-sm text-[var(--ink)] placeholder-gray-400 focus:border-[var(--sage-500)] focus:ring-[var(--sage-500)] focus:bg-white transition']) }}>
