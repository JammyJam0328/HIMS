{{-- @extends('layouts.root')

@section('content')
    <div class="h-screen bg-gray-700">
        @livewire('kiosk.check-in')
    </div>
    </x-my-alert />
@endsection --}}
<x-kiosk-layout>
  {{-- <div class="flex justify-between px-10 pt-14">
    <div>
      <h1 class="font-bold text-green-400">CHECK-IN</h1>
      <h1 class="text-5xl uppercase font-extrabold text-gray-50">Select Transaction</h1>
    </div>
  </div> --}}
  @livewire('kiosk.check-in')
  </x-my-alert />
</x-kiosk-layout>
