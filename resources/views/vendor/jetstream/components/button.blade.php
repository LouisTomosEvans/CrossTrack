<button {{ $attributes->merge(['type' => 'submit', 'style' => 'background-color: #1a59e0;', 'class' => 'inline-flex items-center px-4 py-2 border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition']) }}>
    {{ $slot }}
</button>
