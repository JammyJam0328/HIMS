<div class="grid p-10 px-20">

  <div class="flex items-end justify-between">
    <div>
      <h1 class="font-bold text-green-400">CHECK-IN</h1>
      <h1 class="text-5xl uppercase font-extrabold text-gray-50">Fill-Up Information </h1>
    </div>
    <div>
      @if ($step == 1)
        <a href="{{ route('kiosk.index') }}"
          class="bg-gradient-to-r from-red-500 via-red-500 to-transparent p-2 px-4 flex space-x-1 rounded-full">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="w-6 text-white h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
          </svg>
          <span class="font-semibold text-gray-100 uppercase">Back</span>
        </a>
      @else
        <button x-on:click="step--"
          class="bg-gradient-to-r from-red-500 via-red-500 to-transparent p-2 px-4 flex space-x-1 rounded-full">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="w-6 text-white h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
          </svg>
          <span class="font-semibold text-gray-100 uppercase">Back</span>
        </button>
      @endif
    </div>
  </div>
  <div class="mt-10 grid grid-cols-12 gap-4">
    <div class="col-span-3">
      <div class="grid gap-3 rounded-lg border-2 border-red-600 bg-white p-5">
        <div wire:key="form.name" class="grid gap-1">
          <x-input-label for="name" :value="__('Name')" />
          <div>
            <x-text-input id="name" placeholder="Enter your name" class="mt-1 block w-full"
              wire:model.debounce.500ms="name" type="text" name="name" :value="old('name')" required autofocus />
          </div>
          @error('name')
            <x-my-error>{{ $message }}</x-my-error>
          @enderror
        </div>
        <div wire:key="form.number" class="grid gap-1">
          <x-input-label for="contact_number" :value="__('Contact Number')" />
          <div>
            <x-text-input id="contact_number" placeholder="Enter your contact number (09xx-xxx-xxxx) - Optional"
              class="mt-1 block w-full" type="number" wire:model.debounce.500ms="contactNumber" name="contact_number"
              :value="old('name')" required autofocus />
          </div>
          @error('contact_number')
            <x-my-error>{{ $message }}</x-my-error>
          @enderror
        </div>
      </div>
      <div>
        <x-button.primary wire:click="checkIn" class="mt-3">
          <span class="text-xl"> {{ __('Check In') }}</span>
        </x-button.primary>
      </div>
    </div>
    <div class="col-span-9">
      @include('v1.kiosk.partials.check-in-summary')
    </div>
  </div>
</div>
