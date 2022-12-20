@php
    $breadcrumbs = [
        [
            'name' => 'Check In',
            'url' => '#',
        ],
    ];
@endphp

<x-frontdesk-layout>
    <x-slot:header>
        <x-breadcrumbs :links="$breadcrumbs" />
    </x-slot:header>
    @livewire('frontdesk.check-in.index')
</x-frontdesk-layout>
