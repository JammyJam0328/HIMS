@php
    $breadcrumbs = [
        [
            'name' => 'Rooms',
            'url' => route('admin.rooms'),
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
    @livewire('admin.rooms.edit', ['room' => $room])
</x-admin-layout>
