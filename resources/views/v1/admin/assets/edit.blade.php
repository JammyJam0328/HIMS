@php
    $breadcrumbs = [
        [
            'name' => 'Hotel Assets',
            'url' => route('admin.assets'),
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
    @livewire('admin.assets.edit', [
        'asset' => $asset,
    ])
</x-admin-layout>
