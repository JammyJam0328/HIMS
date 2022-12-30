<div>
    <x-content>
        <x-table.head-actions>
            <x-slot:left>
                <div class="flex items-center pr-2 space-x-2 border-r-2 border-gray-300">
                    <span> Filters </span>
                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-6 h-6">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" />
                    </svg>
                </div>
                <div wire:key="1filter"
                    class="flex items-center space-x-3">
                    <span class="text-gray-700">
                        Status :
                    </span>
                    <x-select wire:model="filterStatus">
                        <option value=""
                            selected>ALL</option>
                        @foreach ($statuses as $key => $status)
                            <option value="{{ $key }}">
                                <span class="uppercase"> {{ str_replace('_', ' ', $status) }}</span>
                            </option>
                        @endforeach
                    </x-select>
                </div>
                <div wire:key="2filter"
                    class="flex items-center space-x-3">
                    <span class="text-gray-700">
                        Floor :
                    </span>
                    <x-select wire:model="filterFloor">
                        <option value=""
                            selected>ALL</option>
                        @foreach ($floors as $floor)
                            <option value="{{ $floor->id }}">
                                {{ $floor->numberWithFormat() }}
                            </option>
                        @endforeach
                    </x-select>
                </div>
                <div wire:key="3filter"
                    class="flex items-center space-x-3">
                    <span class="text-gray-700">
                        Type :
                    </span>
                    <x-select wire:model="filterType">
                        <option value=""
                            selected>ALL</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}">
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </x-select>
                </div>
            </x-slot:left>
        </x-table.head-actions>
        <x-table>
            <x-slot:header>
                <x-table.head>Number</x-table.head>
                <x-table.head>Status</x-table.head>
                <x-table.head>CHECK OUT TIME</x-table.head>
                <x-table.head>TIME TO CLEAN</x-table.head>
            </x-slot:header>
            @forelse ($rooms as $room)
                <x-table.row>
                    <x-table.cell>{{ $room->numberWithFormat() }}</x-table.cell>
                    <x-table.cell>
                        <span
                            class="{{ $room->statusClass() }} inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium">
                            {{ $room->statusWithFormat() }}</span>
                    </x-table.cell>
                    <x-table.cell>
                        @if ($room->status == \App\Models\Room::OCCUPIED)
                            @php
                                $checkOutTime = Carbon\Carbon::parse($room->check_out_time);
                            @endphp
                            @if (!$checkOutTime->isPast())
                                <x-countdown :expires="$checkOutTime">
                                    <div class="flex space-x-2"
                                        x-bind:class="timer.hours == '00' ? 'text-red-600' :
                                            'text-green-600'">
                                        <div class="flex space-x-1">
                                            <span x-text="timer.days">{{ $component->days() }}</span>
                                            <span> days -</span>
                                        </div>
                                        <div class="flex space-x-1">
                                            <span x-text="timer.hours">{{ $component->hours() }}</span>
                                            <span> hours -</span>
                                        </div>
                                        <div class="flex space-x-1">
                                            <span x-text="timer.minutes">{{ $component->minutes() }}</span>
                                            <span> minutes -</span>
                                        </div>
                                        <div class="flex space-x-1">
                                            <span x-text="timer.seconds">{{ $component->seconds() }}</span>
                                            <span>seconds</span>
                                        </div>
                                    </div>
                                </x-countdown>
                            @else
                                <span class="text-red-600">
                                    Check out overdue
                                </span>
                            @endif
                        @else
                            <span class="text-red-600">
                                N/A
                            </span> (Room is {{ \App\Models\ROOM::STATUSES[$room->status] }})
                        @endif
                    </x-table.cell>
                    <x-table.cell>
                        @if ($room->status == \App\Models\Room::UNCLEAN)
                            @php
                                $timeToClean = Carbon\Carbon::parse($room->time_to_clean);
                            @endphp
                            @if (!$timeToClean->isPast())
                                <x-countdown class="text-xl font-extrabold text-red-600"
                                    :expires="$timeToClean" />
                            @else
                                <span class="text-red-600">
                                    Cleaning overdue
                                </span>
                            @endif
                        @else
                            <span class="text-red-600">
                                N/A
                            </span> (Room is {{ \App\Models\ROOM::STATUSES[$room->status] }})
                        @endif
                    </x-table.cell>
                </x-table.row>
            @empty
                <x-table.row>
                    <x-table.cell colspan="4"
                        class="text-center">No rooms found.</x-table.cell>
                </x-table.row>
            @endforelse
            <x-slot:footer>
                {{ $rooms->links() }}
            </x-slot:footer>
        </x-table>
    </x-content>
</div>

{{-- <div class="grid gap-5">
    <div class="bg-white">
        <div>
            <div class="flex items-center justify-between px-4 sm:px-6 lg:px-0">
                <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                    Priority Rooms
                </h2>
            </div>
            <div class="relative mt-6">
                <div class="relative w-full pb-6 -mb-6 overflow-x-auto">
                    <ul role="list"
                        class="inline-flex mx-4 space-x-8 sm:mx-6 lg:mx-0 lg:grid lg:grid-cols-4 lg:gap-x-8 lg:space-x-0">
                        <li class="inline-flex flex-col w-40 p-3 text-center bg-green-600 border rounded-lg">
                            <div class="relative group">
                                <div
                                    class="flex justify-center w-full overflow-hidden rounded-md aspect-w-1 aspect-h-1">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="w-12 h-12 text-white">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" />
                                    </svg>
                                </div>
                                <div class="mt-6">
                                    <h3 class="mt-1 font-semibold">
                                        <div>
                                            <h1 class="text-xl text-white">
                                                ROOM # 1
                                            </h1>
                                        </div>
                                    </h3>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="relative">
        <div class="absolute inset-0 flex items-center"
            aria-hidden="true">
            <div class="w-full border-t border-gray-300"></div>
        </div>
        <div class="relative flex justify-center">
            <span class="px-2 text-sm text-gray-500 bg-white">
                {{ auth()->user()->branch_name }}
            </span>
        </div>
    </div>
    <div class="bg-white">
        <div>
            <div class="flex items-center justify-between px-4 sm:px-6 lg:px-0">
                <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                    Available Rooms
                </h2>
            </div>
            <div class="relative mt-6">
                <div class="relative w-full pb-6 -mb-6 overflow-x-auto">
                    <ul role="list"
                        class="inline-flex mx-4 space-x-8 sm:mx-6 lg:mx-0 lg:grid lg:grid-cols-6 lg:gap-x-8 lg:space-x-0">
                        <li
                            class="col-span-1 bg-blue-100 border border-blue-500 divide-y divide-blue-600 rounded-lg shadow">
                            <div class="flex items-center justify-between w-full p-6 space-x-6">
                                <div class="flex-1 truncate">
                                    <div class="flex items-center space-x-3">
                                        <h3 class="text-lg font-bold text-center text-blue-600 truncate">
                                            ROOM # 1
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="flex -mt-px divide-x divide-gray-200">
                                    <div class="flex flex-1 w-0 -ml-px">
                                        <button type="button"
                                            class="relative inline-flex items-center justify-center flex-1 w-0 py-4 text-sm font-medium text-gray-700 border border-transparent rounded-br-lg hover:text-gray-500">
                                            <span>
                                                MOVE TO PRIORITY
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div> --}}
