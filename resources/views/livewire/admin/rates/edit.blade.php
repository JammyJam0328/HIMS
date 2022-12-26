<div class="mx-auto flex max-w-4xl justify-center rounded-lg border bg-gray-50 p-5 shadow-sm">
    <form wire:submit.prevent="update"
        class="flex w-full">
        @csrf
        <div class="grid w-full space-y-3">
            <h1 class="text-xl font-semibold">
                Edit Rates
            </h1>
            <div wire:key="rate.staying_hour_id"
                class="grid w-full gap-2">
                <x-input-label for="hours"
                    value="No. of hours" />
                <div class="grid w-full">
                    <x-select wire:model.defer="rate.staying_hour_id"
                        class="uppercase"
                        id="hours">
                        <option hidden
                            value="">
                            -SELECT-
                        </option>
                        @foreach ($stayingHours as $stayingHour)
                            <option value="{{ $stayingHour->id }}"
                                @selected($rate['staying_hour_id'] == $stayingHour->id)>
                                <span class="uppercase"> {{ $stayingHour->hoursWithFormat() }} </span>
                            </option>
                        @endforeach
                    </x-select>
                </div>
                @error('rate.staying_hour_id')
                    <x-my-error>{{ $message }}</x-my-error>
                @enderror
            </div>
            <div wire:key="rate.type_id"
                class="grid w-full gap-2">
                <x-input-label for="type"
                    value="Type" />
                <div class="grid w-full">
                    <x-select wire:model.defer="rate.type_id"
                        class="uppercase"
                        id="type">
                        <option hidden
                            value="">
                            -SELECT-
                        </option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}"
                                @selected($rate['type_id'] == $type->id)>
                                <span class="uppercase"> {{ $type->name }} </span>
                            </option>
                        @endforeach
                    </x-select>
                </div>
                @error('rate.type_id')
                    <x-my-error>{{ $message }}</x-my-error>
                @enderror
            </div>

            <div wire:key="rate.amount"
                class="grid w-full gap-2">
                <x-input-label for="id"
                    value="Amount" />
                <div class="grid w-full">
                    <x-text-input wire:model.defer="rate.amount"
                        type="text"
                        id="number" />
                </div>
                @error('rate.amount')
                    <x-my-error>{{ $message }}</x-my-error>
                @enderror
            </div>
            <div class="flex space-x-3">
                <x-button href="{{ route('admin.rates') }}">Return</x-button>
                <x-button.primary type="submit">Update</x-button.primary>
            </div>
        </div>
    </form>
</div>
