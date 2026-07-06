<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full inline-flex justify-center items-center px-6 py-2.5 rounded-full font-medium text-sm text-white bg-[var(--sage-500)] hover:bg-[var(--sage-600)] transition disabled:opacity-50']) }}>
    {{ $slot }}
</button>
