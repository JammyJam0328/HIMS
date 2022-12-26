@php
    $breadcrumbs = [
        [
            'name' => 'Roomboys',
            'url' => '#',
        ],
    ];
@endphp

<x-admin-layout>
    <x-slot:header>
        <x-breadcrumbs :links="$breadcrumbs" />
    </x-slot:header>
    @livewire('admin.roomboys.index')
</x-admin-layout>
