<div id="userAccountDropdown"
    x-data="{ show: false }"
    x-on:click.away="show = false"
    x-on:keydown.escape="show = false"
    class="relative inline-block px-3 text-left">
    <div>
        <button type="button"
            x-on:click="show = !show"
            class="group w-full rounded-md bg-gray-100 px-3.5 py-2 text-left text-sm font-medium text-gray-700 focus:outline-none"
            id="options-menu-button"
            aria-expanded="false"
            aria-haspopup="true">
            <span class="flex items-center justify-between w-full">
                <span class="flex items-center justify-between min-w-0 space-x-3">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="flex-shrink-0 w-10 h-10 rounded-full">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="flex flex-col flex-1 min-w-0">
                        <span class="text-sm font-medium text-gray-900 truncate">
                            {{ auth()->user()->name }}
                        </span>
                        <span class="text-sm text-gray-500 truncate">
                            {{ auth()->user()->email }}
                        </span>
                    </span>
                </span>
                <!-- Heroicon name: mini/chevron-up-down -->
                <svg class="flex-shrink-0 w-5 h-5 text-gray-400 group-hover:text-gray-500"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                    aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z"
                        clip-rule="evenodd" />
                </svg>
            </span>
        </button>
    </div>
    <div x-cloak
        x-show="show"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute left-0 right-0 z-10 mx-3 mt-1 origin-top bg-white divide-y divide-gray-200 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
        role="menu"
        aria-orientation="vertical"
        aria-labelledby="options-menu-button"
        tabindex="-1">
        <div class="py-1"
            role="none">
            <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
            <a href="#"
                class="block px-4 py-2 text-sm text-gray-700"
                role="menuitem"
                tabindex="-1"
                id="options-menu-item-0">View profile</a>
            <a href="#"
                class="block px-4 py-2 text-sm text-gray-700"
                role="menuitem"
                tabindex="-1"
                id="options-menu-item-1">Settings</a>
            <a href="#"
                class="block px-4 py-2 text-sm text-gray-700"
                role="menuitem"
                tabindex="-1"
                id="options-menu-item-2">Notifications</a>
        </div>
        <div class="py-1"
            role="none">
            <a href="#"
                class="block px-4 py-2 text-sm text-gray-700"
                role="menuitem"
                tabindex="-1"
                id="options-menu-item-3">Get desktop app</a>
            <a href="#"
                class="block px-4 py-2 text-sm text-gray-700"
                role="menuitem"
                tabindex="-1"
                id="options-menu-item-4">Support</a>
        </div>
        <div class="py-1"
            role="none">
            <a href="#"
                class="block px-4 py-2 text-sm text-gray-700"
                role="menuitem"
                tabindex="-1"
                id="options-menu-item-5">Logout</a>
        </div>
    </div>
</div>
