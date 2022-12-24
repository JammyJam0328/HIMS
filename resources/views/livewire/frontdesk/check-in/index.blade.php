<div>
    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-12">
            <div class="flex items-center space-x-3">
                <x-text-input type="search"
                    wire:model.debounce.500ms="search"
                    placeholder="Search" />
                <x-select wire:model="searchBy">
                    <option value="QRCODE">
                        QR CODE
                    </option>
                    <option value="ROOM_NUMBER">
                        ROOM NUMBER
                    </option>
                </x-select>
            </div>
        </div>
        <div class="col-span-8">
            <x-table>
                <x-slot:header>
                    <x-table.head>
                        QR CODE
                    </x-table.head>
                    <x-table.head>
                        ROOM NUMBER
                    </x-table.head>
                    <x-table.head>
                        NAME
                    </x-table.head>
                    <x-table.head>
                        CONTACT NUMBER
                    </x-table.head>
                    <x-table.head>
                        ACTION
                    </x-table.head>
                </x-slot:header>
                @forelse ($guests as $guest)
                    <x-table.row>
                        <x-table.cell>
                            {{ $guest->qr_code }}
                        </x-table.cell>
                        <x-table.cell>
                            ROOM # {{ $guest->room_number }}
                        </x-table.cell>
                        <x-table.cell>
                            {{ $guest->name }}
                        </x-table.cell>
                        <x-table.cell>
                            {{ $guest->contact_number }}
                        </x-table.cell>
                        <x-table.cell>
                            <a type="button"
                                href="{{ route('frontdesk.check-in.view-guest', ['guest' => $guest->id]) }}"
                                class="group inline-flex items-center rounded-full bg-yellow-500 px-4 py-1 text-sm font-semibold text-white transition hover:bg-yellow-600">
                                View
                                <svg class="mt-0.5 ml-2 -mr-1 stroke-white stroke-2"
                                    fill="none"
                                    width="10"
                                    height="10"
                                    viewBox="0 0 10 10"
                                    aria-hidden="true">
                                    <path class="opacity-0 transition group-hover:opacity-100"
                                        d="M0 5h7"></path>
                                    <path class="transition group-hover:translate-x-[3px]"
                                        d="M1 1l4 4-4 4"></path>
                                </svg>
                            </a>
                        </x-table.cell>
                    </x-table.row>
                @empty
                    <x-table.row>
                        <x-table.cell colspan="4">
                            <div class="flex items-center justify-center">
                                <span class="text-gray-400">
                                    No data available
                                </span>
                            </div>
                        </x-table.cell>
                    </x-table.row>
                @endforelse
            </x-table>
        </div>
        <div class="col-span-4">
            <div class="grid gap-5">
                <div class="rounded-lg bg-green-100 p-3">
                    <div class="mb-3">
                        <h1 class="font-bold uppercase text-green-700">
                            Recent Check Ins
                        </h1>
                    </div>
                    <ul role="list"
                        class="divide-y divide-gray-200">
                        @forelse ($recentCheckIns as $recentCheckIn)
                            <li class="flex justify-between rounded-lg border border-green-500 p-2">
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">
                                        {{ $recentCheckIn->name }}
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        {{ $recentCheckIn->qr_code }}
                                    </p>
                                </div>
                                <span class="font-semibold text-green-600">
                                    ROOM # {{ $recentCheckIn->room_number }}
                                </span>
                            </li>
                        @empty
                            <li class="flex py-4">
                                <div class="ml-3">
                                    <p class="text-center text-sm font-medium text-gray-900">
                                        No recent check-ins
                                    </p>
                                </div>
                            </li>
                        @endforelse
                    </ul>
                </div>
                <div class="rounded-lg bg-red-100 p-3">
                    <div class="mb-3">
                        <h1 class="font-bold uppercase text-red-700">
                            TERMINATED GUESTS
                        </h1>
                    </div>
                    <ul role="list"
                        class="divide-y divide-gray-200">
                        @forelse ($terminatedGuests as $terminatedGuest)
                            <li class="flex justify-between rounded-lg border border-red-500 p-2">
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">
                                        {{ $terminatedGuest->name }}
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        {{ $terminatedGuest->qr_code }}
                                    </p>
                                </div>
                                <span class="font-semibold text-red-600">
                                    ROOM # {{ $terminatedGuest->room_number }}
                                </span>
                            </li>
                        @empty
                            <li class="flex py-4">
                                <div class="ml-3">
                                    <p class="text-center text-sm font-medium text-gray-900">
                                        No records found
                                    </p>
                                </div>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
