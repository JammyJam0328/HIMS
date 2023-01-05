<div>
  <div class="mx-auto mt-20 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="mb-10 grid justify-center">
      <span class="text-3xl font-bold text-gray-700">
        {{ auth()->user()->branch_name }}
      </span>
      <span class="text-center text-2xl font-semibold text-green-700">FRONT DESK SHIFTING</span>
    </div>
    <div class="mx-auto grid max-w-5xl gap-5">
      <div wire:key="selecteds">
        @if (count($selectedIds) > 0)
          <div class="grid gap-3">
            <x-table>
              @forelse ($selecteds as $frontdesk)
                <x-table.row>
                  <x-table.cell>
                    {{ $frontdesk->unique_id }}
                  </x-table.cell>
                  <x-table.cell>
                    {{ $frontdesk->name }}
                  </x-table.cell>
                  <x-table.cell>
                    {{ $frontdesk->contact_number }}
                  </x-table.cell>
                  <x-table.cell>
                    {{ $frontdesk->email }}
                  </x-table.cell>
                  <x-table.cell>
                    <div>
                      <button wire:key="{{ $frontdesk->id }}remover" wire:click="select({{ $frontdesk->id }})"
                        type="button"
                        class="group inline-flex items-center rounded-full bg-red-500 px-4 py-1 text-sm font-semibold text-white transition hover:bg-red-600">
                        REMOVE
                      </button>
                    </div>
                  </x-table.cell>
                </x-table.row>
              @empty
                <x-table.row>
                  <x-table.cell colspan="4">
                    <div class="text-center">
                      No frontdesk record in this branch
                    </div>
                  </x-table.cell>
                </x-table.row>
              @endforelse
            </x-table>
            <x-button.primary
              x-on:click=" if(confirm('Are you sure you want to start shift?')){
                                    $wire.startShift();
                                } "
              class="justify-center">
              <span class="text-xl"> START SHIFT</span>
            </x-button.primary>
          </div>
        @endif
      </div>
      <div class="relative">
        <div class="absolute inset-0 flex items-center" aria-hidden="true">
          <div class="w-full border-t border-gray-300"></div>
        </div>
        <div class="relative flex justify-center">
          <span class="bg-white px-2 text-sm text-gray-500">FRONTDESKS</span>
        </div>
      </div>
      <div class="flex items-center space-x-4">
        <x-text-input placeholder="Search" type="search" />
      </div>
      <div wire:key="frontdesks">
        <x-table>
          <x-slot:header>
            <x-table.head>
              EMPLOYEE ID
            </x-table.head>
            <x-table.head>
              NAME
            </x-table.head>
            <x-table.head>
              CONTACT NUMBER
            </x-table.head>
            <x-table.head>
              EMAIL
            </x-table.head>
            <x-table.head>
              ACTIONS
            </x-table.head>
          </x-slot:header>
          @forelse ($frontdesks as $frontdesk)
            <x-table.row>
              <x-table.cell>
                {{ $frontdesk->unique_id }}
              </x-table.cell>
              <x-table.cell>
                {{ $frontdesk->name }}
              </x-table.cell>
              <x-table.cell>
                {{ $frontdesk->contact_number }}
              </x-table.cell>
              <x-table.cell>
                {{ $frontdesk->email }}
              </x-table.cell>
              <x-table.cell>
                <div>

                  <button wire:key="{{ $frontdesk->id }}select" wire:click="select({{ $frontdesk->id }})"
                    type="button"
                    class="group inline-flex items-center rounded-full bg-yellow-500 px-4 py-1 text-sm font-semibold text-white transition hover:bg-yellow-600">
                    SELECT
                    <svg class="mt-0.5 ml-2 -mr-1 stroke-white stroke-2" fill="none" width="10" height="10"
                      viewBox="0 0 10 10" aria-hidden="true">
                      <path class="opacity-0 transition group-hover:opacity-100" d="M0 5h7"></path>
                      <path class="transition group-hover:translate-x-[3px]" d="M1 1l4 4-4 4"></path>
                    </svg>
                  </button>

                </div>
              </x-table.cell>
            </x-table.row>
          @empty
            <x-table.row>
              <x-table.cell colspan="4">
                <div class="text-center">
                  No frontdesk record in this branch
                </div>
              </x-table.cell>
            </x-table.row>
          @endforelse
        </x-table>
      </div>
    </div>
    <div class="mt-5">
      <x-log-out />
    </div>
  </div>
</div>
