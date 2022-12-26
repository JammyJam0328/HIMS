<div>
    <div class="grid w-full gap-4">
        <div class="grid gap-5">
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
                                <x-button.danger>
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
                                <x-button.danger>
                                    Clean
                                </x-button.danger>
                            </x-table.cell>
                        </x-table.row>
                    @endforeach
                </x-table>
            </div>
        </div>
    </div>
</div>
