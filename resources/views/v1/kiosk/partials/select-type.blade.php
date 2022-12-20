<div class="grid p-20">
    <div class="grid gap-4">
        <h1 class="text-3xl text-green-400 underline uppercase">
            CHECK IN
        </h1>
        <h1 class="text-5xl font-bold text-white underline uppercase">
            SELECT ROOM TYPE
        </h1>
    </div>
    <div class="mt-20">
        <div class="flex space-x-5">
            @foreach ($types as $type)
                <button wire:key="{{ $type->id }}"
                    x-on:click="$wire.getRooms({{ $type->id }}); step = 2;"
                    type="button"
                    @class([
                        'p-16 text-2xl font-bold text-white uppercase border-2 shadow-lg rounded-xl bg-white/30 focus:bg-white/50',
                        'border-white' => $type->id != $typeId,
                        'border-red-600' => $type->id == $typeId,
                    ])>
                    {{ $type->name }}
                </button>
            @endforeach
        </div>
    </div>
</div>
