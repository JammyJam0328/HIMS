<div x-data="{
    tab: {{ $categories->first()->id }},
    hasGuest: $wire.entangle('hasGuest'),
    orders: $wire.entangle('orders').defer,
    pushOrder(id, name, quantity, price) {
        {{-- if already in array the add quantity --}}
        const order = this.orders.find(order => order.id === id)
        if (order) {
            this.addQuantity(id)
            return
        } else {
            this.orders.push({
                id: id,
                name: name,
                quantity: quantity,
                price: price,
            })
        }
    },
    getPrice(price, quantity) {
        return price * quantity
    },
    addQuantity(id) {
        this.orders = this.orders.map(order => {
            if (order.id === id) {
                order.quantity += 1
            }
            return order
        })
    },
    subtractQuantity(id) {
        this.orders = this.orders.map(order => {
            if (order.id === id) {
                order.quantity -= 1
            }
            return order
        })
    },
    removeOrder(id) {
        this.orders = this.orders.filter(order => order.id !== id)
    },
    getTotal() {
        return this.orders.reduce((total, order) => {
            return total + (order.price * order.quantity)
        }, 0)
    },
    getSubTotal() {
        return this.orders.reduce((total, order) => {
            return total + (order.price * order.quantity)
        }, 0)
    },
}">
    <x-content>
        <x-table.head-actions>
            <x-slot:left>
                <x-text-input wire:model.defer="search"
                    type="search"
                    placeholder="Search" />
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

            <div class="flex h-[33rem] justify-between">
                <div class="mx-5 flex-1">
                    <div class="mt-5 grid grid-cols-7 gap-3">
                        @foreach ($categories as $categoryItem)
                            <button type="button"
                                x-on:click="tab = {{ $categoryItem->id }}"
                                wire:key="category{{ $categoryItem->id }}"
                                :class="{
                                    'border border-green-600 text-green-700': tab === {{ $categoryItem->id }},
                                    'bg-gray-200 text-gray-500': tab !== {{ $categoryItem->id }},
                                }"
                                class="shado grid h-12 place-content-center rounded-lg border p-1">
                                <p class="text-center text-sm font-semibold uppercase">
                                    {{ $categoryItem->name }}
                                </p>
                            </button>
                        @endforeach
                    </div>
                    @foreach ($categories as $category)
                        <div x-show="tab=={{ $category->id }}"
                            x-cloak
                            wire:key="menu{{ $category->id }}"
                            class="mt-5 mb-6 grid grid-cols-4 gap-4">
                            @forelse ($category->menus as $menu)
                                <div x-on:click="pushOrder({{ $menu->id }}, '{{ $menu->name }}', 1, {{ $menu->price }})"
                                    class="h-[15.5 rem] cursor-pointer rounded-xl bg-gray-50 p-2 shadow hover:border-2 hover:border-green-600">
                                    <div class="relative h-40 rounded-xl bg-gray-500 shadow">
                                        <img src="{{ asset('images/no-image-available.png') }}"
                                            class="h-full w-full rounded-xl object-cover opacity-50"
                                            alt="">
                                        <div class="absolute top-2 right-2">
                                            <div
                                                class="grid h-10 w-10 place-content-center rounded-xl bg-white bg-opacity-20">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24"
                                                    class="h-5 w-5 fill-green-500">
                                                    <path fill="none"
                                                        d="M0 0h24v24H0z" />
                                                    <path
                                                        d="M4 6.414L.757 3.172l1.415-1.415L5.414 5h15.242a1 1 0 0 1 .958 1.287l-2.4 8a1 1 0 0 1-.958.713H6v2h11v2H5a1 1 0 0 1-1-1V6.414zM6 7v6h11.512l1.8-6H6zm-.5 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm12 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="py-3">
                                        <h1 class="font-semibold text-gray-500">
                                            {{ $menu->name }}
                                        </h1>
                                        <h1 class="mt-1 text-lg font-semibold text-green-500">&#8369;
                                            {{ number_format($menu->price, 2) }}
                                        </h1>
                                    </div>
                                </div>
                            @empty
                            @endforelse
                        </div>
                    @endforeach
                </div>
                {{-- order summary --}}
                <div id="orderSummary"
                    class="relative w-96 rounded-2xl border p-5 shadow">
                    <div x-cloak
                        x-show="hasGuest"
                        id="orderContainer">
                        <header class="flex items-center justify-between">
                            <h1 class="text-lg font-bold text-gray-600">Current Order</h1>
                            <button class="grid h-9 w-9 place-content-center rounded-lg bg-gray-100"><svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    class="fill-gray-600"
                                    width="24"
                                    height="24">
                                    <path fill="none"
                                        d="M0 0h24v24H0z" />
                                    <path
                                        d="M2 18h7v2H2v-2zm0-7h9v2H2v-2zm0-7h20v2H2V4zm18.674 9.025l1.156-.391 1 1.732-.916.805a4.017 4.017 0 0 1 0 1.658l.916.805-1 1.732-1.156-.391c-.41.37-.898.655-1.435.83L19 21h-2l-.24-1.196a3.996 3.996 0 0 1-1.434-.83l-1.156.392-1-1.732.916-.805a4.017 4.017 0 0 1 0-1.658l-.916-.805 1-1.732 1.156.391c.41-.37.898-.655 1.435-.83L17 11h2l.24 1.196c.536.174 1.024.46 1.434.83zM18 18a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" />
                                </svg></button>
                        </header>
                        <div class="mt-5 flex h-[210px] flex-col space-y-1 overflow-y-auto">
                            {{-- orders --}}
                            <template x-for="(order,index) in orders"
                                :key="order.id">
                                <div class="order relative flex space-x-2 rounded-lg bg-gray-50 p-2">
                                    <div class="absolute -top-2 -right-3 grid place-content-center">
                                        <button x-on:click="removeOrder(order.id)"
                                            class="fill-red-500 hover:fill-red-700">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24"
                                                class="h-6 w-6">
                                                <path fill="none"
                                                    d="M0 0h24v24H0z" />
                                                <path
                                                    d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-11.414L9.172 7.757 7.757 9.172 10.586 12l-2.829 2.828 1.415 1.415L12 13.414l2.828 2.829 1.415-1.415L13.414 12l2.829-2.828-1.415-1.415L12 10.586z" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="grid h-12 w-12 place-content-center rounded-lg bg-green-600">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            class="h-6 w-6 fill-white">
                                            <path fill="none"
                                                d="M0 0h24v24H0z" />
                                            <path
                                                d="M15.366 3.438L18.577 9H22v2h-1.167l-.757 9.083a1 1 0 0 1-.996.917H4.92a1 1 0 0 1-.996-.917L3.166 11H2V9h3.422l3.212-5.562 1.732 1L7.732 9h8.535l-2.633-4.562 1.732-1zM13 13h-2v4h2v-4zm-4 0H7v4h2v-4zm8 0h-2v4h2v-4z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 flex-col">
                                        <h1 class="font-semibold text-gray-600"
                                            x-text="order.name"></h1>
                                        <div class="flex justify-between">
                                            <h1 class="text-sm font-semibold text-green-600">
                                                &#8369; <span x-text="getPrice(order.price,order.quantity)"></span></h1>
                                            <div class="flex items-center space-x-3 text-sm">
                                                <button
                                                    x-on:click="order.quantity > 1 ? subtractQuantity(order.id) : removeOrder(order.id)"
                                                    class="grid place-content-center rounded bg-green-500 p-0.5 px-2 font-semibold text-white shadow hover:bg-green-600">
                                                    <span>-</span>
                                                </button>
                                                <div class="font-semibold text-gray-600"
                                                    x-text="order.quantity"></div>
                                                <button x-on:click="addQuantity(order.id)"
                                                    class="grid place-content-center rounded bg-green-500 p-0.5 px-2 font-semibold text-white shadow hover:bg-green-600">
                                                    <span>+</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                        <div class="absolute bottom-0 left-0 w-full px-4 pb-4">
                            <div class="flex flex-col space-y-3">
                                <div
                                    class="relative flex h-40 flex-col justify-between overflow-hidden rounded-lg bg-gray-100 before:absolute before:bottom-[2.5rem] before:-left-2 before:h-5 before:w-5 before:rounded-full before:bg-white after:absolute after:bottom-[2.5rem] after:-right-2 after:h-5 after:w-5 after:rounded-full after:bg-white">
                                    <div class="flex flex-1 flex-col justify-between">
                                        <section class="p-3">
                                            <h1 class="font-bold uppercase text-gray-600">Order Summary</h1>
                                            <h1 class="text-xs leading-3 text-red-500">
                                                {{ $guest ? $guest->name : '' }}
                                            </h1>
                                            <div class="mt-4 flex justify-between text-gray-600">
                                                <dt>Subtotal</dt>
                                                <dd class="">&#8369; <span x-text="getSubTotal()"></span>
                                                </dd>
                                            </div>
                                        </section>
                                        <section class="border border-dashed border-gray-400"></section>
                                    </div>
                                    <section class="p-3">
                                        <div class="flex justify-between text-green-600">
                                            <dt class="font-bold">Total</dt>
                                            <dd class="font-semibold">
                                                &#8369;<span x-text="getTotal()"></span>
                                            </dd>
                                        </div>
                                    </section>
                                </div>
                                <button x-on:click="hasGuest ? $dispatch('confirm-order') : ''"
                                    x-bind:disabled="!hasGuest || !orders.length"
                                    class="rounded-lg bg-green-500 py-2 font-semibold text-white hover:bg-green-600 disabled:cursor-not-allowed">
                                    <span>Check Order</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div x-show="!hasGuest"
                        class="flex h-full w-full items-center justify-center">
                        <span class="font-semibold uppercase text-red-600">
                            Please select guest !
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </x-content>
    <x-confirm name="order"
        title="Confirm Order"
        message="Are you sure you want to checkout this order ?"
        onConfirm="saveOrder()" />
</div>
