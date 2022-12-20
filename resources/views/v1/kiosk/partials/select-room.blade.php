<div class="grid p-20">
    <div class="grid gap-4">
        <h1 class="text-3xl text-green-400 underline uppercase">
            CHECK IN
        </h1>
        <h1 class="text-5xl font-bold text-white underline uppercase">
            SELECT ROOM
        </h1>
    </div>
    <div class="mt-20">
        <div class="grid grid-cols-5 gap-3">
            @foreach ($rooms as $room)
                <button wire:key="{{ $room->id }}room"
                    x-on:click="$wire.getRates({{ $room->id }},{{ $room->floor_id }}); step = 3;"
                    type="button"
                    class="p-16 text-2xl font-bold text-white uppercase border-2 shadow-lg rounded-xl bg-white/30 focus:bg-white/50">
                    {{ $room->numberWithFormat() }}
                </button>
            @endforeach
        </div>
    </div>
</div>
