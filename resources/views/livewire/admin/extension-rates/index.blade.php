<div>
    <x-content>
        <x-table.head-actions>
            <x-slot:left>
                <x-text-input wire:model.debounce.500ms="search"
                    type="search"
                    placeholder="Search" />
            </x-slot:left>
            <x-slot:right>
                <x-button.primary href="{{ route('admin.extension-rates.create') }}">
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
                <x-table.head>Hours</x-table.head>
                <x-table.head>Amount</x-table.head>
                <x-table.head>Actions</x-table.head>
            </x-slot:header>
            @forelse ($extensionRates as $extensionRate)
                <x-table.row>
                    <x-table.cell>
                        {{ Str::plural($extensionRate->hour . ' hr', $extensionRate->hour) }}
                    </x-table.cell>
                    <x-table.cell>
                        ₱ {{ number_format($extensionRate->amount, 2) }}
                    </x-table.cell>
                    <x-table.cell>
                        <div class="flex space-x-2">
                            <x-table.edit-button
                                href="{{ route('admin.extension-rates.edit', ['extensionRate' => $extensionRate->id]) }}" />
                        </div>
                    </x-table.cell>
                </x-table.row>
            @empty
                <x-table.row>
                    <x-table.cell colspan="4"
                        class="text-center">No discount found.</x-table.cell>
                </x-table.row>
            @endforelse
            <x-slot:footer>
                {{ $extensionRates->links() }}
            </x-slot:footer>
        </x-table>

    </x-content>
</div>
