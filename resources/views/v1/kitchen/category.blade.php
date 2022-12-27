<x-kitchen-layout>
  <div>
    <div class="md:flex md:items-center md:justify-between">
      <div class="min-w-0 flex-1 flex space-x-2 items-center">
        <a href="{{ route('kitchen.inventory') }}">
          <svg class="h-6 w-6 text-red-600 hover:text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
          </svg>
        </a>
        <h2 class="text-2xl font-bold leading-7 text-gray-500 sm:truncate sm:text-2xl uppercase sm:tracking-tight">
          MANAGE
          CATEGORY</h2>
      </div>
    </div>
    <livewire:kitchen.category />
  </div>
</x-kitchen-layout>
