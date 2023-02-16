<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6']) }}>
    <x-jet-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-jet-section-title>

    <div class="md:mt-0 md:col-span-2">
        <div class="px-4 py-5 sm:p-6 sm:rounded-lg" style="background-color: #ffffff; border-radius: 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1);">
            {{ $content }}
        </div>
    </div>
</div>
