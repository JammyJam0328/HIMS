<div x-data="{ showTransferForm: false }"
    x-on:close-form.window="showTransferForm=false">
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
                    <div x-show="!showTransferForm"
                        id="view"
                        class="grid w-full gap-5">
                        <div class="flex justify-end col-span-12">
                            <x-button.primary x-on:click="showTransferForm=true">
                                Transfer Room
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
                        x-show="showTransferForm">
                        {{-- form card --}}
                        <div x-data="{ excessAmountFromPreviousPayment: $wire.entangle('excessAmountFromPreviousPayment') }"
                            class="border rounded-lg bg-gray-50">
                            <form class="p-5">
                                @csrf

                                <div class="grid items-start grid-cols-2 gap-4">
                                    <div class="grid col-span-1 gap-4">
                                        <h1 class="mb-2 text-xl font-semibold text-gray-800 uppercase">
                                            Transfer Room
                                        </h1>
                                        <div class="grid gap-1">
                                            <x-input-label value="Type" />
                                            <x-select wire:model="newRoomTypeId">
                                                <option wire:key="qidjashduq82qdqw"
                                                    hidden
                                                    value="">
                                                    Select Type
                                                </option>
                                                @foreach ($types as $key => $type)
                                                    <option wire:key="{{ $key }}type"
                                                        value="{{ $type->id }}">
                                                        {{ $type->name }}
                                                    </option>
                                                @endforeach
                                            </x-select>
                                        </div>
                                        <div class="grid gap-1">
                                            <x-input-label value="Floor" />
                                            <x-select wire:model="newRoomFloorId">
                                                <option wire:key="eqnncajchewuhudi"
                                                    hidden
                                                    value="">
                                                    Select Floor
                                                </option>
                                                @foreach ($floors as $key => $floor)
                                                    <option wire:key="floor{{ $key }}"
                                                        value="{{ $floor->id }}">
                                                        {{ $floor->numberWithFormat() }}
                                                    </option>
                                                @endforeach
                                            </x-select>
                                        </div>
                                        <div class="grid gap-1">
                                            <x-input-label value="List Of Available Room" />
                                            <x-select wire:model.defer="newRoomId">
                                                <option wire:key="mmdajsihjdiashjdjaskh"
                                                    hidden
                                                    value="">
                                                    Select Room
                                                </option>
                                                @foreach ($rooms as $key => $room)
                                                    <option wire:key="{{ $key }}"
                                                        value="{{ $room->id }}">
                                                        {{ $room->numberWithFormat() }}
                                                    </option>
                                                @endforeach
                                            </x-select>
                                        </div>
                                        <div class="grid gap-1">
                                            <x-input-label value="Set status for previous room" />
                                            <x-select wire:model.defer="oldRoomStatus">
                                                <option hidden
                                                    value="">
                                                    Select Room
                                                </option>
                                                <option value="{{ \App\Models\Room::CLEANED }}">
                                                    Clean
                                                </option>
                                                <option value="{{ \App\Models\Room::UNCLEAN }}">
                                                    Unclean
                                                </option>
                                            </x-select>
                                        </div>

                                        <div class="grid gap-1">
                                            <x-input-label value="Reason" />
                                            <x-text-input wire:model.defer="transferReason"
                                                type="text"
                                                placeholder="Reason" />
                                        </div>
                                        <div class="grid gap-1">
                                            <x-input-label value="Enter ADMINISTRATOR CODE" />
                                            <x-text-input wire:model.defer="settingAdministratorCode"
                                                type="password"
                                                placeholder="Enter ADMINISTRATOR CODE" />
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
                                                        <dt>Old Room Amount</dt>
                                                        <dd class="text-gray-900">
                                                            &#8369;
                                                            {{ number_format($oldRoomAmount, 2) }}
                                                        </dd>
                                                    </div>

                                                    <div class="flex justify-between">
                                                        <dt>New Room Amount</dt>
                                                        <dd class="text-gray-900">
                                                            &#8369;
                                                            {{ number_format($newRoomAmount, 2) }}
                                                        </dd>
                                                    </div>
                                                    <div
                                                        class="flex items-center justify-between pt-6 text-gray-900 border-t border-gray-200">
                                                        <dt class="text-base">Total Amount To Pay</dt>
                                                        <dd class="text-base">
                                                            &#8369;
                                                            {{ number_format($totalAmountToPay, 2) }}
                                                        </dd>
                                                    </div>
                                                </dl>
                                                <div wire:key="saveTodepositdaqiwuednqcceq2eyq89uy"
                                                    x-cloak
                                                    x-show="excessAmountFromPreviousPayment > 0"
                                                    x-collapse>
                                                    <dl
                                                        class="pt-6 space-y-6 text-sm font-medium text-gray-500 border-t border-gray-200">
                                                        <div class="flex justify-between">
                                                            <dt class="font-semibold text-red-600 uppercase">
                                                                Excess Amount From Previous Payment
                                                            </dt>
                                                            <dd class="text-gray-900">
                                                                &#8369;
                                                                {{ number_format($excessAmountFromPreviousPayment, 2) }}
                                                            </dd>
                                                        </div>
                                                        <div class="flex justify-start space-x-4">
                                                            <dt class="text-red-600 uppercase">
                                                                Save To Deposit
                                                            </dt>
                                                            <dd class="text-gray-900">
                                                                <input wire:model.defer="saveToDeposit"
                                                                    id="saveTodeposit"
                                                                    aria-describedby="comments-description"
                                                                    name="saveTodeposit"
                                                                    type="checkbox"
                                                                    class="w-6 h-6 text-green-600 border-gray-300 rounded focus:ring-green-500">
                                                            </dd>
                                                        </div>
                                                    </dl>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="mt-5 flex justify-end space-x-3 rounded-b-lg border-t bg-white p-2.5">
                                <x-button.danger x-on:click="showTransferForm = false">Close Form</x-button.danger>
                                <x-button.primary x-on:click.prevent="$dispatch('confirm-transfer')">
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
    <x-confirm name="transfer"
        title="Confirm"
        message="Are you sure you want to transfer this guest?"
        onConfirm="transferRoom()" />
    @include('v1.partials.validation-errors')

</div>
