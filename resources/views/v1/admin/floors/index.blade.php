@php
    $breadcrumbs = [
        [
            'name' => 'Floors',
            'url' => route('admin.floors'),
        ],
    ];
@endphp

<x-admin-layout>
    <x-slot:header>
        <x-breadcrumbs :links="$breadcrumbs" />
    </x-slot:header>
    @livewire('admin.floors.index')
</x-admin-layout>
