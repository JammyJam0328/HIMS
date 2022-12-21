<x-kitchen-layout>
  <div>
    <div class="sm:flex sm:items-center">
      <div class="sm:flex-auto flex space-x-2">
        <button>
          <svg class="h-6 w-6 text-red-600 hover:text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
          </svg>
        </button>

        <h1 class="text-xl font-semibold uppercase text-gray-600">ADD NEW MENU</h1>

      </div>
    </div>

    <livewire:kitchen.add-menu />
  </div>
</x-kitchen-layout>
