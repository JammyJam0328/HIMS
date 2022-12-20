@php
    $breadcrumbs = [
        [
            'name' => 'Extension Rates',
            'url' => route('admin.extension-rates'),
        ],
    ];
@endphp

<x-admin-layout>
    <x-slot:header>
        <x-breadcrumbs :links="$breadcrumbs" />
    </x-slot:header>
    @livewire('admin.extension-rates.index')
</x-admin-layout>
