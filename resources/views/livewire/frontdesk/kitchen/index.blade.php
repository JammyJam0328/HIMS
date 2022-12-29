<div>
    <x-content>
        <x-table.head-actions>
            <x-slot:left>
                <x-text-input wire:model.defer="search"
                    type="search"
                    placeholder="Search" />
                <x-select wire:model.defer="searchBy">
                    <option value="QRCODE">
                        QR CODE
                    </option>
                    <option value="ROOM_NUMBER">
                        ROOM NUMBER
                    </option>
                </x-select>
                <x-button.primary wire:click="search">
                    Search
                </x-button.primary>
            </x-slot:left>
        </x-table.head-actions>
        <div wire:key="guest">
            {{-- menu list --}}
        </div>
    </x-content>
</div>
