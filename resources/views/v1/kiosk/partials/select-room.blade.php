<div class="grid p-10 px-20">

  <div class="flex items-end justify-between">
    <div>
      <h1 class="font-bold text-green-400">CHECK-IN</h1>
      <h1 class="text-5xl uppercase font-extrabold text-gray-50">Select room </h1>
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
  <div class="mt-20">
    <div class="grid grid-cols-5 gap-5">

      @foreach ($rooms as $room)
        <button wire:key="{{ $room->id }}room"
          x-on:click="$wire.getRates({{ $room->id }},{{ $room->floor_id }}); step = 3;" type="button">
          <div class="bg-gray-50 h-40 relative overflow-hidden  rounded-2xl grid place-content-center">
            <svg class="h-56 absolute text-gray-500 opacity-10 top-0 -right-10" xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 16 16" fill="none">
              <path
                d="M10 7.99841C10 8.27456 9.77614 8.49841 9.5 8.49841C9.22386 8.49841 9 8.27456 9 7.99841C9 7.72227 9.22386 7.49841 9.5 7.49841C9.77614 7.49841 10 7.72227 10 7.99841ZM7.59806 2.00971C7.45117 1.98034 7.29885 2.01836 7.18301 2.11333C7.06716 2.2083 7 2.35021 7 2.5V13.4969C7 13.6467 7.06716 13.7886 7.18301 13.8836C7.29885 13.9785 7.45117 14.0166 7.59806 13.9872L12.5981 12.9872C12.8318 12.9404 13 12.7352 13 12.4969V3.5C13 3.26166 12.8318 3.05646 12.5981 3.00971L7.59806 2.00971ZM8 12.887V3.10991L12 3.90991V12.087L8 12.887ZM6 12.9969V11.9969H4V4H6V3H3.5C3.22386 3 3 3.22386 3 3.5V12.4969C3 12.773 3.22386 12.9969 3.5 12.9969H6Z"
                fill="currentColor"></path>
            </svg>
            <h1 class="font-bold text-gray-700 text-4xl">{{ $room->numberWithFormat() }}</h1>
          </div>
        </button>
      @endforeach
    </div>
  </div>
</div>
