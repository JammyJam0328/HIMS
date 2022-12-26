@php
    $breadcrumbs = [
        [
            'name' => 'Roomboys',
            'url' => '#',
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
    @livewire('admin.roomboys.edit', [
        'roomboy' => $roomboy,
    ])
</x-admin-layout>
