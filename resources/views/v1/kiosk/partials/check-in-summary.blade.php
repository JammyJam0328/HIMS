<div class="relative p-5 overflow-hidden rounded-lg shadow-lg bg-gray-50">
    <svg class="absolute w-64 h-64 -bottom-14 left-32 opacity-10"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 24 24"
        fill="currentColor">
        <path
            d="M15,3H5C3.9,3,3.01,3.9,3.01,5L3,19c0,1.1,0.89,2,1.99,2H19c1.1,0,2-0.9,2-2V9L15,3z M5,19V5h9v5h5v9H5z M9,8 c0,0.55-0.45,1-1,1S7,8.55,7,8s0.45-1,1-1S9,7.45,9,8z M9,12c0,0.55-0.45,1-1,1s-1-0.45-1-1s0.45-1,1-1S9,11.45,9,12z M9,16 c0,0.55-0.45,1-1,1s-1-0.45-1-1s0.45-1,1-1S9,15.45,9,16z">
        </path>
    </svg>
    <h1 class="text-xl font-bold text-gray-600 uppercase">
        Check In Summary
    </h1>
    <dl class="mt-8 text-sm divide-y divide-gray-200 lg:col-span-7 lg:pr-8">
        <div class="flex items-center justify-between pb-4">
            <dt class="text-gray-600">ROOM NUMBER</dt>
            <dd class="font-medium text-gray-900">
                ROOM # {{ $roomNumber }}
            </dd>
        </div>
        <div class="flex items-center justify-between py-4">
            <dt class="text-gray-600">ROOM TYPE</dt>
            <dd class="font-medium text-gray-900">
                {{ $roomType }}
            </dd>
        </div>
        <div class="flex items-center justify-between py-4">
            <dt class="text-gray-600">
                STAY DURATION
            </dt>
            <dd class="font-medium text-gray-900">
                @if ($isLongStay)
                    {{ $roomRate?->stayingHour->number * $longStayDays }} Hrs
                @else
                    {{ $roomRate?->stayingHour->hoursWithFormat() }}
                @endif
            </dd>
        </div>
        <div class="flex items-center justify-between py-4">
            <dt class="text-gray-600">
                ROOM AMOUNT
            </dt>
            <dd class="font-medium text-gray-900">
                @if ($isLongStay)
                    ₱ {{ number_format($roomRate?->amount * $longStayDays, 2) }}
                @else
                    ₱ {{ number_format($roomRate?->amount, 2) }}
                @endif
            </dd>
        </div>
        <div class="flex items-center justify-between py-4">
            <dt class="text-gray-600">
                DEPOSIT AMOUNT (Room Key and TV Remote)
            </dt>
            <dd class="font-medium text-gray-900">
                ₱ 200.00
            </dd>
        </div>
        <div class="flex items-center justify-between pt-4">
            <dt class="text-lg font-bold text-gray-900">TOTAL</dt>
            <dd class="text-lg font-bold text-red-600">
                @if ($isLongStay)
                    ₱ {{ number_format($roomRate?->amount * $longStayDays + 200, 2) }}
                @else
                    ₱ {{ number_format($roomRate?->amount + 200, 2) }}
                @endif
            </dd>
        </div>
    </dl>
</div>
