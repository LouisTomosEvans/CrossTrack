<button {{ $attributes->merge(['type' => 'button', 'class' => 'bg-gray-500 inline-flex items-center px-4 py-2 rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-500 disabled:opacity-25 transition']) }}>
    {{ $slot }}
</button>
