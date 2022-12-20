@php
    $breadcrumbs = [
        [
            'name' => 'Room Types',
            'url' => route('admin.room-types'),
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
    @livewire('admin.room-types.create')
</x-admin-layout>
