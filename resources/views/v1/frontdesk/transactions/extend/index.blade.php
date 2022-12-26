@php
    $breadcrumbs = [
        [
            'name' => 'Transactions',
            'url' => route('frontdesk.transactions'),
        ],
        [
            'name' => 'Extend Stay',
            'url' => '#',
        ],
    ];
@endphp

<x-frontdesk-layout>
    <x-slot:header>
        <x-breadcrumbs :links="$breadcrumbs" />
    </x-slot:header>

    @livewire('frontdesk.transactions.extend.index', [
        'guest' => $guest,
    ])
</x-frontdesk-layout>
