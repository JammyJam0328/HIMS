<div x-data="{
    paymentMethod: $wire.entangle('paymentMethod').defer,
    amountToPay: $wire.entangle('amountToPay').defer,
    givenAmount: $wire.entangle('givenAmount').defer,
    changeAmount: $wire.entangle('changeAmount').defer,
    changeSaveToDeposit: $wire.entangle('changeSaveToDeposit').defer
}"
    x-init="$watch('givenAmount', value => {
        changeAmount = givenAmount > amountToPay ? givenAmount - amountToPay : 0;
    })">
    <div class="grid w-full max-w-4xl p-5 mx-auto border rounded-lg shadow-sm bg-gray-50">
        <div class="flex justify-between">
            <h1 class="font-bold">
                PAY TRANSACTION
            </h1>
            <div>
                <span
                    class="rounded-lg border border-yellow-400 bg-yellow-100 px-3 py-1.5 font-semibold text-yellow-700">
                    REMAINING DEPOSIT : ₱ {{ $transaction->guest->total_deposits }}
                </span>
            </div>
        </div>
        <div class="grid w-full gap-4 mt-4">
            <dl class="w-full pt-6 space-y-6 font-medium text-gray-500 border-t border-gray-200">
                <div class="flex justify-start space-x-3">
                    <dt class="font-bold uppercase">Amount To Pay</dt>
                    <span>
                        :
                    </span>
                    <dd class="font-bold text-gray-900">
                        ₱ {{ $transaction->payable_amount }}
                    </dd>
                </div>
            </dl>
            <div class="flex space-x-5">
                <x-button.primary x-on:click="paymentMethod ='CASH'">
                    <span> Pay with Cash</span>
                    <svg x-show="paymentMethod=='CASH'"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="currentColor"
                        class="w-5 h-5 ml-3">
                        <path fill-rule="evenodd"
                            d="M8.603 3.799A4.49 4.49 0 0112 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 013.498 1.307 4.491 4.491 0 011.307 3.497A4.49 4.49 0 0121.75 12a4.49 4.49 0 01-1.549 3.397 4.491 4.491 0 01-1.307 3.497 4.491 4.491 0 01-3.497 1.307A4.49 4.49 0 0112 21.75a4.49 4.49 0 01-3.397-1.549 4.49 4.49 0 01-3.498-1.306 4.491 4.491 0 01-1.307-3.498A4.49 4.49 0 012.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 011.307-3.497 4.49 4.49 0 013.497-1.307zm7.007 6.387a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                            clip-rule="evenodd" />
                    </svg>
                </x-button.primary>
                <x-button.warning x-on:click="paymentMethod = 'DEPOSIT'">
                    <span> Pay with Deposit</span>
                    <svg x-show="paymentMethod=='DEPOSIT'"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="currentColor"
                        class="w-5 h-5 ml-3">
                        <path fill-rule="evenodd"
                            d="M8.603 3.799A4.49 4.49 0 0112 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 013.498 1.307 4.491 4.491 0 011.307 3.497A4.49 4.49 0 0121.75 12a4.49 4.49 0 01-1.549 3.397 4.491 4.491 0 01-1.307 3.497 4.491 4.491 0 01-3.497 1.307A4.49 4.49 0 0112 21.75a4.49 4.49 0 01-3.397-1.549 4.49 4.49 0 01-3.498-1.306 4.491 4.491 0 01-1.307-3.498A4.49 4.49 0 012.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 011.307-3.497 4.49 4.49 0 013.497-1.307zm7.007 6.387a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                            clip-rule="evenodd" />
                    </svg>
                </x-button.warning>
            </div>
        </div>

        <div id="cashPayment"
            x-show="paymentMethod == 'CASH'"
            class="p-4 mt-4 bg-green-100 border border-green-300 rounded-lg">
            <div class="grid gap-4">
                <div class="grid gap-1">
                    <x-input-label for="given_amount"
                        value="Givent Amount" />
                    <x-text-input type="text"
                        x-model="givenAmount" />
                </div>
                <div x-cloak
                    x-show="changeAmount > 0"
                    class="grid gap-1"
                    x-collapse>
                    <x-input-label for="change"
                        value="Change" />
                    <x-text-input type="text"
                        x-model="changeAmount" />
                </div>
                <div x-cloak
                    x-show="changeAmount > 0"
                    class="grid gap-1"
                    x-collapse>
                    <x-input-label for="changeSaveToDeposit"
                        value="Save to Deposit" />
                    <input id="changeSaveToDeposit"
                        x-model="changeSaveToDeposit"
                        aria-describedby="comments-description"
                        name="changeSaveToDeposit"
                        type="checkbox"
                        class="w-6 h-6 text-green-600 border-gray-300 rounded focus:ring-green-500">
                </div>
            </div>
            <div class="flex mt-4 space-x-3">
                <x-button href="{{ $referrerLink }}">
                    Cancel
                </x-button>
                <x-button.primary x-on:click="$dispatch('confirm-pay-with-cash')">
                    Save Payment
                </x-button.primary>
            </div>
        </div>
        <div id="depositPayment"
            x-cloak
            x-show="paymentMethod == 'DEPOSIT'"
            class="p-4 mt-4 bg-yellow-100 border border-yellow-300 rounded-lg">
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quaerat, nulla similique. Dolorum sapiente
            suscipit rerum? Facilis, nostrum magnam molestiae ratione sapiente corporis eius similique id corrupti
            expedita mollitia dignissimos! Est.
        </div>
    </div>

    <x-confirm name="pay-with-cash"
        title="Confirm"
        message="Are you sure you want to pay with cash?"
        onConfirm="payWithCash()" />
</div>
