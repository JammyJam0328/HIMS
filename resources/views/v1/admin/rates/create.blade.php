@php
    $breadcrumbs = [
        [
            'name' => 'Rates',
            'url' => route('admin.rates'),
        ],
        [
            'name' => 'Create',
            'url' => '#',
        ],
    ];
@endphp

<x-admin-layout>
    <x-slot:header>
        <x-breadcrumbs :links="$breadcrumbs" />
    </x-slot:header>
    @livewire('admin.rates.create')
</x-admin-layout>
