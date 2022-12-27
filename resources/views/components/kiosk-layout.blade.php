@extends('layouts.kiosk')
@section('content')
  <div class="h-full ">
    <div class="p-10 flex justify-between items-center">
      <div class="flex space-x-2 items-center">
        <x-svg.hotel class="w-10 h-10 text-gray-300" />
        <div class="border-l-2 border-gray-400 pl-2">
          <div class="text-gray-200 text-2xl font-bold">HIMS</div>
          <div class="text-gray-300 font-rubik font-medium  leading-3">{{ auth()->user()->branch_name }}</div>
        </div>
      </div>
    </div>
    <div>
      {{ $slot }}
    </div>
  </div>
@endsection
