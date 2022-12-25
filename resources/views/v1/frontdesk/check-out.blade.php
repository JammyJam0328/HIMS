@php
    $breadcrumbs = [
        [
            'name' => 'Check Out',
            'url' => '#',
        ],
    ];
@endphp

<x-frontdesk-layout>
    <x-slot:header>
        <x-breadcrumbs :links="$breadcrumbs" />
    </x-slot:header>
    @livewire('frontdesk.check-out.index')
</x-frontdesk-layout>
