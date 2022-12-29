<div>
  <div class="mt-8 border-2 rounded-xl p-5 px-10 max-w-7xl mx-auto border-gray-200">
    <div>
      <h3 class="text-lg font-medium leading-6 text-gray-900">Menu Information</h3>
    </div>
    <div class="mt-5 border-t border-gray-200">
      <dl class="divide-y divide-gray-200">
        <div class="py-4 sm:grid sm:grid-cols-3 place-content-center sm:gap-4 sm:py-5">
          <dt class="text-sm font-medium text-gray-600 uppercase">Employee Name</dt>
          <dd class="flex text-sm text-gray-900 sm:col-span-2 sm:mt-0">
            <div class="">
              <input type="text" wire:model.defer="name"
                class="block w-64 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                placeholder="name">
              @error('name')
                <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p>
              @enderror
            </div>

          </dd>
        </div>
        <div class="py-4 sm:grid sm:grid-cols-3 place-content-center sm:gap-4 sm:py-5">
          <dt class="text-sm font-medium text-gray-600 uppercase">Description</dt>
          <dd class="flex text-sm text-gray-900 sm:col-span-2 sm:mt-0">
            <div>
              <div class="mt-1">
                <textarea rows="4" wire:model.defer="description"
                  class="block w-64 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
              </div>
              @error('description')
                <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p>
              @enderror
            </div>

          </dd>
        </div>
        <div class="py-4 sm:grid sm:grid-cols-3 place-content-center sm:gap-4 sm:py-5">
          <dt class="text-sm font-medium text-gray-600 uppercase">Amount</dt>
          <dd class="flex flex-col text-sm text-gray-900 sm:col-span-2 sm:mt-0">

            <div class="relative w-64 mt-1 rounded-md">
              <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                <span class="text-gray-500 sm:text-sm">&#8369;</span>
              </div>
              <input type="number" wire:model.defer="amount"
                class="block w-full rounded-md border-gray-300 pl-7 pr-12 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                placeholder="0.00" aria-describedby="price-currency">
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                <span class="text-gray-500 sm:text-sm" id="price-currency">PHP</span>
              </div>

            </div>
            @error('amount')
              <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p>
            @enderror
          </dd>
        </div>
        <div class="py-4 sm:grid sm:grid-cols-3 place-content-center sm:gap-4 sm:py-5">
          <dt class="text-sm font-medium text-gray-600 uppercase">Category</dt>
          <dd class="flex flex-col text-sm text-gray-900 sm:col-span-2 sm:mt-0">
            <select wire:model.defer="category_id"
              class="block w-64 rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
              <option selected hidden>Select Category</option>
              @forelse ($categories as $category)
                <option class="uppercase" value="{{ $category->id }}">{{ $category->name }}</option>
              @empty
              @endforelse
            </select>
            @error('category')
              <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p>
            @enderror
          </dd>
        </div>


      </dl>
    </div>
    <div class="flex justify-end space-x-2">
      <button wire:click="">
        <span
          class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-red-400 bg-gray-50 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
          Cancel
        </span>
      </button>
      <button wire:click="addExpense">
        <span
          class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
          Add Expense
        </span>
      </button>
    </div>
  </div>
</div>
