<div class="mx-auto flex max-w-4xl justify-center rounded-lg border bg-gray-50 p-5 shadow-sm">
    <form wire:submit.prevent="update"
        class="flex w-full">
        @csrf
        <div class="grid w-full space-y-3">
            <h1 class="text-xl font-semibold">
                Edit Room
            </h1>
            <div wire:key="room.number"
                class="grid w-full gap-2">
                <x-input-label for="id"
                    value="Room Number" />
                <div class="grid w-full">
                    <x-text-input wire:model.defer="room.number"
                        type="text"
                        id="number" />
                </div>
                @error('room.number')
                    <x-error>{{ $message }}</x-error>
                @enderror
            </div>

            <div wire:key="room.floor_id"
                class="grid w-full gap-2">
                <x-input-label for="floor"
                    value="Floor" />
                <div class="grid w-full">
                    <x-select wire:model.defer="room.floor_id"
                        class="uppercase"
                        id="floor">
                        <option hidden
                            value="">
                            -SELECT-
                        </option>
                        @foreach ($statuses as $key => $status)
                            <option value="{{ $key }}"
                                @selected($room['status'] == $key)>
                                <span class="uppercase"> {{ str_replace('_', ' ', $status) }}</span>
                            </option>
                        @endforeach
                    </x-select>
                </div>
                @error('room.floor_id')
                    <x-error>{{ $message }}</x-error>
                @enderror
            </div>

            <div wire:key="room.status"
                class="grid w-full gap-2">
                <x-input-label for="status"
                    value="Status" />
                <div class="grid w-full">
                    <x-select wire:model.defer="room.status"
                        class="uppercase"
                        id="status">
                        <option hidden
                            value="">
                            -SELECT-
                        </option>
                        @foreach ($statuses as $status)
                            <option value="{{ $status }}"
                                @selected($room['status'] == $status)>
                                <span class="uppercase"> {{ str_replace('_', ' ', $status) }}</span>
                            </option>
                        @endforeach
                    </x-select>
                </div>
                @error('room.status')
                    <x-error>{{ $message }}</x-error>
                @enderror
            </div>

            <div wire:key="room.type_id"
                class="grid w-full gap-2">
                <x-input-label for="type"
                    value="Type" />
                <div class="grid w-full">
                    <x-select wire:model.defer="room.type_id"
                        class="uppercase"
                        id="type">
                        <option hidden
                            value="">
                            -SELECT-
                        </option>
                        @foreach ($roomTypes as $roomType)
                            <option value="{{ $roomType->id }}"
                                @selected($room['type_id'] == $roomType->id)>
                                <span class="uppercase"> {{ $roomType->name }}</span>
                            </option>
                        @endforeach
                    </x-select>
                </div>
                @error('room.type_id')
                    <x-error>{{ $message }}</x-error>
                @enderror
            </div>

            <div class="flex space-x-3">
                <x-button href="{{ route('admin.rooms') }}">Return</x-button>
                <x-button.primary type="submit">Update</x-button.primary>
            </div>
        </div>
    </form>
</div>
