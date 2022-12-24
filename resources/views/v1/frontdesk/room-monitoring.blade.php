@php
    $breadcrumbs = [
        [
            'name' => 'Room Monitoring',
            'url' => '#',
        ],
    ];
@endphp

<x-frontdesk-layout>
    <x-slot:header>
        <x-breadcrumbs :links="$breadcrumbs" />
    </x-slot:header>
    @livewire('frontdesk.room-monitoring.index')
</x-frontdesk-layout>
