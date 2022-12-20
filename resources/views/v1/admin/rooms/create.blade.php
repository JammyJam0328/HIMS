@php
    $breadcrumbs = [
        [
            'name' => 'Rooms',
            'url' => route('admin.rooms'),
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
    @livewire('admin.rooms.create')
</x-admin-layout>
