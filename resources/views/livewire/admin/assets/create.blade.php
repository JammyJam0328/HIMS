<div class="mx-auto flex max-w-4xl justify-center rounded-lg border bg-gray-50 p-5 shadow-sm">
    <form wire:submit.prevent="store"
        class="flex w-full">
        @csrf
        <div class="grid w-full space-y-3">
            <h1 class="text-xl font-semibold">
                Create Hotel Asset
            </h1>
            <div wire:key="asset.name"
                class="grid w-full gap-2">
                <x-input-label for="name"
                    value="Name" />
                <div class="grid w-full">
                    <x-text-input wire:model.defer="asset.name"
                        type="text"
                        name="number" />
                </div>
                @error('asset.name')
                    <x-error>{{ $message }}</x-error>
                @enderror
            </div>
            <div wire:key="asset.amount"
                class="grid w-full gap-2">
                <x-input-label for="amount"
                    value="Amount" />
                <div class="grid w-full">
                    <x-text-input wire:model.defer="asset.amount"
                        type="number"
                        name="amount" />
                </div>
                @error('asset.amount')
                    <x-error>{{ $message }}</x-error>
                @enderror
            </div>
            <div class="flex space-x-3">
                <x-button href="{{ route('admin.amenities') }}">Return</x-button>
                <x-button.primary type="submit">Save</x-button.primary>
            </div>
        </div>
    </form>
</div>
