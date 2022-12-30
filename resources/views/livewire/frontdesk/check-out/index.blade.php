<div>
    <x-content>
        <x-table.head-actions>
            <x-slot:left>
                <x-text-input wire:model.defer="search"
                    type="search"
                    placeholder="Search" />
                <x-select wire:model.defer="searchBy">
                    <option value="QRCODE">
                        QR CODE
                    </option>
                    <option value="ROOM_NUMBER">
                        ROOM NUMBER
                    </option>
                </x-select>
                <x-button.primary wire:click="search">
                    Search
                </x-button.primary>
            </x-slot:left>
        </x-table.head-actions>
        <div wire:key="guest">
            @if ($guest)
                <div class="flex justify-end mb-3 space-x-3">
                    <x-button.danger wire:click="validateCheckOut">Check Out</x-button.danger>
                </div>
                <div id="view"
                    class="grid grid-cols-12 gap-5">

                    <div wire:key="transactions"
                        class="col-span-9">
                        <x-table>
                            <x-slot:header>
                                <x-table.head>
                                    DESCRIPTION
                                </x-table.head>
                                <x-table.head>
                                    AMOUNT
                                </x-table.head>
                                <x-table.head>
                                    PAID AT
                                </x-table.head>
                                <x-table.head>
                                    TRANSACTION BY
                                </x-table.head>
                            </x-slot:header>
                            @foreach ($groupedTransactions as $type => $transactions)
                                <x-table.row>
                                    <x-table.cell colspan="4"
                                        class="px-6 py-3 text-sm font-medium text-center text-gray-900 uppercase bg-gray-100">
                                        {{ \App\Models\Transaction::TYPES[$type] }}
                                    </x-table.cell>
                                </x-table.row>
                                @foreach ($transactions as $transaction)
                                    <x-table.row>
                                        <x-table.cell>
                                            {{ $transaction->description }}
                                        </x-table.cell>
                                        <x-table.cell>
                                            {{ $transaction->payable_amount }}
                                        </x-table.cell>
                                        <x-table.cell>
                                            @if ($transaction->paid_at)
                                                {{ \Carbon\Carbon::parse($transaction->paid_at)->format('M d, Y h:i A') }}
                                            @else
                                                <x-button.pay-transaction :transactionId="$transaction->id" />
                                            @endif
                                        </x-table.cell>
                                        <x-table.cell>
                                            @foreach ($transaction->frontdesks() as $frontdesk)
                                                {{ $frontdesk->name }}
                                                @if (!$loop->last)
                                                    <span class="text-red-600"> &</span>
                                                @endif
                                            @endforeach
                                        </x-table.cell>
                                    </x-table.row>
                                @endforeach
                            @endforeach
                        </x-table>
                    </div>
                    <div wire:key="info"
                        class="col-span-3">
                        <div class="p-4 border-2 border-green-600 rounded-lg shadow-sm bg-gray-50">
                            <div>
                                <h3 class="text-lg font-medium leading-6 text-gray-900">
                                    Guest Information
                                </h3>
                                <p class="max-w-2xl mt-1 text-sm text-gray-500">
                                    Personal details and check in information
                                </p>
                            </div>
                            <div class="mt-5 border-t border-gray-200">
                                <dl class="sm:divide-y sm:divide-gray-200">
                                    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Name
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                            {{ $guest->name }}
                                        </dd>
                                    </div>
                                    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Contact #
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                            {{ $guest->contact_number }}
                                        </dd>
                                    </div>
                                    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5">
                                        <dt class="text-sm font-medium text-gray-500">ROOM</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                            ROOM # {{ $guest->room_number }} | {{ $guest->floor->numberWithFormat() }}
                                        </dd>
                                    </div>
                                    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Type
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                            {{ $guest->roomType->name }}
                                        </dd>
                                    </div>
                                    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Time In
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                            {{ \Carbon\Carbon::parse($guest->checked_in_at)->format('M d, Y h:i A') }}
                                        </dd>
                                    </div>
                                    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Remaining
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                            @php
                                                $expires = \Carbon\Carbon::parse($guest->expected_checkout_at);
                                            @endphp
                                            <x-countdown :expires="$expires"
                                                class="text-xl font-semibold text-red-600" />
                                        </dd>
                                    </div>
                                    <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Deposit
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                            ₱ {{ $guest->total_deposits }}
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </x-content>
    @if ($guest)
        <div x-data="{ step: $wire.entangle('guestCheckOutStep') }">
            <x-check-out-confirmation title="STEP 1"
                showId="1"
                message="Hand over by the guest/room boy the key and remote"
                confirmMessage="Yes"
                cancelMessage="No"
                confirmMethod="$wire.claimableDepositHandler()"
                cancelMethod="$wire.unclaimableDepositHandler()" />
            <x-check-out-confirmation title="STEP 2"
                showId="2"
                message="Check room by the body"
                confirmMessage="Yes"
                cancelMessage="No"
                confirmMethod="$wire.recordDamage()"
                cancelMethod="$wire.noDamage()" />
            <x-check-out-confirmation title="STEP 3"
                showId="3"
                message="DEPOSIT BALANCE: ₱ {{ $guest->total_deposits }}"
                confirmMessage="Claim and Check Out"
                cancelMessage="No"
                confirmMethod="$wire.claimedDeposit()"
                hideCancel="yes" />
        </div>
    @endif
</div>
