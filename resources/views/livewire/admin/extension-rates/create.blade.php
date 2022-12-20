<div class="flex justify-center max-w-4xl p-5 mx-auto border rounded-lg shadow-sm bg-gray-50">
    <form wire:submit.prevent="store"
        class="grid w-full">
        @csrf
        <div class="grid w-full space-y-3">
            <h1 class="text-xl font-semibold">
                Create Extension Rate
            </h1>
            <div wire:key="extensionRate.hour"
                class="grid w-full gap-2">
                <x-input-label for="hour"
                    value="Hours" />
                <div class="grid w-full">
                    <x-text-input wire:model.defer="extensionRate.hour"
                        type="text"
                        name="number" />
                </div>
                @error('extensionRate.hour')
                    <x-error>{{ $message }}</x-error>
                @enderror
            </div>
            <div wire:key="extensionRate.amount"
                class="grid w-full gap-2">
                <x-input-label for="amount"
                    value="Amount" />
                <div class="grid w-full">
                    <x-text-input wire:model.defer="extensionRate.amount"
                        type="number"
                        name="amount" />
                </div>
                @error('extensionRate.amount')
                    <x-error>{{ $message }}</x-error>
                @enderror
            </div>
        </div>
        <div class="flex mt-5 space-x-3">
            <x-button href="{{ route('admin.extension-rates') }}">Return</x-button>
            <x-button.primary type="submit">Save</x-button.primary>
        </div>
    </form>
</div>
