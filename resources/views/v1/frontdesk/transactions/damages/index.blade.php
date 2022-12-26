@php
    $breadcrumbs = [
        [
            'name' => 'Transactions',
            'url' => route('frontdesk.transactions'),
        ],
        [
            'name' => 'Damages',
            'url' => '#',
        ],
    ];
@endphp

<x-frontdesk-layout>
    <x-slot:header>
        <x-breadcrumbs :links="$breadcrumbs" />
    </x-slot:header>

    @livewire('frontdesk.transactions.damages.index', [
        'guest' => $guest,
    ])
</x-frontdesk-layout>
