<div class="mx-auto flex max-w-4xl justify-center rounded-lg border bg-gray-50 p-5 shadow-sm">
    <form wire:submit.prevent="update"
        class="flex w-full">
        @csrf
        <div class="grid w-full space-y-3">
            <h1 class="text-xl font-semibold">
                Edit Room Type
            </h1>
            <div class="grid w-full gap-2">
                <x-input-label for="name"
                    value="Name" />
                <div class="grid w-full">
                    <x-text-input wire:model.defer="type.name"
                        type="text"
                        id="name" />
                </div>
                @error('type.name')
                    <x-error>{{ $message }}</x-error>
                @enderror
            </div>
            <div class="flex space-x-3">
                <x-button href="{{ route('admin.room-types') }}">Return</x-button>
                <x-button.primary type="submit">Update</x-button.primary>
            </div>
        </div>
    </form>
</div>
