<div
    class="hidden lg:fixed lg:inset-y-0 lg:flex lg:w-64 lg:flex-col lg:border-r lg:border-gray-200 lg:bg-gray-100 lg:pt-5 lg:pb-4">
    <div class="flex flex-shrink-0 items-center px-6">

    </div>
    <!-- Sidebar component, swap this element with another sidebar if you like -->
    <div class="mt-5 flex h-0 flex-1 flex-col overflow-y-auto pt-1">
        <!-- User account dropdown -->
        <x-admin-sidebar.user-account-dropdown />
        <!-- Navigation -->
        <nav class="mt-6 space-y-4 px-3">
            <x-admin-sidebar.administrator-nav />
            <x-admin-sidebar.manage-nav />
        </nav>
    </div>
</div>
