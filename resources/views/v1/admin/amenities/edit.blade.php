@php
    $breadcrumbs = [
        [
            'name' => 'Amenities',
            'url' => route('admin.amenities'),
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
    @livewire('admin.amenities.edit', [
        'amenity' => $amenity,
    ])
</x-admin-layout>
