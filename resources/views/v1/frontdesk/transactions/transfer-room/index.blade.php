@php
    $breadcrumbs = [
        [
            'name' => 'Transactions',
            'url' => route('frontdesk.transactions'),
        ],
        [
            'name' => 'Transfer Room',
            'url' => '#',
        ],
    ];
@endphp

<x-frontdesk-layout>
    <x-slot:header>
        <x-breadcrumbs :links="$breadcrumbs" />
    </x-slot:header>
    @livewire('frontdesk.transactions.transfer-room.index', [
        'guest' => $guest,
    ])
</x-frontdesk-layout>
