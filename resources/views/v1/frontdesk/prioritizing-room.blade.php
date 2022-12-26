@php
    $breadcrumbs = [
        [
            'name' => 'Priority Room',
            'url' => '#',
        ],
    ];
@endphp

<x-frontdesk-layout>
    <x-slot:header>
        <x-breadcrumbs :links="$breadcrumbs" />
    </x-slot:header>
    @livewire('frontdesk.priority-rooms.index')
</x-frontdesk-layout>
