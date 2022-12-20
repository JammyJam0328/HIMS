@php
    $breadcrumbs = [
        [
            'name' => 'Front Desks',
            'url' => route('admin.frontdesks'),
        ],
    ];
@endphp

<x-admin-layout>
    <x-slot:header>
        <x-breadcrumbs :links="$breadcrumbs" />
    </x-slot:header>
    @livewire('admin.frontdesks.index')
</x-admin-layout>
