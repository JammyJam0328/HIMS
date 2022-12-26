<div class="mx-auto flex max-w-4xl justify-center rounded-lg border bg-gray-50 p-5 shadow-sm">
    <form wire:submit.prevent="update"
        class="grid w-full">
        @csrf
        <div class="grid w-full space-y-3">
            <h1 class="text-xl font-semibold">
                Edit Discount
            </h1>
            <div wire:key="discount.name"
                class="grid w-full gap-2">
                <x-input-label for="name"
                    value="Name" />
                <div class="grid w-full">
                    <x-text-input wire:model.defer="discount.name"
                        type="text"
                        name="number" />
                </div>
                @error('asdiscountset.name')
                    <x-my-error>{{ $message }}</x-my-error>
                @enderror
            </div>
            <div wire:key="discount.amount"
                class="grid w-full gap-2">
                <x-input-label for="amount"
                    value="Amount" />
                <div class="grid w-full">
                    <x-text-input wire:model.defer="discount.amount"
                        type="number"
                        name="amount" />
                </div>
                @error('discount.amount')
                    <x-my-error>{{ $message }}</x-my-error>
                @enderror
            </div>
            <div wire:key="discount.is_percentage"
                class="grid w-full gap-2">
                <x-input-label for="type"
                    value="Type" />
                <div class="grid w-full">
                    <x-select wire:model.defer="discount.is_percentage"
                        name="type">
                        <option value="0">Amount</option>
                        <option value="1">Percentage</option>
                    </x-select>
                </div>
                @error('discount.is_percentage')
                    <x-my-error>{{ $message }}</x-my-error>
                @enderror
            </div>
            <div wire:key="discount.is_available"
                class="grid w-full gap-2">
                <x-input-label for="status"
                    value="Set as" />
                <div class="grid w-full">
                    <x-select wire:model.defer="discount.is_available"
                        name="status">
                        <option value="1">Available</option>
                        <option value="0">Unavailable</option>
                    </x-select>
                </div>
                @error('discount.is_available')
                    <x-my-error>{{ $message }}</x-my-error>
                @enderror
            </div>
        </div>
        <div class="mt-5 flex space-x-3">
            <x-button href="{{ route('admin.discounts') }}">Return</x-button>
            <x-button.primary type="submit">Update</x-button.primary>
        </div>
    </form>
</div>
