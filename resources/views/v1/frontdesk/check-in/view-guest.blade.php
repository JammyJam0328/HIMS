@php
    $breadcrumbs = [
        [
            'name' => 'Check In',
            'url' => route('frontdesk.check-in'),
        ],
        [
            'name' => 'View Guest',
            'url' => '#',
        ],
    ];
@endphp

<x-frontdesk-layout>
    <x-slot:header>
        <x-breadcrumbs :links="$breadcrumbs" />
    </x-slot:header>

    @livewire('frontdesk.check-in.view-guest', [
        'guest' => $guest,
    ])
</x-frontdesk-layout>
