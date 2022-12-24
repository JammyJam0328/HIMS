@php
    $breadcrumbs = [
        [
            'name' => 'Return ',
            'url' => request()->headers->get('referer'),
        ],
    ];
@endphp

<x-frontdesk-layout>
    <x-slot:header>
        <x-breadcrumbs :links="$breadcrumbs" />
    </x-slot:header>
    @livewire('frontdesk.pay-transactions', [
        'transaction' => $transaction,
        'referrerLink' => request()->headers->get('referer'),
    ])
</x-frontdesk-layout>
