@php
    $breadcrumbs = [
        [
            'name' => 'Hotel Assets',
            'url' => route('admin.assets'),
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
    @livewire('admin.assets.create')
</x-admin-layout>
