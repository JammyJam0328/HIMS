@php
    $breadcrumbs = [
        [
            'name' => 'Employees',
            'url' => route('admin.employees'),
        ],
    ];
@endphp

<x-admin-layout>
    <x-slot:header>
        <x-breadcrumbs :links="$breadcrumbs" />
    </x-slot:header>
</x-admin-layout>
