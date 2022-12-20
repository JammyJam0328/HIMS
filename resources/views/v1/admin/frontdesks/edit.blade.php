@php
    $breadcrumbs = [
        [
            'name' => 'Front Desks',
            'url' => route('admin.floors'),
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
    @livewire('admin.frontdesks.edit', ['frontdesk' => $frontdesk])
</x-admin-layout>
