@php
    $breadcrumbs = [
        [
            'name' => 'Rates',
            'url' => route('admin.rates'),
        ],
        [
            'name' => 'Edit',
            'url' => '#',
        ],
    ];
@endphp

<x-admin-layout>
    <x-slot:header>
        <x-breadcrumbs :links="$breadcrumbs" />
    </x-slot:header>
    @livewire('admin.rates.edit', [
        'rate' => $rate,
    ])
</x-admin-layout>
