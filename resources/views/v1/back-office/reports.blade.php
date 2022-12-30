<x-back-office-layout>
  <div x-data="{ report: null }">
    <div class="md:flex md:items-center md:justify-between">
      <div class="min-w-0 flex-1">
        <h2 class="text-3xl font-bold leading-7 text-gray-500 uppercase sm:truncate sm:tracking-tight">REPORTS
        </h2>
      </div>

    </div>

    <div class="mt-5">

      <div class="w-64">
        <label for="location" class="block text-sm font-medium text-gray-500">Select Report</label>
        <select id="location" name="location" x-model="report"
          class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
          <option selected hidden>----------</option>
          <option value="1">Occupied Room</option>
          <option value="2">Guest</option>
          <option value="3">Overdue Rooms</option>
          <option value="4">Roomboys</option>
          <option value="5">Number of Stay</option>
          <option value="6">Time Interval</option>
          <option value="7">Transfer</option>
          <option value="8">Extend</option>
        </select>
      </div>

    </div>

    <div class="mt-10">
      <div x-cloak x-show="report == 1">
        <livewire:back-office.occupied-room />
      </div>
      <div x-cloak x-show="report == 2">
        Guest
      </div>
      <div x-cloak x-show="report == 3">
        <div x-data>
          <div class="flex justify-between items-center">
            <div class="flex space-x-1 items-center">
              <input type="date" wire:model="date" class="rounded-lg border-gray-300 h-10 text-gray-600"
                name="" id="">
              @error('date')
                <span class="text-red-500 text-xs">{{ $message }}</span>
              @enderror
              {{-- @if ($date != null)
                <x-button id="dsdsd" wire:click="generate" dark label="GENERATE" spinner="generate"
                  class="font-semibold" />
              @endif --}}

            </div>
            <div class="flex space-x-1">
              <x-button wire:click="export" wire:loading.attr="disabled" positive
                class="text-white fill-white font-semibold">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                  <path fill="none" d="M0 0h24v24H0z" />
                  <path
                    d="M2.859 2.877l12.57-1.795a.5.5 0 0 1 .571.495v20.846a.5.5 0 0 1-.57.495L2.858 21.123a1 1 0 0 1-.859-.99V3.867a1 1 0 0 1 .859-.99zM4 4.735v14.53l10 1.429V3.306L4 4.735zM17 19h3V5h-3V3h4a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1h-4v-2zm-6.8-7l2.8 4h-2.4L9 13.714 7.4 16H5l2.8-4L5 8h2.4L9 10.286 10.6 8H13l-2.8 4z" />
                </svg>
              </x-button>
              <x-button wire:key="sdsd" @click="printOut($refs.printContainer.outerHTML);" dark
                class="text-white fill-white font-semibold">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                  <path fill="none" d="M0 0h24v24H0z" />
                  <path
                    d="M6 19H3a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h3V3a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v4h3a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1h-3v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-2zm0-2v-1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v1h2V9H4v8h2zM8 4v3h8V4H8zm0 13v3h8v-3H8zm-3-7h3v2H5v-2z" />
                </svg>
              </x-button>
            </div>
          </div>
          <div class="mt-5 border-2 p-5">
            <div x-ref="printContainer" class="s">
              <div class="flex items-center space-x-2 text-gray-700">
                <svg class="w-10 h-10" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                  <!--! Font Awesome Free 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                  <path
                    d="M480 0C497.7 0 512 14.33 512 32C512 49.67 497.7 64 480 64V448C497.7 448 512 462.3 512 480C512 497.7 497.7 512 480 512H304V448H208V512H32C14.33 512 0 497.7 0 480C0 462.3 14.33 448 32 448V64C14.33 64 0 49.67 0 32C0 14.33 14.33 0 32 0H480zM112 96C103.2 96 96 103.2 96 112V144C96 152.8 103.2 160 112 160H144C152.8 160 160 152.8 160 144V112C160 103.2 152.8 96 144 96H112zM224 144C224 152.8 231.2 160 240 160H272C280.8 160 288 152.8 288 144V112C288 103.2 280.8 96 272 96H240C231.2 96 224 103.2 224 112V144zM368 96C359.2 96 352 103.2 352 112V144C352 152.8 359.2 160 368 160H400C408.8 160 416 152.8 416 144V112C416 103.2 408.8 96 400 96H368zM96 240C96 248.8 103.2 256 112 256H144C152.8 256 160 248.8 160 240V208C160 199.2 152.8 192 144 192H112C103.2 192 96 199.2 96 208V240zM240 192C231.2 192 224 199.2 224 208V240C224 248.8 231.2 256 240 256H272C280.8 256 288 248.8 288 240V208C288 199.2 280.8 192 272 192H240zM352 240C352 248.8 359.2 256 368 256H400C408.8 256 416 248.8 416 240V208C416 199.2 408.8 192 400 192H368C359.2 192 352 199.2 352 208V240zM256 288C211.2 288 173.5 318.7 162.1 360.2C159.7 373.1 170.7 384 184 384H328C341.3 384 352.3 373.1 349 360.2C338.5 318.7 300.8 288 256 288z">
                  </path>
                </svg>
                <div class="">
                  <h1 class="text-2xl leading-5 border-b border-gray-700 font-bold">HIMS</h1>
                  <h1 class="text-xs font-semibold">{{ auth()->user()->branch->name }}</h1>
                </div>
              </div>
              <div class="mt-10 text-center text-2xl text-gray-700 font-bold">
                <h1>OVERDUE ROOMS REPORT</h1>
                {{-- @if ($date)
                  <p class="text-sm font-semibold">({{ \Carbon\Carbon::parse($date)->format('F d, Y') }})</p>
                @endif --}}
              </div>
              <table id="example" class="table-auto mt-5" style="width:100%">
                <thead class="font-normal">
                  <tr>
                    <th class="border border-gray-700 text-left px-2 text-sm font-semibold text-gray-700 py-2">OVERDUE
                      ROOM</th>
                    <th class="border border-gray-700 text-left px-2 text-sm font-semibold text-gray-700 py-2">ASSIGNED
                      ROOMBOY
                    </th>
                    <th class="border border-gray-700 text-left px-2 text-sm font-semibold text-gray-700 py-2">EXPECTED
                      TIME
                    </th>
                    <th class="border border-gray-700 text-left px-2 text-sm font-semibold text-gray-700 py-2">TIME
                      ENDED</th>
                  </tr>
                </thead>
                <tbody class="">
                  <tr>
                    <td class="border border-gray-700 px-3 py-1">RM #12 |
                      1st Floor</td>
                    <td class="border border-gray-700 px-3 py-1">rey</td>
                    <td class="border border-gray-700 px-3 py-1">12:00pm </td>
                    <td class="border border-gray-700 px-3 py-1">01:00pm</td>
                  </tr>
                </tbody>
              </table>
              <div class="mt-20">
                <div class="flex flex-col space-y-7">
                  <div class="text-gray-700">
                    <h1 class="text-sm font-semibold">Prepared By:</h1>
                    <h1 class="text-sm mt-8 w-48 border-b border-gray-400"></h1>
                  </div>
                  <div class="text-gray-700">
                    <h1 class="text-sm font-semibold">Verified By:</h1>
                    <h1 class="text-sm mt-8 w-48 border-b border-gray-400"></h1>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
      <div x-cloak x-show="report == 4">
        <div x-data>
          <div class="flex justify-end items-center">

            <div class="flex space-x-1">
              <x-button @click="printOut($refs.printContainer.outerHTML);" dark label="PRINT" class="font-semibold"
                right-icon="printer" />
            </div>
          </div>
          <div class="mt-10 border-2 p-5">
            <div x-ref="printContainer" class="flex flex-col">
              <div class="flex items-center space-x-2 text-gray-700">
                <svg class="w-10 h-10" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                  <!--! Font Awesome Free 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                  <path
                    d="M480 0C497.7 0 512 14.33 512 32C512 49.67 497.7 64 480 64V448C497.7 448 512 462.3 512 480C512 497.7 497.7 512 480 512H304V448H208V512H32C14.33 512 0 497.7 0 480C0 462.3 14.33 448 32 448V64C14.33 64 0 49.67 0 32C0 14.33 14.33 0 32 0H480zM112 96C103.2 96 96 103.2 96 112V144C96 152.8 103.2 160 112 160H144C152.8 160 160 152.8 160 144V112C160 103.2 152.8 96 144 96H112zM224 144C224 152.8 231.2 160 240 160H272C280.8 160 288 152.8 288 144V112C288 103.2 280.8 96 272 96H240C231.2 96 224 103.2 224 112V144zM368 96C359.2 96 352 103.2 352 112V144C352 152.8 359.2 160 368 160H400C408.8 160 416 152.8 416 144V112C416 103.2 408.8 96 400 96H368zM96 240C96 248.8 103.2 256 112 256H144C152.8 256 160 248.8 160 240V208C160 199.2 152.8 192 144 192H112C103.2 192 96 199.2 96 208V240zM240 192C231.2 192 224 199.2 224 208V240C224 248.8 231.2 256 240 256H272C280.8 256 288 248.8 288 240V208C288 199.2 280.8 192 272 192H240zM352 240C352 248.8 359.2 256 368 256H400C408.8 256 416 248.8 416 240V208C416 199.2 408.8 192 400 192H368C359.2 192 352 199.2 352 208V240zM256 288C211.2 288 173.5 318.7 162.1 360.2C159.7 373.1 170.7 384 184 384H328C341.3 384 352.3 373.1 349 360.2C338.5 318.7 300.8 288 256 288z">
                  </path>
                </svg>
                <div class="">
                  <h1 class="text-2xl leading-5 border-b border-gray-700 font-bold">HIMS</h1>
                  <h1 class="text-xs font-semibold">{{ auth()->user()->branch->name }}</h1>
                </div>
              </div>
              <div class="mt-10 text-center text-2xl text-gray-700 font-bold">
                <h1>ROOMBOY REPORT</h1>
              </div>
              <table id="example" class="table-auto mt-5" style="width:100%">
                <thead class="font-normal">
                  <tr>
                    <th class="border border-gray-700 text-left px-2 text-sm font-semibold text-gray-700 py-2">GUEST
                      NAME</th>
                    <th class="border border-gray-700 text-left px-2 text-sm font-semibold text-gray-700 py-2">CHECK IN
                    </th>
                    <th class="border border-gray-700 text-left px-2 text-sm font-semibold text-gray-700 py-2">CHECK
                      OUT</th>
                    <th class="border border-gray-700 text-left px-2 text-sm font-semibold text-gray-700 py-2">TIME
                      ENTRY AS
                      CLEAN</th>
                    <th class="border border-gray-700 text-left px-2 text-sm font-semibold text-gray-700 py-2">ROOMBOY
                      NAME</th>
                    <th class="border border-gray-700 text-left px-2 text-sm font-semibold text-gray-700 py-2">CLEANING
                      TIME
                      INTERVAL</th>
                  </tr>
                </thead>
                <tbody class="">

                  <tr>
                    <td class="border border-gray-700 px-3 py-1">reyt</td>
                    <td class="border border-gray-700 px-3 py-1">
                      03-12-2022|
                      03-12-2022</td>
                    <td class="border border-gray-700 px-3 py-1">
                      03-12-2022|
                      03-12-2022</td>
                    <td class="border border-gray-700 px-3 py-1">
                      sds</td>
                    <td class="border border-gray-700 px-3 py-1">reyyyyyy</td>
                    <td class="border border-gray-700 px-3 py-1">3hours</td>
                  </tr>

                </tbody>
              </table>
              <div class="mt-20">
                <div class="flex flex-col space-y-7">
                  <div class="text-gray-700">
                    <h1 class="text-sm font-semibold">Prepared By:</h1>
                    <h1 class="text-sm mt-8 w-48 border-b border-gray-400"></h1>
                  </div>
                  <div class="text-gray-700">
                    <h1 class="text-sm font-semibold">Verified By:</h1>
                    <h1 class="text-sm mt-8 w-48 border-b border-gray-400"></h1>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
      <div x-cloak x-show="report == 5">
        <div x-data>
          <div class="flex justify-between items-center">
            <div class="flex space-x-1 items-center">
              <div>
                <div class="">
                  <input type="date" wire:model="date"
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    placeholder="you@example.com">
                </div>
              </div>
              {{-- @if ($date)
                <x-native-select wire:model="shift">
                  <option>Select Shift</option>
                  <option value="1">1st Shift (8:00am - 8:00pm)</option>
                  <option value="2">2nd Shift (8:00pm - 8:00am)</option>
                </x-native-select>
              @endif --}}
            </div>
            <div class="flex space-x-1">

              <x-button @click="printOut($refs.printContainer.outerHTML);" dark label="PRINT" class="font-semibold"
                right-icon="printer" />
            </div>
          </div>
          <div class="p-5 border-2 mt-5">
            <div x-ref="printContainer" class=" flex flex-col">
              <div class="flex items-center space-x-2 text-gray-700">
                <svg class="w-10 h-10" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                  <!--! Font Awesome Free 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                  <path
                    d="M480 0C497.7 0 512 14.33 512 32C512 49.67 497.7 64 480 64V448C497.7 448 512 462.3 512 480C512 497.7 497.7 512 480 512H304V448H208V512H32C14.33 512 0 497.7 0 480C0 462.3 14.33 448 32 448V64C14.33 64 0 49.67 0 32C0 14.33 14.33 0 32 0H480zM112 96C103.2 96 96 103.2 96 112V144C96 152.8 103.2 160 112 160H144C152.8 160 160 152.8 160 144V112C160 103.2 152.8 96 144 96H112zM224 144C224 152.8 231.2 160 240 160H272C280.8 160 288 152.8 288 144V112C288 103.2 280.8 96 272 96H240C231.2 96 224 103.2 224 112V144zM368 96C359.2 96 352 103.2 352 112V144C352 152.8 359.2 160 368 160H400C408.8 160 416 152.8 416 144V112C416 103.2 408.8 96 400 96H368zM96 240C96 248.8 103.2 256 112 256H144C152.8 256 160 248.8 160 240V208C160 199.2 152.8 192 144 192H112C103.2 192 96 199.2 96 208V240zM240 192C231.2 192 224 199.2 224 208V240C224 248.8 231.2 256 240 256H272C280.8 256 288 248.8 288 240V208C288 199.2 280.8 192 272 192H240zM352 240C352 248.8 359.2 256 368 256H400C408.8 256 416 248.8 416 240V208C416 199.2 408.8 192 400 192H368C359.2 192 352 199.2 352 208V240zM256 288C211.2 288 173.5 318.7 162.1 360.2C159.7 373.1 170.7 384 184 384H328C341.3 384 352.3 373.1 349 360.2C338.5 318.7 300.8 288 256 288z">
                  </path>
                </svg>
                <div class="">
                  <h1 class="text-2xl leading-5 border-b border-gray-700 font-bold">HIMS</h1>
                  <h1 class="text-xs font-semibold">{{ auth()->user()->branch->name }}</h1>
                </div>
              </div>
              <div class="mt-10 text-center text-2xl text-gray-700 font-bold">
                <h1>NUMBER OF STAY REPORT</h1>
                {{-- @if ($date)
                  <p class="text-sm font-semibold">({{ \Carbon\Carbon::parse($date)->format('F d, Y') }})</p>
                  @if ($shift)
                    <p class="text-sm font-semibold underline">
                      {{ $shift == 1 ? '1st Shift (8:00am - 8:00pm)' : '2nd Shift (8:00pm - 8:00am)' }}</p>
                  @endif
                @endif --}}
              </div>


              <table id="example" class="table-auto mt-5" style="width:100%">
                <thead class="font-normal">
                  <tr>
                    <th class="border border-gray-700 text-left px-2 text-sm font-semibold text-gray-700 py-2">ROOM #
                    </th>
                    <th class="border border-gray-700 text-left px-2 text-sm font-semibold text-gray-700 py-2">TYPE OF
                      ROOM</th>
                    <th class="border border-gray-700 text-left px-2 text-sm font-semibold text-gray-700 py-2">RATE
                    </th>
                    <th class="border border-gray-700 text-left px-2 text-sm font-semibold text-gray-700 py-2">GUEST
                      NAME</th>
                    <th class="border border-gray-700 text-left px-2 text-sm font-semibold text-gray-700 py-2">CHECK IN
                    </th>
                    <th class="border border-gray-700 text-left px-2 text-sm font-semibold text-gray-700 py-2">CHECK
                      OUT</th>
                    <th class="border border-gray-700 text-left px-2 text-sm font-semibold text-gray-700 py-2">DAMAGES
                    </th>
                    <th class="border border-gray-700 text-left px-2 text-sm font-semibold text-gray-700 py-2">DEPOSIT
                    </th>
                  </tr>
                </thead>
                {{-- @dump($checkInDetails) --}}

                <tbody class="">
                  <tr>
                    <td class="border border-gray-700 px-2 py-2 text-sm text-gray-700">
                      1</td>
                    <td class="border border-gray-700 px-2 py-2 text-sm text-gray-700">
                      Single
                    </td>
                    <td class="border border-gray-700 px-2 py-2 text-sm text-gray-700">
                      &#8369;300.00
                    </td>
                    <td class="border border-gray-700 px-2 py-2 text-sm text-gray-700">
                      reytyy
                    </td>
                    <td class="border border-gray-700 px-2 py-2 text-sm text-gray-700">
                      02-12-2022
                    </td>
                    <td class="border border-gray-700 px-2 py-2 text-sm text-gray-700">
                      02-12-2022
                    </td>
                    <td class="border border-gray-700 px-2 py-2 text-sm text-gray-700">
                      damages
                      {{-- @forelse ($checkInDetail->guest->damages as $item)
                            <div class="flex flex-col">
                              {{ $item->hotel_item->name }} - &#8369;{{ number_format($item->price, 2) }}
                            </div>
                          @empty
                            No Damages
                          @endforelse --}}
                    </td>
                    <td class="border border-gray-700 px-2 py-2 text-sm text-gray-700">
                      deposits
                      {{-- @forelse ($checkInDetail->guest->damages as $item)
                            <div class="flex flex-col">
                              &#8369;{{ number_format($item->amount, 2) }}
                            </div>
                          @empty
                            No Deposits
                          @endforelse --}}
                    </td>
                  </tr>
                </tbody>
              </table>
              <div class="mt-20">
                <div class="flex flex-col space-y-7">
                  <div class="text-gray-700">
                    <h1 class="text-sm font-semibold">Prepared By:</h1>
                    <h1 class="text-sm mt-8 w-48 border-b border-gray-400"></h1>
                  </div>
                  <div class="text-gray-700">
                    <h1 class="text-sm font-semibold">Verified By:</h1>
                    <h1 class="text-sm mt-8 w-48 border-b border-gray-400"></h1>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
      <div x-cloak x-show="report == 6">
        <div x-data>
          <div class="flex justify-between items-center">
            <div class="flex space-x-1 items-center">
              <div>
                <div class="">
                  <input type="date" wire:model="date"
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    placeholder="you@example.com">
                </div>
              </div>
              {{-- @if ($date)
                <x-native-select wire:model="shift">
                  <option>Select Shift</option>
                  <option value="1">1st Shift (8:00am - 8:00pm)</option>
                  <option value="2">2nd Shift (8:00pm - 8:00am)</option>
                </x-native-select>
              @endif --}}
            </div>
            <div class="flex space-x-1">
              <x-button @click="printOut($refs.printContainer.outerHTML);" dark label="PRINT" class="font-semibold"
                right-icon="printer" />
            </div>
          </div>
          <div class="border-2 p-5 mt-5">
            <div x-ref="printContainer" class="mt-5 flex flex-col">
              <div class="flex items-center space-x-2 text-gray-700">
                <svg class="w-10 h-10" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                  <!--! Font Awesome Free 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                  <path
                    d="M480 0C497.7 0 512 14.33 512 32C512 49.67 497.7 64 480 64V448C497.7 448 512 462.3 512 480C512 497.7 497.7 512 480 512H304V448H208V512H32C14.33 512 0 497.7 0 480C0 462.3 14.33 448 32 448V64C14.33 64 0 49.67 0 32C0 14.33 14.33 0 32 0H480zM112 96C103.2 96 96 103.2 96 112V144C96 152.8 103.2 160 112 160H144C152.8 160 160 152.8 160 144V112C160 103.2 152.8 96 144 96H112zM224 144C224 152.8 231.2 160 240 160H272C280.8 160 288 152.8 288 144V112C288 103.2 280.8 96 272 96H240C231.2 96 224 103.2 224 112V144zM368 96C359.2 96 352 103.2 352 112V144C352 152.8 359.2 160 368 160H400C408.8 160 416 152.8 416 144V112C416 103.2 408.8 96 400 96H368zM96 240C96 248.8 103.2 256 112 256H144C152.8 256 160 248.8 160 240V208C160 199.2 152.8 192 144 192H112C103.2 192 96 199.2 96 208V240zM240 192C231.2 192 224 199.2 224 208V240C224 248.8 231.2 256 240 256H272C280.8 256 288 248.8 288 240V208C288 199.2 280.8 192 272 192H240zM352 240C352 248.8 359.2 256 368 256H400C408.8 256 416 248.8 416 240V208C416 199.2 408.8 192 400 192H368C359.2 192 352 199.2 352 208V240zM256 288C211.2 288 173.5 318.7 162.1 360.2C159.7 373.1 170.7 384 184 384H328C341.3 384 352.3 373.1 349 360.2C338.5 318.7 300.8 288 256 288z">
                  </path>
                </svg>
                <div class="">
                  <h1 class="text-2xl leading-5 border-b border-gray-700 font-bold">HIMS</h1>
                  <h1 class="text-xs font-semibold">{{ auth()->user()->branch->name }}</h1>
                </div>
              </div>
              <div class="mt-10 text-center text-2xl text-gray-700 font-bold">
                <h1>TIME INTERVAL REPORT</h1>
                {{-- @if ($date)
                  <p class="text-sm font-semibold">({{ \Carbon\Carbon::parse($date)->format('F d, Y') }})</p>
                  @if ($shift)
                    <p class="text-sm font-semibold underline">
                      {{ $shift == 1 ? '1st Shift (8:00am - 8:00pm)' : '2nd Shift (8:00pm - 8:00am)' }}</p>
                  @endif
                @endif --}}
              </div>


              <table id="example" class="table-auto mt-5" style="width:100%">
                <thead class="font-normal">
                  <tr>
                    <th width="150"
                      class="border border-gray-700 text-left px-2 text-sm font-semibold text-gray-700 py-2">
                    </th>
                    <th class="border border-gray-700 text-left px-2 text-sm font-semibold text-gray-700 py-2">CHECK IN
                    </th>
                    <th class="border border-gray-700 text-left px-2 text-sm font-semibold text-gray-700 py-2">CHECK
                      OUT</th>
                    <th class="border border-gray-700 text-left px-2 text-sm font-semibold text-gray-700 py-2">ROOM
                      INTERVAL
                    </th>
                  </tr>
                </thead>
                {{-- @php
                  $checkIns = App\Models\Room::whereIn('id', $checkInDetails)->get();
                @endphp --}}
                <tbody class="">
                  <tr>
                    <td colspan="4" class="border border-gray-700 bg-gray-100 font-bold text-gray-700 px-3 py-1">
                      ROOM
                      #1
                    </td>
                  </tr>

                  <tr>
                    <td class="border border-gray-700 px-3 py-1"></td>
                    <td class="border border-gray-700 px-3 py-1">
                      12:00</td>
                    <td class="border border-gray-700 px-3 py-1">
                      01:00</td>
                    <td class="border border-gray-700 px-3 py-1">
                      5mins
                    </td>
                  </tr>

                </tbody>
              </table>
              <div class="mt-20">
                <div class="flex flex-col space-y-7">
                  <div class="text-gray-700">
                    <h1 class="text-sm font-semibold">Prepared By:</h1>
                    <h1 class="text-sm mt-8 w-48 border-b border-gray-400"></h1>
                  </div>
                  <div class="text-gray-700">
                    <h1 class="text-sm font-semibold">Verified By:</h1>
                    <h1 class="text-sm mt-8 w-48 border-b border-gray-400"></h1>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
      <div x-cloak x-show="report == 7">
        <div x-data>
          <div class="flex justify-between items-center">
            <div class="flex space-x-1 items-center">
              <div>
                <div class="">
                  <input type="date" wire:model="date"
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    placeholder="you@example.com">
                </div>
              </div>
              {{-- @if ($date)
                <x-native-select wire:model="shift">
                  <option>Select Shift</option>
                  <option value="1">1st Shift (8:00am - 8:00pm)</option>
                  <option value="2">2nd Shift (8:00pm - 8:00am)</option>
                </x-native-select>
              @endif --}}
            </div>
            <div class="flex space-x-1">
              <x-button @click="printOut($refs.printContainer.outerHTML);" dark label="PRINT" class="font-semibold"
                right-icon="printer" />
            </div>
          </div>
          <div class="border-2 p-5 mt-5">
            <div x-ref="printContainer" class="mt-5 flex flex-col">
              <div class="flex items-center space-x-2 text-gray-700">
                <svg class="w-10 h-10" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                  <!--! Font Awesome Free 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                  <path
                    d="M480 0C497.7 0 512 14.33 512 32C512 49.67 497.7 64 480 64V448C497.7 448 512 462.3 512 480C512 497.7 497.7 512 480 512H304V448H208V512H32C14.33 512 0 497.7 0 480C0 462.3 14.33 448 32 448V64C14.33 64 0 49.67 0 32C0 14.33 14.33 0 32 0H480zM112 96C103.2 96 96 103.2 96 112V144C96 152.8 103.2 160 112 160H144C152.8 160 160 152.8 160 144V112C160 103.2 152.8 96 144 96H112zM224 144C224 152.8 231.2 160 240 160H272C280.8 160 288 152.8 288 144V112C288 103.2 280.8 96 272 96H240C231.2 96 224 103.2 224 112V144zM368 96C359.2 96 352 103.2 352 112V144C352 152.8 359.2 160 368 160H400C408.8 160 416 152.8 416 144V112C416 103.2 408.8 96 400 96H368zM96 240C96 248.8 103.2 256 112 256H144C152.8 256 160 248.8 160 240V208C160 199.2 152.8 192 144 192H112C103.2 192 96 199.2 96 208V240zM240 192C231.2 192 224 199.2 224 208V240C224 248.8 231.2 256 240 256H272C280.8 256 288 248.8 288 240V208C288 199.2 280.8 192 272 192H240zM352 240C352 248.8 359.2 256 368 256H400C408.8 256 416 248.8 416 240V208C416 199.2 408.8 192 400 192H368C359.2 192 352 199.2 352 208V240zM256 288C211.2 288 173.5 318.7 162.1 360.2C159.7 373.1 170.7 384 184 384H328C341.3 384 352.3 373.1 349 360.2C338.5 318.7 300.8 288 256 288z">
                  </path>
                </svg>
                <div class="">
                  <h1 class="text-2xl leading-5 border-b border-gray-700 font-bold">HIMS</h1>
                  <h1 class="text-xs font-semibold">{{ auth()->user()->branch->name }}</h1>
                </div>
              </div>
              <div class="mt-10 text-center text-2xl text-gray-700 font-bold">
                <h1>TRANSFER REPORT</h1>
                {{-- @if ($date)
                  <p class="text-sm font-semibold">({{ \Carbon\Carbon::parse($date)->format('F d, Y') }})</p>
                  @if ($shift)
                    <p class="text-sm font-semibold underline">
                      {{ $shift == 1 ? '1st Shift (8:00am - 8:00pm)' : '2nd Shift (8:00pm - 8:00am)' }}</p>
                  @endif
                @endif --}}
              </div>


              <table id="example" class="table-auto mt-5" style="width:100%">
                <thead class="font-normal">
                  <tr>
                    <th class="border border-gray-700 text-left px-2 text-sm font-semibold text-gray-700 py-2">FROM
                      ROOM #</th>
                    <th class="border border-gray-700 text-left px-2 text-sm font-semibold text-gray-700 py-2">TRANSFER
                      TO ROOM
                      #</th>
                    <th class="border border-gray-700 text-left px-2 text-sm font-semibold text-gray-700 py-2">REASON
                    </th>
                    <th class="border border-gray-700 text-left px-2 text-sm font-semibold text-gray-700 py-2">FRONT
                      DESK
                      IN-CHARGE</th>

                  </tr>
                </thead>

                <tbody class="">
                  <tr>
                    <td class="border border-gray-700 px-2 py-2 text-sm text-gray-700">rm102</td>
                    <td class="border border-gray-700 px-2 py-2 text-sm text-gray-700">rm-2</td>
                    <td class="border border-gray-700 px-2 py-2 text-sm text-gray-700">wala lang</td>
                    <td class="border border-gray-700 px-2 py-2 text-sm text-gray-700">reyy</td>
                  </tr>
                </tbody>
              </table>
              <div class="mt-20">
                <div class="flex flex-col space-y-7">
                  <div class="text-gray-700">
                    <h1 class="text-sm font-semibold">Prepared By:</h1>
                    <h1 class="text-sm mt-8 w-48 border-b border-gray-400"></h1>
                  </div>
                  <div class="text-gray-700">
                    <h1 class="text-sm font-semibold">Verified By:</h1>
                    <h1 class="text-sm mt-8 w-48 border-b border-gray-400"></h1>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
      <div x-cloak x-show="report == 8">
        <div x-data>
          <div class="flex justify-between items-center">
            <div class="flex space-x-1 items-center">
              <div>
                <div class="">
                  <input type="date" wire:model="date"
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    placeholder="you@example.com">
                </div>
              </div>

            </div>
            <div class="flex space-x-1">
              <x-button @click="printOut($refs.printContainer.outerHTML);" dark label="PRINT" class="font-semibold"
                right-icon="printer" />
            </div>
          </div>
          <div class="border-2 p-5 mt-5">
            <div x-ref="printContainer" class="mt-5 flex flex-col">
              <div class="flex items-center space-x-2 text-gray-700">
                <svg class="w-10 h-10" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                  <!--! Font Awesome Free 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                  <path
                    d="M480 0C497.7 0 512 14.33 512 32C512 49.67 497.7 64 480 64V448C497.7 448 512 462.3 512 480C512 497.7 497.7 512 480 512H304V448H208V512H32C14.33 512 0 497.7 0 480C0 462.3 14.33 448 32 448V64C14.33 64 0 49.67 0 32C0 14.33 14.33 0 32 0H480zM112 96C103.2 96 96 103.2 96 112V144C96 152.8 103.2 160 112 160H144C152.8 160 160 152.8 160 144V112C160 103.2 152.8 96 144 96H112zM224 144C224 152.8 231.2 160 240 160H272C280.8 160 288 152.8 288 144V112C288 103.2 280.8 96 272 96H240C231.2 96 224 103.2 224 112V144zM368 96C359.2 96 352 103.2 352 112V144C352 152.8 359.2 160 368 160H400C408.8 160 416 152.8 416 144V112C416 103.2 408.8 96 400 96H368zM96 240C96 248.8 103.2 256 112 256H144C152.8 256 160 248.8 160 240V208C160 199.2 152.8 192 144 192H112C103.2 192 96 199.2 96 208V240zM240 192C231.2 192 224 199.2 224 208V240C224 248.8 231.2 256 240 256H272C280.8 256 288 248.8 288 240V208C288 199.2 280.8 192 272 192H240zM352 240C352 248.8 359.2 256 368 256H400C408.8 256 416 248.8 416 240V208C416 199.2 408.8 192 400 192H368C359.2 192 352 199.2 352 208V240zM256 288C211.2 288 173.5 318.7 162.1 360.2C159.7 373.1 170.7 384 184 384H328C341.3 384 352.3 373.1 349 360.2C338.5 318.7 300.8 288 256 288z">
                  </path>
                </svg>
                <div class="">
                  <h1 class="text-2xl leading-5 border-b border-gray-700 font-bold">HIMS</h1>
                  <h1 class="text-xs font-semibold">{{ auth()->user()->branch->name }}</h1>
                </div>
              </div>
              <div class="mt-10 text-center text-2xl text-gray-700 font-bold">
                <h1>NUMBER OF STAY REPORT</h1>

              </div>


              <table id="example" class="table-auto mt-5" style="width:100%">
                <thead class="font-normal">
                  <tr>
                    <th width="110"
                      class="border border-gray-700 text-left px-2 text-sm font-semibold text-gray-700 py-2">
                    </th>
                    <th
                      class="border border-gray-700 text-left px-2 text-sm font-semibold uppercase text-gray-700 py-2">
                      Extension Hour</th>
                    <th
                      class="border border-gray-700 text-left px-2 text-sm font-semibold uppercase text-gray-700 py-2">
                      Date &
                      TIME</th>
                    <th class="border border-gray-700 text-left px-2 text-sm font-semibold text-gray-700 py-2">FRONT
                      DESK
                      IN-CHARGE</th>

                  </tr>
                </thead>
                {{-- @php
                    $guests = App\Models\Guest::whereIn('id', $stays)->get();
                    //   dd($guests);
                  @endphp --}}
                <tbody class="">
                  <tr>
                    <td colspan="5" class="border border-gray-700 px-2 bg-gray-50 py-2 text-sm text-gray-700">
                      ROOM
                      #1</td>
                  </tr>
                  <tr>
                    <td class="border border-gray-700 px-2 py-2 text-sm text-gray-700"></td>
                    <td class="border border-gray-700 px-2 py-2 text-sm text-gray-700">7
                      HOURS</td>
                    <td class="border border-gray-700 px-2 py-2 text-sm text-gray-700">
                      01-12-2021</td>
                    <td class="border border-gray-700 px-2 py-2 text-sm text-gray-700">
                      reyyy
                    </td>

                  </tr>
                </tbody>
              </table>
              <div class="mt-20">
                <div class="flex flex-col space-y-7">
                  <div class="text-gray-700">
                    <h1 class="text-sm font-semibold">Prepared By:</h1>
                    <h1 class="text-sm mt-8 w-48 border-b border-gray-400"></h1>
                  </div>
                  <div class="text-gray-700">
                    <h1 class="text-sm font-semibold">Verified By:</h1>
                    <h1 class="text-sm mt-8 w-48 border-b border-gray-400"></h1>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>
</x-back-office-layout>
