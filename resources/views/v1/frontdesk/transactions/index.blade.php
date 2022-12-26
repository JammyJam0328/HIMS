@php
    $breadcrumbs = [
        [
            'name' => 'Transactions',
            'url' => '#',
        ],
    ];
@endphp

<x-frontdesk-layout>
    <x-slot:header>
        <x-breadcrumbs :links="$breadcrumbs" />
    </x-slot:header>
    @livewire('frontdesk.transactions.index')
</x-frontdesk-layout>
