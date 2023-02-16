@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 border-opacity-50 border-solid text-gray-600 focus:border-gray-200 focus:ring-gray-200 focus:ring-opacity-50 rounded-md']) !!}>
