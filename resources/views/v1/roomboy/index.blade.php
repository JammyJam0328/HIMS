@extends('layouts.root')

@section('content')
    <div class="min-h-full">
        <div class="pb-32 bg-gray-800">
            <nav class="bg-gray-800">
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="border-b border-gray-700">
                        <div class="flex items-center justify-between h-16 px-4 sm:px-0">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    {{-- logo --}}
                                </div>
                                <div>
                                    <h1 class="font-semibold text-white">
                                        {{ auth()->user()->branch_name }}
                                    </h1>
                                </div>
                            </div>
                            <div>
                                <div class="flex items-center ml-4 md:ml-6">
                                    <button type="button"
                                        class="flex items-center p-1 text-gray-400 bg-gray-800 rounded-full hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="w-6 h-6">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                                        </svg>
                                        <span class="ml-1">
                                            Logout
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <header class="py-10">
                <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <h1 class="text-3xl font-bold tracking-tight text-white">HOME</h1>
                </div>
            </header>
        </div>

        <main class="-mt-32">
            <div class="px-4 pb-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="w-full px-5 py-6 bg-white rounded-lg shadow sm:px-6">
                    @livewire('roomboy.index')
                </div>
            </div>
        </main>
    </div>
@endsection
