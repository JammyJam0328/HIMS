@php
    $breadcrumbs = [
        [
            'name' => 'Discounts',
            'url' => route('admin.discounts'),
        ],
    ];
@endphp

<x-admin-layout>
    <x-slot:header>
        <x-breadcrumbs :links="$breadcrumbs" />
    </x-slot:header>
    @livewire('admin.discounts.index')
</x-admin-layout>
