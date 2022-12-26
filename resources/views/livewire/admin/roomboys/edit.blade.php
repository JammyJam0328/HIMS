<div class="flex justify-center max-w-4xl p-5 mx-auto border rounded-lg shadow-sm bg-gray-50">
    <form wire:submit.prevent="update"
        class="flex w-full">
        @csrf
        <div class="grid w-full space-y-3">
            <h1 class="text-xl font-semibold">
                Update Room Boy
            </h1>
            <div wire:key="user.name"
                class="grid w-full gap-2">
                <x-input-label for="name"
                    value="Name" />
                <div class="grid w-full">
                    <x-text-input wire:model.defer="user.name"
                        type="text"
                        id="name" />
                </div>
                @error('user.name')
                    <x-my-error>{{ $message }}</x-my-error>
                @enderror
            </div>
            <div wire:key="user.email"
                class="grid w-full gap-2">
                <x-input-label for="email"
                    value="Email" />
                <div class="grid w-full">
                    <x-text-input wire:model.defer="user.email"
                        type="email"
                        placeholder="e.g. johndoe@gmail.com"
                        id="email" />
                </div>
                @error('user.email')
                    <x-my-error>{{ $message }}</x-my-error>
                @enderror
            </div>
            <div wire:key="user.room_boy_assigned_floor_id"
                class="grid w-full gap-2">
                <x-input-label for="room_boy_assigned_floor_id"
                    value="Floor Designation" />
                <div class="grid w-full">
                    <x-select wire:model.defer="user.room_boy_assigned_floor_id"
                        class="uppercase"
                        id="room_boy_assigned_floor_id">
                        <option hidden
                            value="">
                            -SELECT-
                        </option>
                        @foreach ($floors as $floor)
                            <option value="{{ $floor->id }}">
                                <span class="uppercase"> {{ $floor->numberWithFormat() }} </span>
                            </option>
                        @endforeach
                    </x-select>
                </div>
                @error('user.room_boy_assigned_floor_id')
                    <x-my-error>{{ $message }}</x-my-error>
                @enderror
            </div>
            <div class="flex space-x-3">
                <x-button href="{{ route('admin.roomboys') }}">Return</x-button>
                <x-button.primary type="submit">Update</x-button.primary>
            </div>
        </div>
    </form>
</div>
