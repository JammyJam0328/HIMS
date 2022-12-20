<div>
    <x-content>
        <x-table.head-actions>
            <x-slot:right>
                <x-button.primary href="{{ route('admin.rates.create') }}">
                    <svg xmlns="http://www.w3.org/2000/svg"
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
        <div>
            <x-table>
                <x-slot:header>
                    <x-table.head>Hours</x-table.head>
                    <x-table.head>Amount</x-table.head>
                    <x-table.head>Actions</x-table.head>
                </x-slot:header>
                @forelse ($types as $key=>$type)
                    <x-table.row>
                        <x-table.cell colspan="3"
                            class="text-center">
                            <span class="text-center font-semibold uppercase">{{ $type->name }}</span>
                        </x-table.cell>
                    </x-table.row>
                    @foreach ($type->rates as $rate)
                        <x-table.row>
                            <x-table.cell>
                                {{ $rate->stayingHour->hoursWithFormat() }}
                            </x-table.cell>
                            <x-table.cell>
                                ₱ {{ number_format($rate->amount, 2) }}
                            </x-table.cell>
                            <x-table.cell>
                                <div class="flex space-x-2">
                                    <x-table.edit-button
                                        href="{{ route('admin.rates.edit', ['rate' => $rate->id]) }}" />
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @endforeach
                @empty
                    <x-table.row>
                        <x-table.cell colspan="3"
                            class="text-center">No floors found.</x-table.cell>
                    </x-table.row>
                @endforelse
            </x-table>
        </div>
    </x-content>
</div>
