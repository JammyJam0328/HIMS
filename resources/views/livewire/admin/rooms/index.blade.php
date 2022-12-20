<div>
    <x-content>
        <x-table.head-actions>
            <x-slot:left>
                <div class="flex items-center space-x-2 border-r-2 border-gray-300 pr-2">
                    <span> Filters </span>
                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="h-6 w-6">
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
                    <x-select wire:model="statusFilter">
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
                    <x-select wire:model="floorFilter">
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
                    <x-select wire:model="typeFilter">
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
            <x-slot:right>
                <x-text-input placeholder="Search"
                    wire:model.debounce.500ms="searchQuery"
                    type="search" />
                <x-button.primary href="{{ route('admin.rooms.create') }}"><svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="mr-2 h-6 w-6">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Create
                </x-button.primary>
            </x-slot:right>
        </x-table.head-actions>
        <x-table>
            <x-slot:header>
                <x-table.head>Number</x-table.head>
                <x-table.head>Status</x-table.head>
                <x-table.head>Floor</x-table.head>
                <x-table.head>Type</x-table.head>
                <x-table.head>Actions</x-table.head>
            </x-slot:header>
            @forelse ($rooms as $room)
                <x-table.row>
                    <x-table.cell>{{ $room->numberWithFormat() }}</x-table.cell>
                    <x-table.cell>
                        <span
                            class="{{ $room->statusClass() }} inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium">
                            {{ $room->statusWithFormat() }}</span>
                    </x-table.cell>
                    <x-table.cell>{{ $room->floor->numberWithFormat() }}</x-table.cell>
                    <x-table.cell>{{ $room->type->name }}</x-table.cell>
                    <x-table.cell>
                        <div class="flex space-x-2">
                            <x-table.edit-button href="{{ route('admin.rooms.edit', ['room' => $room->id]) }}" />
                        </div>
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
