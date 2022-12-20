<div x-data="{ totalAmountToPay: $wire.entangle('totalAmountToPay').defer, changeAmount: $wire.entangle('changeAmount').defer, givenAmount: $wire.entangle('givenAmount').defer }"
    x-init="$watch('givenAmount', value => {
        changeAmount = givenAmount > totalAmountToPay ? givenAmount - totalAmountToPay : 0;
    })"
    class="grid max-w-4xl gap-5 p-5 mx-auto border rounded-lg shadow-sm bg-gray-50">
    <div class="overflow-hidden bg-blue-100 sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Guest Check In Information</h3>
        </div>
        <div class="px-4 py-5 border-t border-blue-200 sm:p-0">
            <dl class="sm:divide-y sm:divide-blue-200">
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-3 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Name</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                        {{ $guest->name }}
                    </dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-3 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Contact Number</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                        {{ $guest->contact_number }}
                    </dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-3 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Stay Duration
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                        @if ($guest->is_long_stay)
                            {{ $guest->long_stay_number_of_days . ' ' . Str::plural('day', $guest->long_stay_number_of_days) }}
                        @else
                            {{ $guest->staying_hours . ' ' . Str::plural('hr', $guest->staying_hours) }}
                        @endif
                    </dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-3 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        ROOM & FLOOR #
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                        Room # {{ $guest->room_number }} | {{ $guest->floor->numberWithFormat() }}
                    </dd>
                </div>
            </dl>
        </div>
    </div>

    {{-- payment --}}
    <div class="overflow-hidden bg-green-100 sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">
                Payment
            </h3>
        </div>
        <div class="px-4 py-5 border-t border-green-200 sm:p-0">
            <dl class="sm:divide-y sm:divide-green-200">
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-3 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Room Amount
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                        ₱ {{ $guest->check_in_amount }}
                    </dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-3 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        INITIAL DEPOSIT for ROOM KEY & TV REMOTE
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                        ₱ 200
                    </dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-3 sm:px-6">
                    <dt class="text-sm font-bold text-gray-700">
                        TOTAL AMOUNT
                    </dt>
                    <dd class="mt-1 text-sm font-bold text-gray-900 sm:col-span-2 sm:mt-0">
                        ₱ {{ $totalAmountToPay }}
                    </dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-3 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        GIVEN AMOUNT
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                        <x-text-input type="number"
                            name="given_amount"
                            x-model="givenAmount" />
                    </dd>
                </div>
                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-3 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        CHANGE
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                        <x-text-input type="number"
                            name="given_amount"
                            x-model="changeAmount" />
                    </dd>
                </div>
            </dl>
        </div>
    </div>
</div>
