{{-- <div x-data>
    @if (auth()->user()->room_boy_assigned_floor_id)
        <div class="grid w-full gap-4">
            <div class="grid gap-5">
                <div class="grid gap-4">
                    <h1 class="font-semibold">
                        Currently Cleaning
                    </h1>
                    <x-table>
                        <x-slot:header>
                            <x-table.head>Room Number</x-table.head>
                            <x-table.head>Time Started</x-table.head>
                            <x-table.head>Actions</x-table.head>
                        </x-slot:header>
                        @if (auth()->user()->room_boy_cleaning_room_id)
                            <x-table.row wire:key="asdoisajdiljas">
                                <x-table.cell>
                                    <span class="text-xl text-bold">
                                        {{ auth()->user()->roomBoyRoom->numberWithFormat() }}
                                    </span>
                                </x-table.cell>
                                <x-table.cell>
                                    {{ \Carbon\Carbon::parse(auth()->user()->roomBoyRoom->started_cleaning_at)->diffForHumans() }}
                                </x-table.cell>
                                <x-table.cell>
                                    <x-button.danger x-on:click="$dispatch('confirm-finish-cleaning')">
                                        Finish
                                    </x-button.danger>
                                </x-table.cell>
                            </x-table.row>
                        @endif
                    </x-table>
                </div>
                <div class="grid gap-4">
                    <h1 class="font-semibold">
                        Assigned Rooms
                    </h1>
                    <x-table>
                        <x-slot:header>
                            <x-table.head>Room Number</x-table.head>
                            <x-table.head>Time To Clean</x-table.head>
                            <x-table.head>Actions</x-table.head>
                        </x-slot:header>
                        @foreach ($assignedRooms as $assignedRoom)
                            <x-table.row wire:key="{{ $assignedRoom->id }}">
                                <x-table.cell>
                                    <span class="text-xl text-bold">
                                        {{ $assignedRoom->numberWithFormat() }}
                                    </span>
                                </x-table.cell>

                                <x-table.cell>
                                    @php
                                        $expires = \Carbon\Carbon::parse($assignedRoom->time_to_clean);
                                    @endphp
                                    <x-countdown :$expires />
                                </x-table.cell>
                                <x-table.cell>
                                    <x-button.danger
                                        x-on:click="$dispatch('confirm-clean-assigned-room',{ id : {{ $assignedRoom->id }}})">
                                        Clean
                                    </x-button.danger>
                                </x-table.cell>
                            </x-table.row>
                        @endforeach
                    </x-table>
                </div>
                <div class="grid gap-4">
                    <h1 class="font-semibold">
                        Unassigned Rooms
                    </h1>
                    <x-table>
                        <x-slot:header>
                            <x-table.head>Room Number</x-table.head>
                            <x-table.head>Time To Clean</x-table.head>
                            <x-table.head>Actions</x-table.head>
                        </x-slot:header>
                        @foreach ($unassignedRooms as $unassignedRoom)
                            <x-table.row wire:key="{{ $unassignedRoom->id }}">
                                <x-table.cell>
                                    <span class="text-xl text-bold">
                                        {{ $unassignedRoom->numberWithFormat() }}
                                    </span>
                                </x-table.cell>
                                <x-table.cell>
                                    @php
                                        $expires = \Carbon\Carbon::parse($unassignedRoom->time_to_clean);
                                    @endphp
                                    <x-countdown :$expires />
                                </x-table.cell>
                                <x-table.cell>
                                    <x-button.danger
                                        x-on:click="$dispatch('confirm-clean-assigned-room',{ id : {{ $assignedRoom->id }}})">
                                        Clean
                                    </x-button.danger>
                                </x-table.cell>
                            </x-table.row>
                        @endforeach
                    </x-table>
                </div>
            </div>
        </div>
        <x-confirm name="clean-assigned-room"
            title="Confirm"
            message="Are you sure you want to clean this room?"
            onConfirm="cleanAssignedRoom(params.id)" />
        <x-confirm name="finish-cleaning"
            title="Confirm"
            message="Are you sure you want to finish cleaning this room?"
            onConfirm="finishCleaing()" />
    @else
        <span>
            You are not assigned to any floor.
        </span>
    @endif
</div> --}}
<div>
  <div
    class="mx-auto max-w-3xl px-4 bg-white py-2 rounded-t-3xl xl:rounded-3xl sm:px-6 md:flex md:items-center md:justify-between md:space-x-5 lg:max-w-7xl lg:px-8">
    <div class="flex  items-center space-x-5">
      <div class="flex-shrink-0">
        <div class="relative">
          <img class="h-16 w-16 rounded-full" src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}"
            alt="">
          <span class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></span>
        </div>
      </div>
      <div>
        <h1 class="text-2xl font-bold text-gray-700">{{ auth()->user()->name }}</h1>
        <p class="text-sm font-medium text-gray-400">Designated
          Floor:</p>
      </div>
    </div>
    <div
      class="justify-stretch mt-6 flex flex-col-reverse space-y-4 space-y-reverse sm:flex-row-reverse sm:justify-end sm:space-y-0 sm:space-x-3 sm:space-x-reverse md:mt-0 md:flex-row md:space-x-3">
      <div class="flex space-x-1 justify-center items-center ">
        <span class="text-sm">status:</span>
        <span
          class="inline-flex items-center rounded-full bg-green-100 px-3 py-0.5 text-sm font-medium text-green-800">CLEANING</span>
      </div>
    </div>
  </div>

  <div class="mx-auto mt-5 grid max-w-3xl grid-cols-1 gap-6 sm:px-6 lg:max-w-7xl lg:grid-flow-col-dense lg:grid-cols-3">
    <div class="space-y-6 lg:col-span-2 lg:col-start-1">
      <!-- Description list-->
      <section aria-labelledby="applicant-information-title">
        <div class="bg-white border-x border-b">
          <div class="px-4 py-5 sm:px-6 flex space-x-2">
            <h2 id="applicant-information-title" class="text-sm font-medium leading-6 text-gray-700">Legend: </h2>
            <span
              class="inline-flex items-center rounded-full bg-red-600 px-3 py-0.5 text-sm font-medium text-white">Priority</span>
            <span
              class="inline-flex items-center rounded-full bg-green-600 px-3 py-0.5 text-sm font-medium text-white">Onqueue</span>
          </div>
        </div>
        {{-- <div class="mt-4 grid xl:grid-cols-2 grid-cols-1 px-2 gap-3">
          <div class="h-36 rounded-3xl border">

          </div>

        </div> --}}
        @if (auth()->user()->room_boy_assigned_floor_id)
          <div class="grid w-full gap-4">
            <div class="grid gap-5">
              <div class="grid gap-4">
                <h1 class="font-semibold">
                  Currently Cleaning
                </h1>
                <x-table>
                  <x-slot:header>
                    <x-table.head>Room Number</x-table.head>
                    <x-table.head>Time Started</x-table.head>
                    <x-table.head>Actions</x-table.head>
                  </x-slot:header>
                  <x-table.row wire:key="asdoisajdiljassd">
                    <x-table.cell>
                      <span class="text-xl text-bold">
                        {{ auth()->user()->roomBoyRoom->numberWithFormat() }}
                      </span>
                    </x-table.cell>
                    <x-table.cell>
                      {{ \Carbon\Carbon::parse(auth()->user()->roomBoyRoom->started_cleaning_at)->diffForHumans() }}
                    </x-table.cell>
                    <x-table.cell>
                      <x-button.danger x-on:click="$dispatch('confirm-finish-cleaning')">
                        Finish
                      </x-button.danger>
                    </x-table.cell>
                  </x-table.row>
                </x-table>
              </div>
              <div class="grid gap-4">
                <h1 class="font-semibold">
                  Assigned Rooms
                </h1>
                <x-table>
                  <x-slot:header>
                    <x-table.head>Room Number</x-table.head>
                    <x-table.head>Time To Clean</x-table.head>
                    <x-table.head>Actions</x-table.head>
                  </x-slot:header>
                  @foreach ($assignedRooms as $assignedRoom)
                    <x-table.row wire:key="{{ $assignedRoom->id }}">
                      <x-table.cell>
                        <span class="text-xl text-bold">
                          {{ $assignedRoom->numberWithFormat() }}
                        </span>
                      </x-table.cell>

                      <x-table.cell>
                        @php
                          $expires = \Carbon\Carbon::parse($assignedRoom->time_to_clean);
                        @endphp
                        <x-countdown :$expires />
                      </x-table.cell>
                      <x-table.cell>
                        <x-button.danger
                          x-on:click="$dispatch('confirm-clean-assigned-room',{ id : {{ $assignedRoom->id }}})">
                          Clean
                        </x-button.danger>
                      </x-table.cell>
                    </x-table.row>
                  @endforeach
                </x-table>
              </div>
              <div class="grid gap-4">
                <h1 class="font-semibold">
                  Unassigned Rooms
                </h1>
                <x-table>
                  <x-slot:header>
                    <x-table.head>Room Number</x-table.head>
                    <x-table.head>Time To Clean</x-table.head>
                    <x-table.head>Actions</x-table.head>
                  </x-slot:header>
                  @foreach ($unassignedRooms as $unassignedRoom)
                    <x-table.row wire:key="{{ $unassignedRoom->id }}">
                      <x-table.cell>
                        <span class="text-xl text-bold">
                          {{ $unassignedRoom->numberWithFormat() }}
                        </span>
                      </x-table.cell>
                      <x-table.cell>
                        @php
                          $expires = \Carbon\Carbon::parse($unassignedRoom->time_to_clean);
                        @endphp
                        <x-countdown :$expires />
                      </x-table.cell>
                      <x-table.cell>
                        <x-button.danger
                          x-on:click="$dispatch('confirm-clean-assigned-room',{ id : {{ $assignedRoom->id }}})">
                          Clean
                        </x-button.danger>
                      </x-table.cell>
                    </x-table.row>
                  @endforeach
                </x-table>
              </div>
            </div>
          </div>
          <x-confirm name="clean-assigned-room" title="Confirm" message="Are you sure you want to clean this room?"
            onConfirm="cleanAssignedRoom(params.id)" />
          <x-confirm name="finish-cleaning" title="Confirm"
            message="Are you sure you want to finish cleaning this room?" onConfirm="finishCleaing()" />
        @else
          <span>
            You are not assigned to any floor.
          </span>
        @endif
      </section>


    </div>

    <section aria-labelledby="timeline-title" class="lg:col-span-1 lg:col-start-3">
      <div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:px-6">
        <h2 id="timeline-title" class="text-lg font-medium text-gray-900">Timeline</h2>

        <!-- Activity Feed -->
        <div class="mt-6 flow-root">
          <ul role="list" class="-mb-8">
            <li>
              <div class="relative pb-8">
                <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                <div class="relative flex space-x-3">
                  <div>
                    <span class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">
                      <!-- Heroicon name: mini/user -->
                      <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor" aria-hidden="true">
                        <path
                          d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 00-13.074.003z" />
                      </svg>
                    </span>
                  </div>
                  <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                    <div>
                      <p class="text-sm text-gray-500">Applied to <a href="#"
                          class="font-medium text-gray-900">Front End Developer</a></p>
                    </div>
                    <div class="whitespace-nowrap text-right text-sm text-gray-500">
                      <time datetime="2020-09-20">Sep 20</time>
                    </div>
                  </div>
                </div>
              </div>
            </li>

            <li>
              <div class="relative pb-8">
                <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                <div class="relative flex space-x-3">
                  <div>
                    <span class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white">
                      <!-- Heroicon name: mini/hand-thumb-up -->
                      <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor" aria-hidden="true">
                        <path
                          d="M1 8.25a1.25 1.25 0 112.5 0v7.5a1.25 1.25 0 11-2.5 0v-7.5zM11 3V1.7c0-.268.14-.526.395-.607A2 2 0 0114 3c0 .995-.182 1.948-.514 2.826-.204.54.166 1.174.744 1.174h2.52c1.243 0 2.261 1.01 2.146 2.247a23.864 23.864 0 01-1.341 5.974C17.153 16.323 16.072 17 14.9 17h-3.192a3 3 0 01-1.341-.317l-2.734-1.366A3 3 0 006.292 15H5V8h.963c.685 0 1.258-.483 1.612-1.068a4.011 4.011 0 012.166-1.73c.432-.143.853-.386 1.011-.814.16-.432.248-.9.248-1.388z" />
                      </svg>
                    </span>
                  </div>
                  <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                    <div>
                      <p class="text-sm text-gray-500">Advanced to phone screening by <a href="#"
                          class="font-medium text-gray-900">Bethany Blake</a></p>
                    </div>
                    <div class="whitespace-nowrap text-right text-sm text-gray-500">
                      <time datetime="2020-09-22">Sep 22</time>
                    </div>
                  </div>
                </div>
              </div>
            </li>

            <li>
              <div class="relative pb-8">
                <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                <div class="relative flex space-x-3">
                  <div>
                    <span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
                      <!-- Heroicon name: mini/check -->
                      <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                          d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                          clip-rule="evenodd" />
                      </svg>
                    </span>
                  </div>
                  <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                    <div>
                      <p class="text-sm text-gray-500">Completed phone screening with <a href="#"
                          class="font-medium text-gray-900">Martha Gardner</a></p>
                    </div>
                    <div class="whitespace-nowrap text-right text-sm text-gray-500">
                      <time datetime="2020-09-28">Sep 28</time>
                    </div>
                  </div>
                </div>
              </div>
            </li>

            <li>
              <div class="relative pb-8">
                <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                <div class="relative flex space-x-3">
                  <div>
                    <span class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white">
                      <!-- Heroicon name: mini/hand-thumb-up -->
                      <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor" aria-hidden="true">
                        <path
                          d="M1 8.25a1.25 1.25 0 112.5 0v7.5a1.25 1.25 0 11-2.5 0v-7.5zM11 3V1.7c0-.268.14-.526.395-.607A2 2 0 0114 3c0 .995-.182 1.948-.514 2.826-.204.54.166 1.174.744 1.174h2.52c1.243 0 2.261 1.01 2.146 2.247a23.864 23.864 0 01-1.341 5.974C17.153 16.323 16.072 17 14.9 17h-3.192a3 3 0 01-1.341-.317l-2.734-1.366A3 3 0 006.292 15H5V8h.963c.685 0 1.258-.483 1.612-1.068a4.011 4.011 0 012.166-1.73c.432-.143.853-.386 1.011-.814.16-.432.248-.9.248-1.388z" />
                      </svg>
                    </span>
                  </div>
                  <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                    <div>
                      <p class="text-sm text-gray-500">Advanced to interview by <a href="#"
                          class="font-medium text-gray-900">Bethany Blake</a></p>
                    </div>
                    <div class="whitespace-nowrap text-right text-sm text-gray-500">
                      <time datetime="2020-09-30">Sep 30</time>
                    </div>
                  </div>
                </div>
              </div>
            </li>

            <li>
              <div class="relative pb-8">
                <div class="relative flex space-x-3">
                  <div>
                    <span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
                      <!-- Heroicon name: mini/check -->
                      <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                          d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                          clip-rule="evenodd" />
                      </svg>
                    </span>
                  </div>
                  <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                    <div>
                      <p class="text-sm text-gray-500">Completed interview with <a href="#"
                          class="font-medium text-gray-900">Katherine Snyder</a></p>
                    </div>
                    <div class="whitespace-nowrap text-right text-sm text-gray-500">
                      <time datetime="2020-10-04">Oct 4</time>
                    </div>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>
        <div class="justify-stretch mt-6 flex flex-col">
          <button type="button"
            class="inline-flex items-center justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Advance
            to offer</button>
        </div>
      </div>
    </section>
  </div>
</div>
