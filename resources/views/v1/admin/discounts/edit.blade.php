@php
    $breadcrumbs = [
        [
            'name' => 'Discounts',
            'url' => route('admin.discounts'),
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
    @livewire('admin.discounts.edit', [
        'discount' => $discount,
    ])
</x-admin-layout>
