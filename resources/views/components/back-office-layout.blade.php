@extends('layouts.backOffice')
@section('content')
  <div class="min-h-full">
    <!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
    <div class="relative z-40 lg:hidden" role="dialog" aria-modal="true">
      <!--
                                                                                                                                                                                                                                                                                                                          Off-canvas menu backdrop, show/hide based on off-canvas menu state.
                                                                                                                                                                                                                                                                                                                    
                                                                                                                                                                                                                                                                                                                          Entering: "transition-opacity ease-linear duration-300"
                                                                                                                                                                                                                                                                                                                            From: "opacity-0"
                                                                                                                                                                                                                                                                                                                            To: "opacity-100"
                                                                                                                                                                                                                                                                                                                          Leaving: "transition-opacity ease-linear duration-300"
                                                                                                                                                                                                                                                                                                                            From: "opacity-100"
                                                                                                                                                                                                                                                                                                                            To: "opacity-0"
                                                                                                                                                                                                                                                                                                                        -->
      <div class="fixed inset-0 bg-gray-600 bg-opacity-75"></div>

      <div class="fixed inset-0 z-40 flex">
        <!--
                                                                                                                                                                                                                                                                                                                            Off-canvas menu, show/hide based on off-canvas menu state.
                                                                                                                                                                                                                                                                                                                    
                                                                                                                                                                                                                                                                                                                            Entering: "transition ease-in-out duration-300 transform"
                                                                                                                                                                                                                                                                                                                              From: "-translate-x-full"
                                                                                                                                                                                                                                                                                                                              To: "translate-x-0"
                                                                                                                                                                                                                                                                                                                            Leaving: "transition ease-in-out duration-300 transform"
                                                                                                                                                                                                                                                                                                                              From: "translate-x-0"
                                                                                                                                                                                                                                                                                                                              To: "-translate-x-full"
                                                                                                                                                                                                                                                                                                                          -->
        <div class="relative flex w-full max-w-xs flex-1 flex-col bg-white pt-5 pb-4">
          <!--
                                                                                                                                                                                                                                                                                                                              Close button, show/hide based on off-canvas menu state.
                                                                                                                                                                                                                                                                                                                    
                                                                                                                                                                                                                                                                                                                              Entering: "ease-in-out duration-300"
                                                                                                                                                                                                                                                                                                                                From: "opacity-0"
                                                                                                                                                                                                                                                                                                                                To: "opacity-100"
                                                                                                                                                                                                                                                                                                                              Leaving: "ease-in-out duration-300"
                                                                                                                                                                                                                                                                                                                                From: "opacity-100"
                                                                                                                                                                                                                                                                                                                                To: "opacity-0"
                                                                                                                                                                                                                                                                                                                            -->
          <div class="absolute top-0 right-0 -mr-12 pt-2">
            <button type="button"
              class="ml-1 flex h-10 w-10 items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
              <span class="sr-only">Close sidebar</span>
              <!-- Heroicon name: outline/x-mark -->
              <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>

          <div class="flex flex-shrink-0 items-center px-4">
            <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=purple&shade=500"
              alt="Your Company">
          </div>
          <div class="mt-5 h-0 flex-1 overflow-y-auto">
            <nav class="px-2">
              <div class="space-y-1">
                <!-- Current: "bg-gray-100 text-gray-900", Default: "text-gray-600 hover:text-gray-900 hover:bg-gray-50" -->
                <a href="#"
                  class="bg-gray-100 text-gray-900 group flex items-center px-2 py-2 text-base leading-5 font-medium rounded-md"
                  aria-current="page">
                  <!--
                                                                                                                                                                                                                                                                                                                                      Heroicon name: outline/home
                                                                                                                                                                                                                                                                                                                    
                                                                                                                                                                                                                                                                                                                                      Current: "text-gray-500", Default: "text-gray-400 group-hover:text-gray-500"
                                                                                                                                                                                                                                                                                                                                    -->
                  <svg class="text-gray-500 mr-3 flex-shrink-0 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                  </svg>
                  Home
                </a>

                <a href="#"
                  class="text-gray-600 hover:text-gray-900 hover:bg-gray-50 group flex items-center px-2 py-2 text-base leading-5 font-medium rounded-md">
                  <!-- Heroicon name: outline/bars-4 -->
                  {{-- <svg class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
                  </svg> --}}
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                  </svg>

                  My tasks
                </a>

                <a href="#"
                  class="text-gray-600 hover:text-gray-900 hover:bg-gray-50 group flex items-center px-2 py-2 text-base leading-5 font-medium rounded-md">
                  <!-- Heroicon name: outline/clock -->
                  <svg class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  Recent
                </a>
              </div>
              <div class="mt-8">
                <h3 class="px-3 text-sm font-medium text-gray-500" id="mobile-teams-headline">Teams</h3>
                <div class="mt-1 space-y-1" role="group" aria-labelledby="mobile-teams-headline">
                  <a href="#"
                    class="group flex items-center rounded-md px-3 py-2 text-base font-medium leading-5 text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                    <span class="w-2.5 h-2.5 mr-4 bg-indigo-500 rounded-full" aria-hidden="true"></span>
                    <span class="truncate">Engineering</span>
                  </a>

                  <a href="#"
                    class="group flex items-center rounded-md px-3 py-2 text-base font-medium leading-5 text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                    <span class="w-2.5 h-2.5 mr-4 bg-green-500 rounded-full" aria-hidden="true"></span>
                    <span class="truncate">Human Resources</span>
                  </a>

                  <a href="#"
                    class="group flex items-center rounded-md px-3 py-2 text-base font-medium leading-5 text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                    <span class="w-2.5 h-2.5 mr-4 bg-yellow-500 rounded-full" aria-hidden="true"></span>
                    <span class="truncate">Customer Success</span>
                  </a>
                </div>
              </div>
            </nav>
          </div>
        </div>

        <div class="w-14 flex-shrink-0" aria-hidden="true">
          <!-- Dummy element to force sidebar to shrink to fit close icon -->
        </div>
      </div>
    </div>

    <!-- Static sidebar for desktop -->
    <div
      class="hidden lg:fixed lg:inset-y-0 lg:flex lg:w-64 lg:flex-col lg:border-r lg:border-gray-200 lg:bg-gray-100 lg:pt-5 lg:pb-4">
      <div class="flex flex-shrink-0 items-center bg-gren-400 px-3 space-x-1">
        <h1 class="text-2xl font-bold pr-1 border-r-2 border-green-500  text-center text-green-700">HIMS</h1>
        <span class="leading-3 text-sm font-medium text-gray-600"> {{ auth()->user()->branch_name ?? '' }}</span>
      </div>
      <!-- Sidebar component, swap this element with another sidebar if you like -->
      <div class="mt-5 flex h-0 flex-1 flex-col overflow-y-auto pt-1">
        <!-- User account dropdown -->
        <div class="relative inline-block px-3 text-left" x-data="{ dropdown: false }">
          <div>
            <button type="button" x-on:click="dropdown = !dropdown" x-on:click.away="dropdown = false"
              class="group w-full rounded-md bg-white px-3.5 py-2 text-left text-sm font-medium text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 focus:ring-offset-gray-100"
              id="options-menu-button" aria-expanded="false" aria-haspopup="true">
              <span class="flex w-full items-center justify-between">
                <span class="flex min-w-0 items-center justify-between space-x-3">

                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="h-10 w-10 flex-shrink-0 text-gray-500 rounded-full">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                  </svg>

                  <span class="flex min-w-0 flex-1 flex-col">
                    <span class="truncate text-sm font-medium text-gray-600">{{ auth()->user()->name }}</span>
                    <span class="truncate text-sm text-gray-600">{{ auth()->user()->email }}</span>
                  </span>
                </span>
                <!-- Heroicon name: mini/chevron-up-down -->
                <svg class="h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500"
                  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd"
                    d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z"
                    clip-rule="evenodd" />
                </svg>
              </span>
            </button>
          </div>

          <!--
                                                                                                                                                                                                                                                                                                                              Dropdown menu, show/hide based on menu state.
                                                                                                                                                                                                                                                                                                                    
                                                                                                                                                                                                                                                                                                                              Entering: "transition ease-out duration-100"
                                                                                                                                                                                                                                                                                                                                From: "transform opacity-0 scale-95"
                                                                                                                                                                                                                                                                                                                                To: "transform opacity-100 scale-100"
                                                                                                                                                                                                                                                                                                                              Leaving: "transition ease-in duration-75"
                                                                                                                                                                                                                                                                                                                                From: "transform opacity-100 scale-100"
                                                                                                                                                                                                                                                                                                                                To: "transform opacity-0 scale-95"
                                                                                                                                                                                                                                                                                                                            -->
          <div x-show="dropdown" x-cloak x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95"
            class="absolute right-0 left-0 z-10 mx-3 mt-1 origin-top divide-y divide-gray-200 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
            role="menu" aria-orientation="vertical" aria-labelledby="options-menu-button" tabindex="-1">
            <div class="py-1" role="none">
              <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
              <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
                id="options-menu-item-0">View profile</a>
              <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
                id="options-menu-item-1">Settings</a>
              <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
                id="options-menu-item-2">Notifications</a>
            </div>
            <div class="py-1" role="none">
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                        this.closest('form').submit();"
                  class="text-gray-700 hover:text-green-700 px-4 py-2 flex items-center space-x-1 text-sm"
                  role="menuitem" tabindex="-1" id="options-menu-item-5">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                  </svg>
                  <span>Logout</span>
                </a>
              </form>
            </div>
          </div>
        </div>
        <!-- Sidebar Search -->
        {{-- <div class="mt-5 px-3">
          <label for="search" class="sr-only">Search</label>
          <div class="relative mt-1 rounded-md shadow-sm">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3" aria-hidden="true">
              <!-- Heroicon name: mini/magnifying-glass -->
              <svg class="mr-3 h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd"
                  d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                  clip-rule="evenodd" />
              </svg>
            </div>
            <input type="text" name="search" id="search"
              class="block w-full rounded-md border-gray-300 pl-9 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
              placeholder="Search">
          </div>
        </div> --}}
        <!-- Navigation -->
        <nav class="mt-6 px-3">
          <div class="space-y-1">

            <a href="{{ route('back-office.index') }}"
              class=" {{ Request::routeIs('back-office.index') ? 'bg-gray-400 text-white' : '' }} text-gray-700 hover:text-gray-900 hover:bg-gray-200 group flex items-center px-2 py-2 text-sm font-medium rounded-md">

              <svg class="mr-3 flex-shrink-0 h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                fill="currentColor">
                <path d="M3,11h8V3H3V11z M5,5h4v4H5V5z"></path>
                <path d="M13,3v8h8V3H13z M19,9h-4V5h4V9z"></path>
                <path d="M3,21h8v-8H3V21z M5,15h4v4H5V15z"></path>
                <polygon points="18,13 16,13 16,16 13,16 13,18 16,18 16,21 18,21 18,18 21,18 21,16 18,16"></polygon>
              </svg>
              DASHBOARD
            </a>

            <a href="{{ route('back-office.sales') }}"
              class=" {{ Request::routeIs('back-office.sales') ? 'bg-gray-400 text-white' : '' }} text-gray-700 hover:text-gray-900 hover:bg-gray-200 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
              {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="mr-3 flex-shrink-0 h-6 w-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
              </svg> --}}
              <svg class="mr-3 flex-shrink-0 h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                fill="none">
                <path
                  d="M10.5 8C8.84315 8 7.5 9.34315 7.5 11C7.5 12.6569 8.84315 14 10.5 14C12.1569 14 13.5 12.6569 13.5 11C13.5 9.34315 12.1569 8 10.5 8ZM9 11C9 10.1716 9.67157 9.5 10.5 9.5C11.3284 9.5 12 10.1716 12 11C12 11.8284 11.3284 12.5 10.5 12.5C9.67157 12.5 9 11.8284 9 11ZM2 7.25C2 6.00736 3.00736 5 4.25 5H16.75C17.9926 5 19 6.00736 19 7.25V14.75C19 15.9926 17.9926 17 16.75 17H4.25C3.00736 17 2 15.9926 2 14.75V7.25ZM4.25 6.5C3.83579 6.5 3.5 6.83579 3.5 7.25V8H4.25C4.66421 8 5 7.66421 5 7.25V6.5H4.25ZM3.5 12.5H4.25C5.49264 12.5 6.5 13.5074 6.5 14.75V15.5H14.5V14.75C14.5 13.5074 15.5074 12.5 16.75 12.5H17.5V9.5H16.75C15.5074 9.5 14.5 8.49264 14.5 7.25V6.5H6.5V7.25C6.5 8.49264 5.49264 9.5 4.25 9.5H3.5V12.5ZM17.5 8V7.25C17.5 6.83579 17.1642 6.5 16.75 6.5H16V7.25C16 7.66421 16.3358 8 16.75 8H17.5ZM17.5 14H16.75C16.3358 14 16 14.3358 16 14.75V15.5H16.75C17.1642 15.5 17.5 15.1642 17.5 14.75V14ZM3.5 14.75C3.5 15.1642 3.83579 15.5 4.25 15.5H5V14.75C5 14.3358 4.66421 14 4.25 14H3.5V14.75ZM4.40137 18.5C4.92008 19.3967 5.8896 20 7.00002 20H17.25C19.8734 20 22 17.8734 22 15.25V10C22 8.8896 21.3967 7.92008 20.5 7.40137V15.25C20.5 17.0449 19.0449 18.5 17.25 18.5H4.40137Z"
                  fill="currentColor"></path>
              </svg>
              SALES
            </a>
            <a href="{{ route('back-office.expenses') }}"
              class=" {{ Request::routeIs('back-office.expenses') ? 'bg-gray-400 text-white' : '' }} text-gray-700 hover:text-gray-900 hover:bg-gray-200 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
              <svg class="mr-3 flex-shrink-0 h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                fill="none">
                <path
                  d="M3.28033 2.21967C2.98744 1.92678 2.51256 1.92678 2.21967 2.21967C1.92678 2.51256 1.92678 2.98744 2.21967 3.28033L3.9581 5.01876C2.85336 5.16187 2 6.10628 2 7.25V14.75C2 15.9926 3.00736 17 4.25 17H15.9393L17.4342 18.4949C17.3733 18.4983 17.3118 18.5 17.25 18.5H4.40137C4.92008 19.3967 5.8896 20 7.00002 20H17.25C17.7596 20 18.2504 19.9198 18.7106 19.7712L20.7197 21.7803C21.0126 22.0732 21.4874 22.0732 21.7803 21.7803C22.0732 21.4874 22.0732 21.0126 21.7803 20.7197L3.28033 2.21967ZM14.4393 15.5H6.5V14.75C6.5 13.5074 5.49264 12.5 4.25 12.5H3.5V9.5H4.25C5.39372 9.5 6.33813 8.64664 6.48124 7.5419L8.11684 9.1775C7.72992 9.6827 7.5 10.3145 7.5 11C7.5 12.6569 8.84315 14 10.5 14C11.1855 14 11.8173 13.7701 12.3225 13.3832L14.4393 15.5ZM9.19654 10.2572L11.2428 12.3035C11.0238 12.4285 10.7702 12.5 10.5 12.5C9.67157 12.5 9 11.8284 9 11C9 10.7298 9.07147 10.4762 9.19654 10.2572ZM3.5 7.25C3.5 6.83579 3.83579 6.5 4.25 6.5H5V7.25C5 7.66421 4.66421 8 4.25 8H3.5V7.25ZM4.25 15.5C3.83579 15.5 3.5 15.1642 3.5 14.75V14H4.25C4.66421 14 5 14.3358 5 14.75V15.5H4.25ZM16.75 12.5C16.4349 12.5 16.1348 12.5648 15.8626 12.6818L17.1808 14H17.5V14.3192L18.8182 15.6374C18.9352 15.3652 19 15.0651 19 14.75V7.25C19 6.00736 17.9926 5 16.75 5H8.18078L9.68078 6.5H14.5V7.25C14.5 8.49264 15.5074 9.5 16.75 9.5H17.5V12.5H16.75ZM17.5 7.25V8H16.75C16.3358 8 16 7.66421 16 7.25V6.5H16.75C17.1642 6.5 17.5 6.83579 17.5 7.25ZM20.0618 16.881L21.1472 17.9664C21.6847 17.1966 22 16.2601 22 15.25V10C22 8.8896 21.3967 7.92008 20.5 7.40137V15.25C20.5 15.8445 20.3404 16.4016 20.0618 16.881Z"
                  fill="currentColor"></path>
              </svg>

              EXPENSES
            </a>

            <a href="{{ route('back-office.reports') }}"
              class=" {{ Request::routeIs('back-office.reports') ? 'bg-gray-400 text-white' : '' }} text-gray-700 hover:text-gray-900 hover:bg-gray-200 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
              <svg class="mr-3 flex-shrink-0 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                stroke="none" viewBox="0 0 24 24">
                <path
                  d="M19.903 8.586a.997.997 0 0 0-.196-.293l-6-6a.997.997 0 0 0-.293-.196c-.03-.014-.062-.022-.094-.033a.991.991 0 0 0-.259-.051C13.04 2.011 13.021 2 13 2H6c-1.103 0-2 .897-2 2v16c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2V9c0-.021-.011-.04-.013-.062a.952.952 0 0 0-.051-.259c-.01-.032-.019-.063-.033-.093zM16.586 8H14V5.414L16.586 8zM6 20V4h6v5a1 1 0 0 0 1 1h5l.002 10H6z">
                </path>
                <path d="M8 12h8v2H8zm0 4h8v2H8zm0-8h2v2H8z"></path>
              </svg>

              REPORTS
            </a>
            {{-- <a href="#"
              class="text-gray-700 hover:text-gray-900 hover:bg-gray-50 group flex items-center px-2 py-2 text-sm font-medium rounded-md">

              <svg class="mr-3 flex-shrink-0 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                stroke="none" viewBox="0 0 24 24">
                <path
                  d="M19.903 8.586a.997.997 0 0 0-.196-.293l-6-6a.997.997 0 0 0-.293-.196c-.03-.014-.062-.022-.094-.033a.991.991 0 0 0-.259-.051C13.04 2.011 13.021 2 13 2H6c-1.103 0-2 .897-2 2v16c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2V9c0-.021-.011-.04-.013-.062a.952.952 0 0 0-.051-.259c-.01-.032-.019-.063-.033-.093zM16.586 8H14V5.414L16.586 8zM6 20V4h6v5a1 1 0 0 0 1 1h5l.002 10H6z">
                </path>
                <path d="M8 12h8v2H8zm0 4h8v2H8zm0-8h2v2H8z"></path>
              </svg>
              REPORTS
            </a> --}}
          </div>
          {{-- <div class="mt-8">
            <!-- Secondary navigation -->
            <h3 class="px-3 text-sm font-medium text-gray-500" id="desktop-teams-headline">Teams</h3>
            <div class="mt-1 space-y-1" role="group" aria-labelledby="desktop-teams-headline">
              <a href="#"
                class="group flex items-center rounded-md px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900">
                <span class="w-2.5 h-2.5 mr-4 bg-indigo-500 rounded-full" aria-hidden="true"></span>
                <span class="truncate">Engineering</span>
              </a>

              <a href="#"
                class="group flex items-center rounded-md px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900">
                <span class="w-2.5 h-2.5 mr-4 bg-green-500 rounded-full" aria-hidden="true"></span>
                <span class="truncate">Human Resources</span>
              </a>

              <a href="#"
                class="group flex items-center rounded-md px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900">
                <span class="w-2.5 h-2.5 mr-4 bg-yellow-500 rounded-full" aria-hidden="true"></span>
                <span class="truncate">Customer Success</span>
              </a>
            </div>
          </div> --}}
        </nav>
      </div>
    </div>
    <!-- Main column -->
    <div class="flex flex-col lg:pl-64">
      <!-- Search header -->
      <div class="sticky top-0 z-10 flex h-16 flex-shrink-0 border-b border-gray-200 bg-white lg:hidden">
        <!-- Sidebar toggle, controls the 'sidebarOpen' sidebar state. -->
        <button type="button"
          class="border-r border-gray-200 px-4 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-purple-500 lg:hidden">
          <span class="sr-only">Open sidebar</span>
          <!-- Heroicon name: outline/bars-3-center-left -->
          <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12H12m-8.25 5.25h16.5" />
          </svg>
        </button>
        <div class="flex flex-1 justify-between px-4 sm:px-6 lg:px-8">
          <div class="flex flex-1">
            <form class="flex w-full md:ml-0" action="#" method="GET">
              <label for="search-field" class="sr-only">Search</label>
              <div class="relative w-full text-gray-400 focus-within:text-gray-600">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center">
                  <!-- Heroicon name: mini/magnifying-glass -->
                  <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                    aria-hidden="true">
                    <path fill-rule="evenodd"
                      d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                      clip-rule="evenodd" />
                  </svg>
                </div>
                <input id="search-field" name="search-field"
                  class="block h-full w-full border-transparent py-2 pl-8 pr-3 text-gray-900 placeholder-gray-500 focus:border-transparent focus:placeholder-gray-400 focus:outline-none focus:ring-0 sm:text-sm"
                  placeholder="Search" type="search">
              </div>
            </form>
          </div>
          <div class="flex items-center">
            <!-- Profile dropdown -->
            <div class="relative ml-3">
              <div>
                <button type="button"
                  class="flex max-w-xs items-center rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2"
                  id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                  <span class="sr-only">Open user menu</span>
                  <img class="h-8 w-8 rounded-full"
                    src="https://images.unsplash.com/photo-1502685104226-ee32379fefbe?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                    alt="">
                </button>
              </div>

              <!--
                                                                                                                                                                                                                                                                                                                                  Dropdown menu, show/hide based on menu state.
                                                                                                                                                                                                                                                                                                                    
                                                                                                                                                                                                                                                                                                                                  Entering: "transition ease-out duration-100"
                                                                                                                                                                                                                                                                                                                                    From: "transform opacity-0 scale-95"
                                                                                                                                                                                                                                                                                                                                    To: "transform opacity-100 scale-100"
                                                                                                                                                                                                                                                                                                                                  Leaving: "transition ease-in duration-75"
                                                                                                                                                                                                                                                                                                                                    From: "transform opacity-100 scale-100"
                                                                                                                                                                                                                                                                                                                                    To: "transform opacity-0 scale-95"
                                                                                                                                                                                                                                                                                                                                -->
              <div
                class="absolute right-0 z-10 mt-2 w-48 origin-top-right divide-y divide-gray-200 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                <div class="py-1" role="none">
                  <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                  <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
                    id="user-menu-item-0">View profile</a>
                  <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
                    id="user-menu-item-1">Settings</a>
                  <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
                    id="user-menu-item-2">Notifications</a>
                </div>
                <div class="py-1" role="none">
                  <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
                    id="user-menu-item-3">Get desktop app</a>
                  <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
                    id="user-menu-item-4">Support</a>
                </div>
                <div class="py-1" role="none">
                  <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1"
                    id="user-menu-item-5">Logout</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <main class="flex-1">
        <!-- Page title & actions -->
        <div class="border-b border-gray-200 px-4 py-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">
          <div class="min-w-0 flex-1">
            <h1 class="text-lg font-medium leading-6 text-gray-900 sm:truncate">{{ auth()->user()->branch_name }}</h1>
          </div>
          <div class="mt-4 flex sm:mt-0 sm:ml-4">
          </div>
        </div>

        <!-- Container for the main content -->
        <div class="mx-auto max-w-7xl py-10 lg:px-10">
          {{ $slot }}
        </div>


      </main>
    </div>
  </div>
@endsection
