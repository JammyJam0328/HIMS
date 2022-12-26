@php
    $breadcrumbs = [
        [
            'name' => 'Transactions',
            'url' => route('frontdesk.transactions'),
        ],
        [
            'name' => 'Deposits',
            'url' => '#',
        ],
    ];
@endphp

<x-frontdesk-layout>
    <x-slot:header>
        <x-breadcrumbs :links="$breadcrumbs" />
    </x-slot:header>

    @livewire('frontdesk.transactions.deposits.index', [
        'guest' => $guest,
    ])
</x-frontdesk-layout>
