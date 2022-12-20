@php
    $breadcrumbs = [
        [
            'name' => 'Floors',
            'url' => route('admin.floors'),
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
    @livewire('admin.floors.create')
</x-admin-layout>
