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
                                class="inline-flex items-center px-4 py-1 text-sm font-semibold text-white transition bg-yellow-500 rounded-full group hover:bg-yellow-600">
                                View
                                <svg class="mt-0.5 ml-2 -mr-1 stroke-white stroke-2"
                                    fill="none"
                                    width="10"
                                    height="10"
                                    viewBox="0 0 10 10"
                                    aria-hidden="true">
                                    <path class="transition opacity-0 group-hover:opacity-100"
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
                <div class="p-4 bg-green-100 rounded-lg">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto laborum quidem, facere
                    praesentium, asperiores distinctio nemo dolor sunt odit nam necessitatibus, temporibus debitis
                    officiis ullam magnam eum omnis alias reprehenderit?
                </div>
                <div class="p-4 bg-red-100 rounded-lg">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto laborum quidem, facere
                    praesentium, asperiores distinctio nemo dolor sunt odit nam necessitatibus, temporibus debitis
                    officiis ullam magnam eum omnis alias reprehenderit?
                </div>
            </div>
        </div>
    </div>
</div>
