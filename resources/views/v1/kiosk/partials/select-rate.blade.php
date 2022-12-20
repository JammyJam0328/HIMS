<div class="grid p-20">
    <div class="grid gap-4">
        <h1 class="text-3xl text-green-400 underline uppercase">
            CHECK IN
        </h1>
        <h1 class="text-5xl font-bold text-white underline uppercase">
            SELECT RATE
        </h1>
    </div>
    <div class="grid mt-20">
        <div class="grid grid-cols-5 gap-3">
            @foreach ($rates as $rate)
                <button wire:key="{{ $rate->id }}rate"
                    x-on:click="$wire.selectRate({{ $rate->id }}); step=4;"
                    type="button"
                    class="p-16 text-2xl font-bold text-white uppercase border-2 shadow-lg rounded-xl bg-white/30 focus:bg-white/50">
                    {{ $rate->stayingHour->hoursWithFormat() }}
                </button>
            @endforeach
        </div>
        <div class="mt-10">
            <div class="relative">
                <div class="absolute inset-0 flex items-center"
                    aria-hidden="true">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-start">
                    <span class="pr-3 text-lg font-medium text-white bg-gray-700">OR</span>
                </div>
            </div>
        </div>
        <div id="longStay"
            class="grid grid-cols-5 gap-3 mt-10">
            <div
                class="grid justify-center p-10 text-2xl font-bold uppercase border-2 shadow-lg rounded-xl bg-white/30 focus:bg-white/50">
                <x-text-input placeholder="Enter how many days"
                    wire:model.defer="longStayDays"
                    type="number" />
                <x-button.primary x-on:click="$wire.selectLongStay(); step = 4;"
                    class="flex justify-center mt-4"><span>Proceed</span></x-button.primary>
            </div>
        </div>
    </div>
</div>
