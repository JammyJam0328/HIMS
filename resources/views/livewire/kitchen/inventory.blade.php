<div x-data="{ addStocks: @entangle('stocks_modal') }">
  <div class="mt-8 hidden sm:block">
    <div class="inline-block min-w-full border-b border-gray-200 align-middle">
      <table class="min-w-full">
        <thead>
          <tr class=" border-t">
            <th class="border-b border-gray-200  px-6 py-3 text-left text-sm font-semibold text-gray-700" scope="col">
              <span class="lg:pl-2">NAME</span>
            </th>
            <th class="border-b border-gray-200  px-6 py-3 text-left text-sm font-semibold text-gray-700" scope="col">
              STOCKS</th>
            <th
              class="hidden border-b border-gray-200  px-6 py-3 text-left text-sm font-semibold text-gray-900 md:table-cell"
              scope="col">NO. OF SERVINGS</th>
            <th class="border-b border-gray-200  py-3 pr-6 text-right text-sm font-semibold text-gray-900"
              scope="col"></th>
          </tr>

        </thead>
        <tbody class="divide-y divide-gray-100 bg-white">
          @foreach ($categories as $category)
            <tr class="border-t border-gray-200">
              <th colspan="4"
                class="border-b border-gray-200 bg-gray-50  px-6 py-3 text-left text-sm font-semibold text-green-700"
                scope="col">
                <span class="lg:pl-2 uppercase flex space-x-2 items-end ">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M6.429 9.75L2.25 12l4.179 2.25m0-4.5l5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0l4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0l-5.571 3-5.571-3" />
                  </svg>

                  <span>{{ $category->name }}</span>
                </span>
              </th>
            </tr>
            @forelse ($category->menus as $menu)
              <tr>
                <td class="w-full max-w-0 whitespace-nowrap px-6 py-3 text-sm font-medium text-gray-900">
                  <div class="flex items-center space-x-3 lg:pl-2">
                    <div class="flex-shrink-0 w-2.5 h-2.5 rounded-full bg-pink-600" aria-hidden="true"></div>
                    <span class="text-md text-gray-600">{{ $menu->name }}</span>
                  </div>
                </td>
                <td class="px-6 py-3 text-sm font-medium text-gray-600">
                  <div class="flex items-center space-x-2">
                    <span class="flex-shrink-0 text-sm text-center font-bold leading-5">
                      {{ $menu->menuInventory->stocks }}
                    </span>
                  </div>
                </td>
                <td class="hidden whitespace-nowrap px-6 py-3 text-center text-sm text-gray-600 md:table-cell">
                  <span class="font-bold">{{ $menu->menuInventory->total_servings }}</span>
                </td>
                <td class="whitespace-nowrap px-6 py-3 text-right text-sm font-medium">
                  <button wire:click="manageStocks({{ $menu->menuInventory->id }})"
                    class="text-indigo-600 hover:text-indigo-900">Add Stocks</button>
                </td>
              </tr>
            @empty
              <td colspan="4" class="w-full max-w-0 whitespace-nowrap px-6 py-3 text-sm text-gray-900">
                <div class="flex justify-center space-x-1 items-end">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6 text-red-500">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  <span>No Available data...</span>
                </div>
              </td>
            @endforelse
          @endforeach

          <!-- More projects... -->
        </tbody>
      </table>
    </div>
  </div>

  <div x-show="addStocks" x-cloak class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <!--
      Background backdrop, show/hide based on modal state.
  
      Entering: "ease-out duration-300"
        From: "opacity-0"
        To: "opacity-100"
      Leaving: "ease-in duration-200"
        From: "opacity-100"
        To: "opacity-0"
    -->
    <div x-show="addStocks" x-cloak x-transition:enter="transition ease-out duration-300"
      x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
      x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
      x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

    <div class="fixed inset-0 z-10 overflow-y-auto">
      <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <!--
          Modal panel, show/hide based on modal state.
  
          Entering: "ease-out duration-300"
            From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            To: "opacity-100 translate-y-0 sm:scale-100"
          Leaving: "ease-in duration-200"
            From: "opacity-100 translate-y-0 sm:scale-100"
            To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        -->
        <div x-show="addStocks" x-cloak x-transition:enter="transition ease-out duration-300"
          x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
          x-transition:leave="transition ease-in duration-200"
          x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
          x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
          <div>
            <div class="flex justify-between">
              <div class="flex space-x-2 items-center text-green-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 002.25-2.25V6a2.25 2.25 0 00-2.25-2.25H6A2.25 2.25 0 003.75 6v2.25A2.25 2.25 0 006 10.5zm0 9.75h2.25A2.25 2.25 0 0010.5 18v-2.25a2.25 2.25 0 00-2.25-2.25H6a2.25 2.25 0 00-2.25 2.25V18A2.25 2.25 0 006 20.25zm9.75-9.75H18a2.25 2.25 0 002.25-2.25V6A2.25 2.25 0 0018 3.75h-2.25A2.25 2.25 0 0013.5 6v2.25a2.25 2.25 0 002.25 2.25z" />
                </svg>
                <h1 class="font-semibold text-lg uppercase">Add Stocks</h1>
              </div>
              <button wire:click="$set('stocks_modal', false)" class="hover:text-red-500 text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>

              </button>
            </div>
            <div class="my-10">
              <input type="number" wire:model.defer="new_stocks"
                class="w-full border-2  rounded-lg text-center text-3xl" placeholder="0">
            </div>
          </div>
          <div class="mt-5 sm:mt-6">
            <button type="button" wire:click="saveStocks"
              class="inline-flex w-full justify-center rounded-md border border-transparent bg-gray-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 sm:text-sm">ADD</button>
          </div>
        </div>
      </div>
    </div>
  </div>


</div>
