@php
    $breadcrumbs = [
        [
            'name' => 'Discounts',
            'url' => route('admin.discounts'),
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
    @livewire('admin.discounts.create')
</x-admin-layout>
