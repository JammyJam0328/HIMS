<div wire:ignore>
    <nav class="isolate flex divide-x divide-gray-200 rounded-lg border shadow"
        aria-label="Tabs">
        <a href="{{ route('frontdesk.transactions', ['guestId' => $guest->id]) }}"
            class="group relative min-w-0 flex-1 overflow-hidden rounded-l-lg bg-white px-4 py-4 text-center text-sm font-medium uppercase text-gray-900 hover:bg-gray-50 focus:z-10"
            aria-current="page">
            <span>Transactions</span>
            <span aria-hidden="true"
                @class([
                    'absolute inset-x-0 bottom-0 h-0.5',
                    'bg-gray-700' => request()->routeIs('frontdesk.transactions'),
                    'bg-transparent' => !request()->routeIs('frontdesk.transactions'),
                ])>
            </span>
        </a>

        <a href="{{ route('frontdesk.transactions.transfer-room', ['guest' => $guest->id]) }}"
            class="group relative min-w-0 flex-1 overflow-hidden bg-white px-4 py-4 text-center text-sm font-medium uppercase text-gray-900 hover:bg-gray-50 hover:text-gray-700 focus:z-10">
            <span>
                Transfer Room
            </span>
            <span aria-hidden="true"
                @class([
                    'absolute inset-x-0 bottom-0 h-0.5',
                    'bg-gray-700' => request()->routeIs('frontdesk.transactions.transfer-room'),
                    'bg-transparent' => !request()->routeIs(
                        'frontdesk.transactions.transfer-room'
                    ),
                ])>
            </span>
        </a>

        <a href="{{ route('frontdesk.transactions.extend', ['guest' => $guest->id]) }}"
            class="group relative min-w-0 flex-1 overflow-hidden bg-white px-4 py-4 text-center text-sm font-medium uppercase text-gray-900 hover:bg-gray-50 hover:text-gray-700 focus:z-10">
            <span>
                Extend
            </span>
            <span aria-hidden="true"
                @class([
                    'absolute inset-x-0 bottom-0 h-0.5',
                    'bg-gray-700' => request()->routeIs('frontdesk.transactions.extend'),
                    'bg-transparent' => !request()->routeIs('frontdesk.transactions.extend'),
                ])>
            </span>
        </a>
        <a href="{{ route('frontdesk.transactions.amenities', ['guest' => $guest->id]) }}"
            class="group relative min-w-0 flex-1 overflow-hidden bg-white px-4 py-4 text-center text-sm font-medium uppercase text-gray-900 hover:bg-gray-50 hover:text-gray-700 focus:z-10">
            <span>
                Amenities
            </span>
            <span aria-hidden="true"
                @class([
                    'absolute inset-x-0 bottom-0 h-0.5',
                    'bg-gray-700' => request()->routeIs('frontdesk.transactions.amenities'),
                    'bg-transparent' => !request()->routeIs('frontdesk.transactions.amenities'),
                ])>
            </span>
        </a>
        <a href="{{ route('frontdesk.transactions.damages', ['guest' => $guest->id]) }}"
            class="group relative min-w-0 flex-1 overflow-hidden rounded-r-lg bg-white px-4 py-4 text-center text-sm font-medium uppercase text-gray-900 hover:bg-gray-50 hover:text-gray-700 focus:z-10">
            <span>
                Damage
            </span>
            <span aria-hidden="true"
                @class([
                    'absolute inset-x-0 bottom-0 h-0.5',
                    'bg-gray-700' => request()->routeIs('frontdesk.transactions.damages'),
                    'bg-transparent' => !request()->routeIs('frontdesk.transactions.damages'),
                ])>
            </span>
        </a>
    </nav>
</div>
