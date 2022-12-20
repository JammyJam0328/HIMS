<div class="flex justify-center max-w-4xl p-5 mx-auto border rounded-lg shadow-sm bg-gray-50">
    <form wire:submit.prevent="store"
        class="flex w-full">
        @csrf
        <div class="grid w-full space-y-3">
            <h1 class="text-xl font-semibold">
                Create Floor
            </h1>
            <div class="grid w-full gap-2">
                <x-input-label for="name"
                    value="Floor Number" />
                <div class="grid w-full">
                    <x-text-input wire:model.defer="floor.number"
                        type="text"
                        name="number" />
                </div>
                @error('floor.number')
                    <x-error>{{ $message }}</x-error>
                @enderror
            </div>
            <div class="flex space-x-3">
                <x-button href="{{ route('admin.floors') }}">Return</x-button>
                <x-button.primary type="submit">Save</x-button.primary>
            </div>
        </div>
    </form>
</div>
