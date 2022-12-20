@extends('layouts.root')

@section('content')
    <div class="h-screen bg-gray-700">
        <div class="grid p-20">
            <div class="grid gap-4">
                <h1 class="text-3xl text-gray-200 underline uppercase">
                    Welcome to
                </h1>
                <h1 class="text-5xl font-bold text-white underline uppercase">
                    {{ auth()->user()->branch_name }}
                </h1>
            </div>

            <div class="mt-20">
                <div>
                    <h1 class="text-xl font-bold text-white uppercase">
                        Select Transaction :
                    </h1>
                </div>
                <div class="flex mt-5 space-x-6">
                    <a href="{{ route('kiosk.check-in') }}"
                        class="p-20 text-3xl font-bold text-white uppercase bg-green-600 border-2 border-white rounded-2xl focus:bg-green-700">
                        Check In <span class="text-transparent">1</span>
                    </a>
                    <a href="#"
                        class="p-20 text-3xl font-bold text-white uppercase bg-red-600 border-2 border-white rounded-2xl focus:bg-red-700">
                        Check Out
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
