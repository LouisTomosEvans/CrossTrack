<div class="md:col-span-1 flex justify-between">
    <div class="px-4 sm:px-0">
        <h3 class="text-lg font-medium" style="color: rgb(40, 50, 59); font-weight: 700;">{{ $title }}</h3>

        <p class="mt-1 text-sm" style="color: rgb(40, 50, 59);">
            {{ $description }}
        </p>
    </div>

    <div class="px-4 sm:px-0">
        {{ $aside ?? '' }}
    </div>
</div>
