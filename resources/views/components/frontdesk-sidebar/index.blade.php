<div
    class="hidden lg:fixed lg:inset-y-0 lg:flex lg:w-64 lg:flex-col lg:border-r lg:border-gray-200 lg:bg-gray-100 lg:pt-5 lg:pb-4">
    <div class="flex items-center flex-shrink-0 p-3">
        <div class="flex items-center space-x-2">
            <x-svg.hotel class="w-10 h-10 text-gray-700" />
            <div class="pl-2 border-l-2 border-gray-700">
                <div class="text-2xl font-bold text-gray-700">HIMS</div>
                <div class="font-medium leading-3 text-gray-700 font-rubik">{{ auth()->user()->branch_name }}</div>
            </div>
        </div>
    </div>
    <!-- Sidebar component, swap this element with another sidebar if you like -->
    <div class="flex flex-col flex-1 h-0 pt-1 mt-5 overflow-y-auto">
        <!-- User account dropdown -->
        <x-frontdesk-sidebar.user-account-dropdown />
        <!-- Navigation -->
        <nav class="px-3 mt-6 space-y-4">
            <x-frontdesk-sidebar.navigation />
        </nav>
    </div>
</div>
