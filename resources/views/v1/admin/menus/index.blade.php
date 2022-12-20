@php
    $breadcrumbs = [
        [
            'name' => '',
            'url' => route('admin.guests'),
        ],
    ];
@endphp

<x-admin-layout>
    <x-slot:header>
        <x-breadcrumbs :links="$breadcrumbs" />
    </x-slot:header>
</x-admin-layout>
