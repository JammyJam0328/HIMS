<div class="rounded-lg bg-white p-5 shadow-lg">
    <h1 class="text-lg font-semibold">
        Check In Summary
    </h1>
    <dl class="mt-8 divide-y divide-gray-200 text-sm lg:col-span-7 lg:pr-8">
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
                {{ $roomRate?->stayingHour->hoursWithFormat() }}
            </dd>
        </div>
        <div class="flex items-center justify-between py-4">
            <dt class="text-gray-600">
                ROOM AMOUNT
            </dt>
            <dd class="font-medium text-gray-900">
                ₱ {{ number_format($roomRate?->amount, 2) }}
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
            <dt class="font-medium text-gray-900">TOTAL</dt>
            <dd class="font-medium text-indigo-600">
                ₱ {{ number_format($roomRate?->amount + 200, 2) }}
            </dd>
        </div>
    </dl>
</div>
