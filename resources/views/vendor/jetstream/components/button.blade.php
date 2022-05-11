<button {{ $attributes->merge(['type' => 'submit', 'style' => 'background-color: black;', 'class' => 'inline-flex items-center px-4 py-2 border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring focus:ring-green-300 disabled:opacity-25 transition']) }}>
    {{ $slot }}
</button>
