<div class="grid gap-5">
    <div class="bg-white">
        <div>
            <div class="flex items-center justify-between px-4 sm:px-6 lg:px-0">
                <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                    Priority Rooms
                </h2>
            </div>
            <div class="relative mt-6">
                <div class="relative -mb-6 w-full overflow-x-auto pb-6">
                    <ul role="list"
                        class="mx-4 inline-flex space-x-8 sm:mx-6 lg:mx-0 lg:grid lg:grid-cols-4 lg:gap-x-8 lg:space-x-0">
                        <li class="inline-flex w-40 flex-col rounded-lg border bg-green-600 p-3 text-center">
                            <div class="group relative">
                                <div
                                    class="aspect-w-1 aspect-h-1 flex w-full justify-center overflow-hidden rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="h-12 w-12 text-white">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" />
                                    </svg>
                                </div>
                                <div class="mt-6">
                                    <h3 class="mt-1 font-semibold">
                                        <div>
                                            <h1 class="text-xl text-white">
                                                ROOM # 1
                                            </h1>
                                        </div>
                                    </h3>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="relative">
        <div class="absolute inset-0 flex items-center"
            aria-hidden="true">
            <div class="w-full border-t border-gray-300"></div>
        </div>
        <div class="relative flex justify-center">
            <span class="bg-white px-2 text-sm text-gray-500">
                {{ auth()->user()->branch_name }}
            </span>
        </div>
    </div>
    <div class="bg-white">
        <div>
            <div class="flex items-center justify-between px-4 sm:px-6 lg:px-0">
                <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                    Available Rooms
                </h2>
            </div>
            <div class="relative mt-6">
                <div class="relative -mb-6 w-full overflow-x-auto pb-6">
                    <ul role="list"
                        class="mx-4 inline-flex space-x-8 sm:mx-6 lg:mx-0 lg:grid lg:grid-cols-6 lg:gap-x-8 lg:space-x-0">
                        <li
                            class="col-span-1 divide-y divide-blue-600 rounded-lg border border-blue-500 bg-blue-100 shadow">
                            <div class="flex w-full items-center justify-between space-x-6 p-6">
                                <div class="flex-1 truncate">
                                    <div class="flex items-center space-x-3">
                                        <h3 class="truncate text-center text-lg font-bold text-blue-600">
                                            ROOM # 1
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="-mt-px flex divide-x divide-gray-200">
                                    <div class="-ml-px flex w-0 flex-1">
                                        <button type="button"
                                            class="relative inline-flex w-0 flex-1 items-center justify-center rounded-br-lg border border-transparent py-4 text-sm font-medium text-gray-700 hover:text-gray-500">
                                            <span>
                                                MOVE TO PRIORITY
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
