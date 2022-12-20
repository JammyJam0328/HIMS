@php
    $breadcrumbs = [
        [
            'name' => 'Amenities',
            'url' => route('admin.amenities'),
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
    @livewire('admin.amenities.create')
</x-admin-layout>
