<x-kitchen-layout>
  <div>
    <div class="md:flex md:items-center md:justify-between">
      <div class="min-w-0 flex-1 flex space-x-2 items-center">
        <a href="{{ route('kitchen.inventory') }}">
          <span
            class="inline-flex items-center px-4 py-1 border border-transparent text-sm font-medium rounded-md shadow-sm text-red-400  hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
            Return
          </span>
        </a>
        <h2 class="text-2xl font-bold leading-7 text-gray-500 sm:truncate sm:text-2xl uppercase sm:tracking-tight">MANAGE
          CATEGORY</h2>
      </div>
    </div>
    <livewire:kitchen.category />
  </div>
</x-kitchen-layout>
