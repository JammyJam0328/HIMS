@php
    $breadcrumbs = [
        [
            'name' => 'Guests',
            'url' => route('admin.guests'),
        ],
    ];
@endphp

<x-admin-layout>
    <x-slot:header>
        <x-breadcrumbs :links="$breadcrumbs" />
    </x-slot:header>
</x-admin-layout>
