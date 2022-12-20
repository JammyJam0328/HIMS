@php
    $breadcrumbs = [
        [
            'name' => 'Extension Rates',
            'url' => route('admin.extension-rates'),
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
    @livewire('admin.extension-rates.edit', [
        'extensionRate' => $extensionRate,
    ])
</x-admin-layout>
