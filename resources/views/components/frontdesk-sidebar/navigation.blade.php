<div class="rounded-lg">
    <div class="space-y-1">
        <a href="{{ route('frontdesk.dashboard') }}"
            @class([
                'group flex items-center rounded-md  px-2 py-2 text-sm font-medium  ',
                'bg-green-600 text-white' => request()->is('frontdesk/dashboard*'),
                'hover:bg-white hover:text-gray-800 text-gray-700 bg-transparent' => !request()->is(
                    'frontdesk/dashboard*'
                ),
            ])>
            <svg xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="flex-shrink-0 w-6 h-6 mr-3">
                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            Dashboard
        </a>
        <a href="{{ route('frontdesk.check-in') }}"
            @class([
                'group flex items-center rounded-md  px-2 py-2 text-sm font-medium  ',
                'bg-green-600 text-white' => request()->is('frontdesk/check-in*'),
                'hover:bg-white hover:text-gray-800 text-gray-700 bg-transparent' => !request()->is(
                    'frontdesk/check-in*'
                ),
            ])>
            <svg xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="flex-shrink-0 w-6 h-6 mr-3">
                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
            </svg>
            Check In
        </a>
        <a href="{{ route('frontdesk.transactions') }}"
            @class([
                'group flex items-center rounded-md  px-2 py-2 text-sm font-medium  ',
                'bg-green-600 text-white' => request()->is('frontdesk/transactions*'),
                'hover:bg-white hover:text-gray-800 text-gray-700 bg-transparent' => !request()->is(
                    'frontdesk/transactions*'
                ),
            ])>
            <svg xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="flex-shrink-0 w-6 h-6 mr-3">
                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
            </svg>
            Transactions
        </a>
        <a href="{{ route('frontdesk.kitchen') }}"
            @class([
                'group flex items-center rounded-md  px-2 py-2 text-sm font-medium  ',
                'bg-green-600 text-white' => request()->is('frontdesk/kitchen*'),
                'hover:bg-white hover:text-gray-800 text-gray-700 bg-transparent' => !request()->is(
                    'frontdesk/kitchen*'
                ),
            ])>
            <svg xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="flex-shrink-0 w-6 h-6 mr-3">
                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z" />
            </svg>
            Kitchen
        </a>
        <a href="{{ route('frontdesk.check-out') }}"
            @class([
                'group flex items-center rounded-md  px-2 py-2 text-sm font-medium  ',
                'bg-green-600 text-white' => request()->is('frontdesk/check-out*'),
                'hover:bg-white hover:text-gray-800 text-gray-700 bg-transparent' => !request()->is(
                    'frontdesk/check-out*'
                ),
            ])>
            <svg xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="flex-shrink-0 w-6 h-6 mr-3">
                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
            </svg>

            Check Out
        </a>
        <a href="{{ route('frontdesk.room-monitoring') }}"
            @class([
                'group flex items-center rounded-md  px-2 py-2 text-sm font-medium  ',
                'bg-green-600 text-white' => request()->is('frontdesk/room-monitoring*'),
                'hover:bg-white hover:text-gray-800 text-gray-700 bg-transparent' => !request()->is(
                    'frontdesk/room-monitoring*'
                ),
            ])>
            <svg xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="flex-shrink-0 w-6 h-6 mr-3">
                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z" />
            </svg>
            Room Monitoring
        </a>
        <a href="{{ route('frontdesk.prioritizing-room') }}"
            @class([
                'group flex items-center rounded-md  px-2 py-2 text-sm font-medium  ',
                'bg-green-600 text-white' => request()->is('frontdesk/prioritizing-room*'),
                'hover:bg-white hover:text-gray-800 text-gray-700 bg-transparent' => !request()->is(
                    'frontdesk/prioritizing-room*'
                ),
            ])>
            <svg xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="flex-shrink-0 w-6 h-6 mr-3">
                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Priority Rooms
        </a>
    </div>
</div>
