<x-kitchen-layout>
  <div>
    <div class="sm:flex sm:items-center">
      <div class="sm:flex-auto flex items-center space-x-2">
        <a href="{{ route('kitchen.inventory') }}">
          <svg class="h-6 w-6 text-red-600 hover:text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
          </svg>
        </a>

        <h1 class="text-2xl font-bold uppercase text-gray-500">ADD NEW MENU</h1>

      </div>
    </div>

    <livewire:kitchen.add-menu />
  </div>
</x-kitchen-layout>
