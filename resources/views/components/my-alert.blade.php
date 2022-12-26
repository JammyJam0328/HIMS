<div x-data="{
    show: {{ session()->has('alert') ? 'true' : 'false' }},
    type: '{{ session('alert')['type'] ?? 'null' }}',
    title: '{{ session('alert')['title'] ?? 'null' }}',
    message: '{{ session('alert')['message'] ?? 'null' }}',
}"
    x-on:alert.window="show = true ; type = $event.detail.type ; title = $event.detail.title ; message = $event.detail.message">
    <div x-cloak
        x-show="show"
        class="relative z-10"
        aria-labelledby="modal-title"
        role="dialog"
        aria-modal="true">
        <div x-cloak
            x-show="show"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex items-end justify-center min-h-full p-4 text-center sm:items-center sm:p-0">

                <div x-cloak
                    x-show="show"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-bind:class="{
                        'border-2 border-green-500': type == 'success',
                        'border-2 border-red-500': type == 'error',
                        'border-2 border-blue-500': type == 'info',
                    }"
                    class="relative px-4 pt-5 pb-4 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
                    <div>
                        <template x-if="type=='success'">
                            <div class="flex items-center justify-center w-12 h-12 mx-auto bg-green-100 rounded-full">
                                <svg class="w-6 h-6 text-green-600"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    aria-hidden="true">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                            </div>
                        </template>
                        <template x-if="type=='error'">
                            <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"class="w-6 h-6 text-red-600">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 9v3.75m0-10.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.249-8.25-3.286zm0 13.036h.008v.008H12v-.008z" />
                                </svg>
                            </div>
                        </template>
                        <template x-if="type=='info'">
                            <div class="flex items-center justify-center w-12 h-12 mx-auto bg-blue-100 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    stroke="currentColor"class="w-6 h-6 text-red-600">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                                </svg>
                            </div>
                        </template>
                        <div class="mt-3 text-center sm:mt-5">
                            <h3 class="text-lg font-medium leading-6 text-gray-900"
                                id="modal-title"
                                x-text="title">\
                                {{-- title --}}
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500"
                                    x-text="message">
                                    {{-- message --}}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="flex mt-5 sm:mt-6">
                        <x-button x-on:click="show=false"
                            class="flex justify-center w-full">
                            <span>Close</span>
                        </x-button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
