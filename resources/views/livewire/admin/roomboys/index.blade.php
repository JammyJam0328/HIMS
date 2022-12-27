<div>
    <x-content>
        <x-table.head-actions>
            <x-slot:left>
                <x-text-input wire:model.debounce.500ms="search"
                    type="search"
                    placeholder="Search" />
                <div class="flex items-center space-x-1">
                    <span class="text-gray-700">
                        Floor :
                    </span>
                    <x-select wire:model="filterFloor">
                        <option value="">All</option>
                        @foreach ($floors as $floor)
                            <option value="{{ $floor->id }}">{{ $floor->numberWithFormat() }}</option>
                        @endforeach
                    </x-select>
                </div>
            </x-slot:left>
            <x-slot:right>
                <x-button.primary href="{{ route('admin.roomboys.create') }}">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-6 h-6 mr-2">
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
                <x-table.head>Name</x-table.head>
                <x-table.head>Email</x-table.head>
                <x-table.head>Assigned Floor</x-table.head>
                <x-table.head>Actions</x-table.head>
            </x-slot:header>
            @forelse ($users as $user)
                <x-table.row>
                    <x-table.cell>{{ $user->name }}</x-table.cell>
                    <x-table.cell>{{ $user->email }}</x-table.cell>
                    <x-table.cell>
                        {{ $user->room_boy_assigned_floor_id ? $user->roomBoyFloor->numberWithFormat() : 'N/A' }}
                    </x-table.cell>
                    <x-table.cell>
                        <div class="flex space-x-2">
                            <x-table.edit-button href="{{ route('admin.roomboys.edit', ['roomboy' => $user->id]) }}" />
                        </div>
                    </x-table.cell>
                </x-table.row>
            @empty
                <x-table.row>
                    <x-table.cell colspan="4"
                        class="text-center">No roomboy found.</x-table.cell>
                </x-table.row>
            @endforelse
            <x-slot:footer>
                {{ $users->links() }}
            </x-slot:footer>
        </x-table>
    </x-content>

</div>
