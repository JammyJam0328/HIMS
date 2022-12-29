@php
    $breadcrumbs = [
        [
            'name' => 'Kitchen',
            'url' => '#',
        ],
    ];
@endphp

<x-frontdesk-layout>
    <x-slot:header>
        <x-breadcrumbs :links="$breadcrumbs" />
    </x-slot:header>
    @livewire('frontdesk.kitchen.index')
</x-frontdesk-layout>
