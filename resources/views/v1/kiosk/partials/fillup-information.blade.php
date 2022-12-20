<div class="grid p-20">
    <div class="grid gap-4">
        <h1 class="text-3xl uppercase text-green-400 underline">
            CHECK IN
        </h1>
        <h1 class="text-5xl font-bold uppercase text-white underline">
            Fill UP INFORMATION
        </h1>
    </div>
    <div class="mt-20 grid grid-cols-12 gap-4">
        <div class="col-span-3">
            <div class="grid gap-3 rounded-lg border-2 border-red-600 bg-white p-5">
                <div wire:key="form.name"
                    class="grid gap-1">
                    <x-input-label for="name"
                        :value="__('Name')" />
                    <div>
                        <x-text-input id="name"
                            placeholder="Enter your name"
                            class="mt-1 block w-full"
                            wire:model.debounce.500ms="name"
                            type="text"
                            name="name"
                            :value="old('name')"
                            required
                            autofocus />
                    </div>
                    @error('name')
                        <x-error>{{ $message }}</x-error>
                    @enderror
                </div>
                <div wire:key="form.number"
                    class="grid gap-1">
                    <x-input-label for="contact_number"
                        :value="__('Contact Number')" />
                    <div>
                        <x-text-input id="contact_number"
                            placeholder="Enter your contact number (09xx-xxx-xxxx) - Optional"
                            class="mt-1 block w-full"
                            type="number"
                            wire:model.debounce.500ms="contactNumber"
                            name="contact_number"
                            :value="old('name')"
                            required
                            autofocus />
                    </div>
                    @error('contact_number')
                        <x-error>{{ $message }}</x-error>
                    @enderror
                </div>
            </div>
            <div>
                <x-button.primary wire:click="checkIn"
                    class="mt-3">
                    <span class="text-xl"> {{ __('Check In') }}</span>
                </x-button.primary>
            </div>
        </div>
        <div class="col-span-9">
            @include('v1.kiosk.partials.check-in-summary')
        </div>
    </div>
</div>
