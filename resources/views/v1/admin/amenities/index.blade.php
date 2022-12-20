@php
    $breadcrumbs = [
        [
            'name' => 'Amenities',
            'url' => route('admin.amenities'),
        ],
    ];
@endphp

<x-admin-layout>
    <x-slot:header>
        <x-breadcrumbs :links="$breadcrumbs" />
    </x-slot:header>
    @livewire('admin.amenities.index')
</x-admin-layout>
