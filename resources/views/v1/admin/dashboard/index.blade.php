@php
    $breadcrumbs = [
        [
            'name' => 'Dashboard',
            'url' => '#',
        ],
    ];
@endphp

<x-admin-layout>
    <x-slot:header>
        <x-breadcrumbs :links="$breadcrumbs" />
    </x-slot:header>
</x-admin-layout>
