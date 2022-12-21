<div>
  <div class="mt-6 w-96">
    <div>
      <label for="email" class="block text-sm font-medium text-gray-700">Category Name</label>
      <div class="mt-1">
        <input type="text" wire:model.defer="name"
          class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
          placeholder="name">
      </div>
      @error('name')
        <span class="text-red-500 mt-1 text-sm">{{ $message }}</span>
      @enderror
    </div>
    <div class="mt-3 flex space-x-2">
      @if ($updateMode == false)
        <button wire:click="addCategory">
          <span
            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
            Add Category
          </span>
        </button>
      @else
        <button wire:click="cancelUpdate">
          <span
            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-red-400  focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
            Cancel
          </span>
        </button>
        <button wire:click="updateCategory">
          <span
            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
            Update Category
          </span>
        </button>
      @endif
    </div>
  </div>
  <div class="mt-7 border-t-2 py-3">
    <div class="px-4 sm:px-6 lg:px-8">

      <div class="mt-3 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="inline-block min-w-full py-2 align-middle">
            <div class="overflow-hidden shadow-sm ring-1 ring-black ring-opacity-5">
              <table class="min-w-full divide-y divide-gray-300">
                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col"
                      class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8 uppercase">
                      Name</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold uppercase text-gray-900">
                      total menu</th>
                    <th scope="col" class="relative py-3.5 pl-3 pr-4 text-right  sm:pr-6 lg:pr-8 uppercase">
                      <span>Actions</span>
                    </th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                  @foreach ($categories as $category)
                    <tr>
                      <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">
                        {{ $category->name }}</td>
                      <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $category->menus_count }}</td>
                      <td
                        class="relative whitespace-nowrap py-4 pl-3 pr-5 text-right text-sm font-medium sm:pr-6 lg:pr-8">
                        <a href="#" wire:click="editCategory({{ $category->id }})"
                          class="text-green-600 hover:text-indigo-900 flex items-center justify-end ">
                          <div class="flex  space-x-1 items-end"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                              viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                              <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>

                            <span>Edit</span>
                          </div>
                        </a>
                      </td>
                    </tr>
                  @endforeach

                  <!-- More people... -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
