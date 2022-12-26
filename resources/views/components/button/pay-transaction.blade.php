@props(['type' => 'button', 'transactionId' => null])

<a type="{{ $type }}"
    href="{{ route('frontdesk.pay-transactions', [
        'transaction' => $transactionId,
    ]) }}"
    wire:loading.attr="disabled"
    {{ $attributes->merge(['class' => 'inline-flex items-center px-4 py-1 text-sm font-medium text-white bg-green-500 border border-transparent rounded-lg shadow-sm order-0 hover:bg-green-600 focus:outline-none ']) }}>
    Pay
</a>
