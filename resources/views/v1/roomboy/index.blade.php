@extends('layouts.root')

@section('content')
  <div class="min-h-full font-rubik">
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
                  {{-- <h1 class="font-semibold text-white">
                    {{ auth()->user()->branch_name }}
                  </h1> --}}
                  <div class="flex space-x-2 items-center">
                    <x-svg.hotel class="w-10 h-10 text-gray-300" />
                    <div class="border-l-2 border-gray-400 pl-2">
                      <div class="text-gray-200 text-xl font-bold">HIMS</div>
                      <div class="text-gray-300 font-rubik font-medium text-sm  leading-3">
                        {{ auth()->user()->branch_name }}</div>
                    </div>
                  </div>
                </div>
              </div>
              <div>
                <div class="flex items-center ml-4 md:ml-6">
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="button" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                          this.closest('form').submit();"
                      class="flex items-center p-1 text-gray-400 bg-gray-800 rounded-full hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                      </svg>
                      <span class="ml-1 hidden xl:block">
                        Logout
                      </span>
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </nav>
      <header class="py-10 font-rubik">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8 text-center xl:text-left">
          <h1 class="text-2xl font-black tracking-tight xl:text-3xl text-gray-50">ROOMBOY DASHBOARD</h1>
        </div>
      </header>
    </div>

    {{-- <main class="-mt-32">
      <div class="px-4 pb-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="w-full px-5 py-6 bg-white rounded-lg shadow sm:px-6">
          @livewire('roomboy.index')
        </div>
      </div>
    </main> --}}
    <main class=" -mt-32">
      @livewire('roomboy.index')
    </main>
  </div>
@endsection
