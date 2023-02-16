@props(['submit'])

<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6 ']) }}>
    <x-jet-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-jet-section-title>

    <div class="md:mt-0 md:col-span-2">
        <form wire:submit.prevent="{{ $submit }}">
            <div class="px-4 py-5 sm:p-6 {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}" style="background-color: #ffffff; border-radius: 8px 8px 0px 0px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1);">
                <div class="grid grid-cols-6 gap-6">
                    {{ $form }}
                </div>
            </div>

            @if (isset($actions))
                <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6 sm:rounded-bl-md sm:rounded-br-md" style="background-color: #ffffff; border-radius: 0px 0px 8px 8px; box-shadow: 0px 0px 5px 0px rgba(40,50,59,.1);">
                    {{ $actions }}
                </div>
            @endif
        </form>
    </div>
</div>
