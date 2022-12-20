@php
    $breadcrumbs = [
        [
            'name' => 'Rates',
            'url' => route('admin.rates'),
        ],
    ];
@endphp

<x-admin-layout>
    <x-slot:header>
        <x-breadcrumbs :links="$breadcrumbs" />
    </x-slot:header>
    @livewire('admin.rates.index')
</x-admin-layout>
