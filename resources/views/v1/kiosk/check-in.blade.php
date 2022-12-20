@extends('layouts.root')

@section('content')
    <div class="h-screen bg-gray-700">
        @livewire('kiosk.check-in')
    </div>
    <x-alert />
@endsection
