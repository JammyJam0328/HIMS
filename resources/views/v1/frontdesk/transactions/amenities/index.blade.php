@php
    $breadcrumbs = [
        [
            'name' => 'Transactions',
            'url' => route('frontdesk.transactions'),
        ],
        [
            'name' => 'Amenities',
            'url' => '#',
        ],
    ];
@endphp

<x-frontdesk-layout>
    <x-slot:header>
        <x-breadcrumbs :links="$breadcrumbs" />
    </x-slot:header>
    @livewire('frontdesk.transactions.request-amenities.index', [
        'guest' => $guest,
    ])
</x-frontdesk-layout>
