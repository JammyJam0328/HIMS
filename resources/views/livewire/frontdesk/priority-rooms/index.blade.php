<div x-data>
    <div class="bg-white">
        <div class="mx-auto grid gap-5">
            <h2 class="text-2xl font-bold tracking-tight text-green-700">
                PRIORITY ROOMS
            </h2>
            <ul role="list"
                class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-5">
                @forelse ($priorityRooms as $room)
                    <li class="col-span-1 divide-y divide-gray-200 rounded-lg border-2 border-green-500 bg-white shadow">
                        <div class="flex w-full items-center justify-between space-x-6 p-6">
                            <div class="flex-1 truncate">
                                <div class="flex items-center space-x-3">
                                    <h3 class="truncate text-lg font-bold text-gray-900">
                                        ROOM # {{ $room->number }}
                                    </h3>
                                </div>
                                <p class="mt-1 truncate text-sm text-gray-500">
                                    {{ $room->floor->numberWithFormat() }}
                                </p>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="currentColor"class="flex-shrink-0 w-10 h-10 text-green-600 rounded-full">
                                <path fill-rule="evenodd"
                                    d="M15.75 1.5a6.75 6.75 0 00-6.651 7.906c.067.39-.032.717-.221.906l-6.5 6.499a3 3 0 00-.878 2.121v2.818c0 .414.336.75.75.75H6a.75.75 0 00.75-.75v-1.5h1.5A.75.75 0 009 19.5V18h1.5a.75.75 0 00.53-.22l2.658-2.658c.19-.189.517-.288.906-.22A6.75 6.75 0 1015.75 1.5zm0 3a.75.75 0 000 1.5A2.25 2.25 0 0118 8.25a.75.75 0 001.5 0 3.75 3.75 0 00-3.75-3.75z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <div class="-mt-px flex divide-x divide-gray-200">
                                <div class="flex w-0 flex-1">
                                    <button type="button"
                                        x-on:click="$dispatch('confirm-remove-from-priority', { id : {{ $room->id }} })"
                                        class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center rounded-b-lg border border-transparent py-4 text-sm font-medium text-red-500 hover:text-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            fill="currentColor"
                                            class="h-6 w-6">
                                            <path fill-rule="evenodd"
                                                d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="ml-3">
                                            REMOVE FROM PRIORITY
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                @empty
                    <div class="py-10 text-center">
                        <h3 class="mt-2 text-sm font-medium text-gray-900">
                            No priority rooms
                        </h3>
                    </div>
                @endforelse
            </ul>

        </div>
        <div class="mx-auto mt-10 grid gap-5">
            <h2 class="text-2xl font-bold tracking-tight text-blue-700">
                AVAILABLE ROOMS
            </h2>
            <ul role="list"
                class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-5">
                @forelse ($availableRooms as $room)
                    <li class="col-span-1 divide-y divide-gray-200 rounded-lg border-2 border-blue-500 bg-white shadow">
                        <div class="flex w-full items-center justify-between space-x-6 p-6">
                            <div class="flex-1 truncate">
                                <div class="flex items-center space-x-3">
                                    <h3 class="truncate text-lg font-bold text-gray-900">
                                        ROOM # {{ $room->number }}
                                    </h3>
                                </div>
                                <p class="mt-1 truncate text-sm text-gray-500">
                                    {{ $room->floor->numberWithFormat() }}
                                </p>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="currentColor"class="flex-shrink-0 w-10 h-10 text-blue-600 rounded-full">
                                <path fill-rule="evenodd"
                                    d="M15.75 1.5a6.75 6.75 0 00-6.651 7.906c.067.39-.032.717-.221.906l-6.5 6.499a3 3 0 00-.878 2.121v2.818c0 .414.336.75.75.75H6a.75.75 0 00.75-.75v-1.5h1.5A.75.75 0 009 19.5V18h1.5a.75.75 0 00.53-.22l2.658-2.658c.19-.189.517-.288.906-.22A6.75 6.75 0 1015.75 1.5zm0 3a.75.75 0 000 1.5A2.25 2.25 0 0118 8.25a.75.75 0 001.5 0 3.75 3.75 0 00-3.75-3.75z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <div class="-mt-px flex divide-x divide-gray-200">
                                <div class="flex w-0 flex-1">
                                    <button type="button"
                                        x-on:click="$dispatch('confirm-add-to-priority', { id : {{ $room->id }} })"
                                        class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center rounded-b-lg border border-transparent py-4 text-sm font-medium text-blue-500 hover:text-blue-500">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            fill="currentColor"
                                            class="h-6 w-6">
                                            <path fill-rule="evenodd"
                                                d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="ml-3">
                                            ADD TO PRIORITY
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                @empty
                    <div class="py-10 text-center">
                        <h3 class="mt-2 text-sm font-medium text-gray-900">
                            No available rooms
                        </h3>
                    </div>
                @endforelse
            </ul>
        </div>
    </div>
    <x-confirm name="remove-from-priority"
        title="Confirm"
        message="Are you sure you want to remove this room from priority?"
        onConfirm="removeFromPriority(params.id)" />
    <x-confirm name="add-to-priority"
        title="Confirm"
        message="Are you sure you want to add this room to priority?"
        onConfirm="addToPriority(params.id)" />
</div>
