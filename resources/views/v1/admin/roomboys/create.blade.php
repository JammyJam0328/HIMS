@php
    $breadcrumbs = [
        [
            'name' => 'Roomboys',
            'url' => '#',
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
    @livewire('admin.roomboys.create')
</x-admin-layout>
