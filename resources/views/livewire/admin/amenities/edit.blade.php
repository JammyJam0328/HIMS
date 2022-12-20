<div class="mx-auto flex max-w-4xl justify-center rounded-lg border bg-gray-50 p-5 shadow-sm">
    <form wire:submit.prevent="update"
        class="flex w-full">
        @csrf
        <div class="grid w-full space-y-3">
            <h1 class="text-xl font-semibold">
                Edit Amenity
            </h1>
            <div wire:key="amenity.name"
                class="grid w-full gap-2">
                <x-input-label for="name"
                    value="Name" />
                <div class="grid w-full">
                    <x-text-input wire:model.defer="amenity.name"
                        type="text"
                        name="number" />
                </div>
                @error('amenity.name')
                    <x-error>{{ $message }}</x-error>
                @enderror
            </div>
            <div wire:key="amenity.amount"
                class="grid w-full gap-2">
                <x-input-label for="amount"
                    value="Amount" />
                <div class="grid w-full">
                    <x-text-input wire:model.defer="amenity.amount"
                        type="number"
                        name="amount" />
                </div>
                @error('amenity.amount')
                    <x-error>{{ $message }}</x-error>
                @enderror
            </div>
            <div class="flex space-x-3">
                <x-button href="{{ route('admin.amenities') }}">Return</x-button>
                <x-button.primary type="submit">Update</x-button.primary>
            </div>
        </div>
    </form>
</div>
