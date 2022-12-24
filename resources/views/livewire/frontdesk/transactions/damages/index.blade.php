<div x-data="{ showDamageForm: false }"
    x-on:close-form.window="showDamageForm=false">
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
        <div wire:key="actions">
            @includeWhen($guest, 'v1.frontdesk.transactions.partials.tabs')
        </div>
        <div wire:key="guest">
            @if ($guest)
                <div id="9091873ashdjashduiy128372891">
                    <div x-show="!showDamageForm"
                        id="view"
                        class="grid w-full gap-5">
                        <div class="flex justify-end col-span-12">
                            <x-button.primary x-on:click="showDamageForm=true">
                                Add Damages
                            </x-button.primary>
                        </div>
                        <div wire:key="transactions"
                            class="col-span-12">
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
                                @forelse ($transactions as $transaction)
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
                                @empty
                                    <x-table.row>
                                        <x-table.cell colspan="4">
                                            <div class="flex items-center justify-center">
                                                <span class="text-gray-400">
                                                    No transactions found.
                                                </span>
                                            </div>
                                        </x-table.cell>
                                    </x-table.row>
                                @endforelse
                            </x-table>
                        </div>
                    </div>
                    <div x-cloak
                        x-show="showDamageForm">
                        {{-- form card --}}
                        <div x-data="{ excessAmountFromPreviousPayment: $wire.entangle('excessAmountFromPreviousPayment') }"
                            class="border rounded-lg bg-gray-50">
                            <form class="p-5">
                                @csrf

                                <div class="grid items-start grid-cols-2 gap-4">
                                    <div class="grid col-span-1 gap-4">
                                        <h1 class="mb-2 text-xl font-semibold text-gray-800 uppercase">
                                            Request Form
                                        </h1>
                                        <div class="grid gap-1">
                                            <x-input-label value="Select Assets" />
                                            <x-select wire:model="assetId">
                                                <option wire:key="qidjashduq82qdqw"
                                                    hidden
                                                    value="">
                                                    Select Type
                                                </option>
                                                @foreach ($assets as $key => $asset)
                                                    <option value="{{ $asset->id }}">
                                                        {{ $asset->name }}
                                                    </option>
                                                @endforeach
                                            </x-select>
                                        </div>
                                        <div class="grid gap-1">
                                            <x-input-label value="Additinal Amount"
                                                for="additional_amount" />
                                            <x-text-input id="additional_amount"
                                                wire:model.debounce.500ms="additionalAmount"
                                                type="number"
                                                placeholder="Leave it blank if not applicable" />
                                        </div>
                                    </div>
                                    <div class="grid h-full col-span-1 gap-4">
                                        <div class="h-full p-3 bg-white border rounded-lg shadow">
                                            <h1 class="mb-2 text-xl font-semibold text-gray-800 uppercase">
                                                Payment Summary
                                            </h1>
                                            <div class="grid gap-5">
                                                <dl
                                                    class="pt-6 space-y-6 text-sm font-medium text-gray-500 border-t border-gray-200">
                                                    <div class="flex justify-between">
                                                        <dt>Amenity Amount</dt>
                                                        <dd class="text-gray-900">
                                                            &#8369;
                                                            {{ $assetAmount }}
                                                        </dd>
                                                    </div>
                                                    <div class="flex justify-between">
                                                        <dt>
                                                            Additional Amount (optional)
                                                        </dt>
                                                        <dd class="text-gray-900">
                                                            &#8369;
                                                            {{ $additionalAmount }}
                                                        </dd>
                                                    </div>
                                                    <div
                                                        class="flex items-center justify-between pt-6 text-gray-900 border-t border-gray-200">
                                                        <dt class="text-base">Total Amount To Pay</dt>
                                                        <dd class="text-base">
                                                            &#8369;
                                                            {{ $totalAmountToPay }}
                                                        </dd>
                                                    </div>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="mt-5 flex justify-end space-x-3 rounded-b-lg border-t bg-white p-2.5">
                                <x-button.danger x-on:click="showDamageForm = false">Close Form</x-button.danger>
                                <x-button.primary x-on:click.prevent="$dispatch('confirm-damage')">
                                    Save
                                </x-button.primary>
                            </div>
                        </div>
                        {{-- form card --}}
                    </div>
                </div>
            @endif
        </div>
    </x-content>
    <x-confirm name="damage"
        title="Confirm"
        message="Are you sure you want to save this request?"
        onConfirm="saveDamage()" />
</div>
