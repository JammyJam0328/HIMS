@props(['type' => 'button', 'href' => null])

@php
    $tag = $href ? 'a' : 'button';
@endphp

<{{ $tag }} type="{{ $type }}"
    @if ($tag) href="{{ $href }}" @endif
    wire:loading.attr="disabled"
    {{ $attributes->merge(['class' => 'inline-flex items-center  px-4 py-2 text-sm font-medium text-gray-700 bg-white  border border-gray-300 rounded-lg shadow-sm sm:order-0 hover:bg-gray-50 focus:outline-none ']) }}>
    {{ $slot }}
    </{{ $tag }}>
