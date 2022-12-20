@php
    $breadcrumbs = [
        [
            'name' => 'Floors',
            'url' => route('admin.floors'),
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
    @livewire('admin.floors.edit', ['floor' => $floor])
</x-admin-layout>
