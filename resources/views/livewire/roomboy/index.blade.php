<div x-data>
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
</div>
