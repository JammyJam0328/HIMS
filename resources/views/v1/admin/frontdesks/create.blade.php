@php
    $breadcrumbs = [
        [
            'name' => 'Front Desks',
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
    @livewire('admin.frontdesks.create')
</x-admin-layout>
