<div>
  <x-content>
    <x-table.head-actions>
      <x-slot:left>
        <x-text-input wire:model.defer="search" type="search" placeholder="Search" />
        <x-select wire:model.defer="searchBy">
          <option value="QRCODE">
            QR CODE
          </option>
          <option value="ROOM_NUMBER">
            ROOM NUMBER
          </option>
        </x-select>
        <x-button.primary wire:click="search">
          Search
        </x-button.primary>
      </x-slot:left>
    </x-table.head-actions>
    <div wire:key="guest">
      {{-- menu list --}}

      <div class=" h-[33rem] flex justify-between">
        <div class="flex-1 mx-5 ">
          <div class="mt-5 grid grid-cols-7 gap-3">
            <button class=" border h-12 hover:text-green-600 shado grid place-content-center  rounded-lg p-1">
              <p class="text-center font-semibold text-sm">COMBO MEALS</p>
            </button>
          </div>
          <div class="mt-5 grid grid-cols-4 gap-4 mb-6">
            <div
              class="bg-gray-50 hover:border-2 hover:border-green-600 cursor-pointer rounded-xl shadow p-2 h-[15.5 rem]">
              <div class="bg-gray-500 shadow h-40 rounded-xl relative">
                <img src="{{ asset('images/no-image-available.png') }}"
                  class="h-full opacity-50 w-full rounded-xl object-cover" alt="">
                <div class="absolute top-2 right-2">
                  <div class="bg-white bg-opacity-20 h-10 w-10 rounded-xl grid place-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5 fill-green-500">
                      <path fill="none" d="M0 0h24v24H0z" />
                      <path
                        d="M4 6.414L.757 3.172l1.415-1.415L5.414 5h15.242a1 1 0 0 1 .958 1.287l-2.4 8a1 1 0 0 1-.958.713H6v2h11v2H5a1 1 0 0 1-1-1V6.414zM6 7v6h11.512l1.8-6H6zm-.5 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm12 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                    </svg>
                  </div>
                </div>
              </div>
              <div class="py-3">
                <h1 class="font-semibold text-gray-500">Tapsilog</h1>
                <h1 class="font-semibold mt-1 text-lg text-green-500">&#8369; 99.00
                </h1>
              </div>
            </div>
            <div
              class="bg-gray-50 hover:border-2 hover:border-green-600 cursor-pointer rounded-xl shadow p-2 h-[15.5 rem]">
              <div class="bg-gray-500 shadow h-40 rounded-xl relative">
                <img src="{{ asset('images/no-image-available.png') }}"
                  class="h-full opacity-50 w-full rounded-xl object-cover" alt="">
                <div class="absolute top-2 right-2">
                  <div class="bg-white bg-opacity-20 h-10 w-10 rounded-xl grid place-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5 fill-green-500">
                      <path fill="none" d="M0 0h24v24H0z" />
                      <path
                        d="M4 6.414L.757 3.172l1.415-1.415L5.414 5h15.242a1 1 0 0 1 .958 1.287l-2.4 8a1 1 0 0 1-.958.713H6v2h11v2H5a1 1 0 0 1-1-1V6.414zM6 7v6h11.512l1.8-6H6zm-.5 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm12 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                    </svg>
                  </div>
                </div>
              </div>
              <div class="py-3">
                <h1 class="font-semibold text-gray-500">Tapsilog</h1>
                <h1 class="font-semibold mt-1 text-lg text-green-500">&#8369; 99.00
                </h1>
              </div>
            </div>
            <div
              class="bg-gray-50 hover:border-2 hover:border-green-600 cursor-pointer rounded-xl shadow p-2 h-[15.5 rem]">
              <div class="bg-gray-500 shadow h-40 rounded-xl relative">
                <img src="{{ asset('images/no-image-available.png') }}"
                  class="h-full opacity-50 w-full rounded-xl object-cover" alt="">
                <div class="absolute top-2 right-2">
                  <div class="bg-white bg-opacity-20 h-10 w-10 rounded-xl grid place-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5 fill-green-500">
                      <path fill="none" d="M0 0h24v24H0z" />
                      <path
                        d="M4 6.414L.757 3.172l1.415-1.415L5.414 5h15.242a1 1 0 0 1 .958 1.287l-2.4 8a1 1 0 0 1-.958.713H6v2h11v2H5a1 1 0 0 1-1-1V6.414zM6 7v6h11.512l1.8-6H6zm-.5 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm12 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                    </svg>
                  </div>
                </div>
              </div>
              <div class="py-3">
                <h1 class="font-semibold text-gray-500">Tapsilog</h1>
                <h1 class="font-semibold mt-1 text-lg text-green-500">&#8369; 99.00
                </h1>
              </div>
            </div>

          </div>
        </div>
        <div class="w-96 border rounded-2xl relative p-5">
          <header class="flex justify-between items-center">
            <h1 class="font-bold text-lg text-gray-600">Current Order</h1>
            <button class="h-9 w-9 rounded-lg grid place-content-center bg-gray-100"><svg
                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="fill-gray-600" width="24"
                height="24">
                <path fill="none" d="M0 0h24v24H0z" />
                <path
                  d="M2 18h7v2H2v-2zm0-7h9v2H2v-2zm0-7h20v2H2V4zm18.674 9.025l1.156-.391 1 1.732-.916.805a4.017 4.017 0 0 1 0 1.658l.916.805-1 1.732-1.156-.391c-.41.37-.898.655-1.435.83L19 21h-2l-.24-1.196a3.996 3.996 0 0 1-1.434-.83l-1.156.392-1-1.732.916-.805a4.017 4.017 0 0 1 0-1.658l-.916-.805 1-1.732 1.156.391c.41-.37.898-.655 1.435-.83L17 11h2l.24 1.196c.536.174 1.024.46 1.434.83zM18 18a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" />
              </svg></button>
          </header>
          <div class="mt-5 flex flex-col space-y-1">
            <div class="order bg-gray-50 relative rounded-lg p-2 flex space-x-2">
              <div class="absolute -top-2 -right-3  grid place-content-center ">
                <button class="fill-red-500 hover:fill-red-700">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-6 w-6">
                    <path fill="none" d="M0 0h24v24H0z" />
                    <path
                      d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-11.414L9.172 7.757 7.757 9.172 10.586 12l-2.829 2.828 1.415 1.415L12 13.414l2.828 2.829 1.415-1.415L13.414 12l2.829-2.828-1.415-1.415L12 10.586z" />
                  </svg>
                </button>
              </div>
              <div class="bg-green-600 rounded-lg h-12 w-12 grid place-content-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-6 w-6 fill-white">
                  <path fill="none" d="M0 0h24v24H0z" />
                  <path
                    d="M15.366 3.438L18.577 9H22v2h-1.167l-.757 9.083a1 1 0 0 1-.996.917H4.92a1 1 0 0 1-.996-.917L3.166 11H2V9h3.422l3.212-5.562 1.732 1L7.732 9h8.535l-2.633-4.562 1.732-1zM13 13h-2v4h2v-4zm-4 0H7v4h2v-4zm8 0h-2v4h2v-4z" />
                </svg>
              </div>
              <div class="flex-1 flex-col">
                <h1 class="font-semibold text-gray-600">sdsdsd</h1>
                <div class="flex justify-between">
                  <h1 class="font-semibold text-green-600 text-sm">
                    &#8369;99.00</h1>
                  <div class="flex text-sm space-x-3 items-center">
                    <button
                      class="bg-green-500 hover:bg-green-600 shadow p-0.5 px-2 rounded grid font-semibold text-white  place-content-center">
                      <span>-</span>
                    </button>
                    <div class="font-semibold text-gray-600">1</div>
                    <button
                      class="bg-green-500 hover:bg-green-600 shadow p-0.5 px-2 rounded font-semibold text-white grid place-content-center">
                      <span>+</span>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="absolute bottom-0 left-0 w-full px-4 pb-4">
            <div class="flex flex-col space-y-3">
              <div
                class="
                bg-gray-100 rounded-lg relative h-40 flex flex-col justify-between overflow-hidden
                before:absolute before:bg-white before:h-5 before:w-5 before:rounded-full before:bottom-[2.5rem] before:-left-2
                after:absolute after:bg-white after:h-5 after:w-5 after:rounded-full after:bottom-[2.5rem] after:-right-2
                ">
                <div class="flex-1  flex flex-col justify-between">
                  <section class="p-3">
                    <h1 class="text-gray-600 uppercase font-bold">Order Summary</h1>
                    <h1 class="text-red-500 leading-3 text-xs">Johnrey Naceda</h1>
                    <div class="flex justify-between mt-4 text-gray-600">
                      <dt>Subtotal</dt>
                      <dd class="">&#8369;99.00
                      </dd>
                    </div>
                  </section>
                  <section class="border border-dashed border-gray-400 "></section>
                </div>
                <section class="p-3">
                  <div class="flex justify-between  text-green-600">
                    <dt class="font-bold">Total</dt>
                    <dd class="font-semibold">
                      &#8369;99.00
                    </dd>
                  </div>
                </section>
              </div>
              <button wire:click="checkoutOrder"
                class="bg-green-500 py-2 rounded-lg text-white font-semibold hover:bg-green-600">
                <span>CheckOut Order</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </x-content>
</div>
