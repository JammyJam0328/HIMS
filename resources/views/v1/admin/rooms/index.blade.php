@php
    $breadcrumbs = [
        [
            'name' => 'Rooms',
            'url' => route('admin.rooms'),
        ],
    ];
@endphp

<x-admin-layout>
    <x-slot:header>
        <x-breadcrumbs :links="$breadcrumbs" />
    </x-slot:header>
    @livewire('admin.rooms.index')
</x-admin-layout>
