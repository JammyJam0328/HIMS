<x-kitchen-layout>
  <div>
    <div class="sm:flex sm:items-center">
      <div class="sm:flex-auto">
        <h1 class="text-xl font-semibold uppercase text-gray-900">Inventory</h1>
        <p class="mt-2 text-sm text-gray-700">A list of all the menus and their stocks.</p>
      </div>
      <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
        <div class="flex space-x-2">
          <a href="{{ route('kitchen.category') }}"
            class="inline-flex items-center justify-center rounded-md border border-transparent bg-gray-500 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 sm:w-auto">Manage
            Category</a>
          <a href="{{ route('kitchen.add-inventory') }}"
            class="inline-flex items-center justify-center rounded-md border border-transparent bg-green-500 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 sm:w-auto">Add
            New</a>
        </div>
      </div>
    </div>
    <livewire:kitchen.inventory />
  </div>
</x-kitchen-layout>
