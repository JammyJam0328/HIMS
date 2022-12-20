@php
    $breadcrumbs = [
        [
            'name' => 'Hotel Assets',
            'url' => route('admin.assets'),
        ],
    ];
@endphp

<x-admin-layout>
    <x-slot:header>
        <x-breadcrumbs :links="$breadcrumbs" />
    </x-slot:header>
    @livewire('admin.assets.index')
</x-admin-layout>
