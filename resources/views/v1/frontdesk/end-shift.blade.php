@extends('layouts.root')

@section('content')
    <div x-data="{
        printDiv(divName) {
            document.title = ' @php foreach ($frontdesks as $key => $frontdesk) {
                        echo $frontdesk->employee->name;
                        if ($key != count($frontdesks) - 1) {
                            echo "and" ;
                        }
                    } echo ' - ' . now()->format('l F d, Y') . ' Shift Report'; @endphp';
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    }">
        <div class="flex items-center p-10 space-x-3">
           @livewire('frontdesk.endshift')
            <x-button.primary x-on:click="printDiv('reports')">Print</x-button.primary>
        </div>
        <div id="reports"
            class="grid">
            <div class="flex justify-center">
                <h1 class="font-mono text-xl">
                    DAILY SHIFT REPORT
                </h1>
            </div>
            <div class="mt-10">
                <table class="w-full text-sm uppercase border border-black table-auto">
                    <tbody>
                        <tr>
                            <td class="px-10 py-2 text-gray-600 border border-black w-60">DATE</td>
                            <td class="px-10 py-2 border border-black">
                                {{ now()->format('l F d, Y') }}
                            </td>
                        </tr>
                        <tr>
                            <td class="px-10 py-2 text-gray-600 border border-black w-60">Front Desk</td>
                            <td class="px-10 py-2 border border-black">
                                @foreach ($frontdesks as $frontdesk)
                                    <span class="font-semibold"> {{ $frontdesk->employee->name }}</span>
                                    @if (!$loop->last)
                                        and
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td class="px-10 py-2 text-gray-600 border border-black w-60">Shift</td>
                            <td class="px-10 py-2 border border-black">
                                {{ \Carbon\Carbon::parse($frontdesks->first()->time_in)->format('A') }}
                            </td>
                        </tr>
                        <tr>
                            <td class="px-10 py-2 text-gray-600 border border-black w-60">Time Logged In</td>
                            <td class="px-10 py-2 border border-black">
                                {{ \Carbon\Carbon::parse($frontdesks->first()->time_in)->format('h:i:s A') }}
                            </td>
                        </tr>
                        <tr>
                            <td class="px-10 py-2 text-gray-600 border border-black w-60">Time Logged Out</td>
                            <td class="px-10 py-2 border border-black">
                                {{ \Carbon\Carbon::parse($frontdesks->first()->time_out)->format('h:i:s A') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mt-10">
                <table class="w-full text-sm uppercase border border-black table-auto">
                    <thead class="bg-gray-200 border-b border-black">
                        <th colspan="10"
                            class="py-3">
                            <span class="text-2xl font-semibold">SUMMARY</span>
                        </th>
                    </thead>
                    <thead class="border-b border-black">
                        <th class="py-2 text-gray-500">
                            FLOOR
                        </th>
                        <th class="py-2 text-gray-500">
                            ROOM
                        </th>
                        <th class="py-2 text-gray-500">
                            FOOD
                        </th>
                        <th class="py-2 text-gray-500">
                            DRINKS
                        </th>
                        <th class="py-2 text-gray-500">
                            LOAD
                        </th>
                        <th class="py-2 text-gray-500">
                            INTERNET
                        </th>
                        <th class="py-2 text-gray-500">
                            MISCELLANEOUS
                        </th>
                        <th class="py-2 text-gray-500">
                            EXCESS CHARGES
                        </th>
                        <th class="py-2">
                            GROSS TOTAL
                        </th>
                        <th class="py-2">
                            TOTAL DEPOSITS
                        </th>
                    </thead>
                    <tbody>
                        @foreach ($floors as $floor)
                            <tr class="border border-black">
                                <td class="p-2 border border-black">
                                    {{ $floor->numberWithFormat() }}
                                </td>
                                <td class="p-2 border border-black">
                                    @php
                                        $transaction = $transactions[$floor->id] ?? 0;
                                    @endphp
                                    @if ($transaction)
                                        ₱
                                        {{ number_format($transaction->where('type', \App\Models\Transaction::CHECKED_IN_ROOM)->sum('payable_amount') + $transaction->where('type', \App\Models\Transaction::EXTENSION)->sum('payable_amount') + $transaction->where('type', \App\Models\Transaction::TRANSFER_ROOM)->sum('payable_amount') + $transaction->where('type', \App\Models\Transaction::AMENITIES)->sum('payable_amount'), 2) }}
                                    @else
                                        ₱ 00
                                    @endif
                                </td>
                                <td class="p-2 border border-black">
                                    ₱ 00.00
                                </td>
                                <td class="p-2 border border-black">
                                    ₱ 00.00
                                </td>
                                <td class="p-2 border border-black">
                                    ₱ 00.00
                                </td>
                                <td class="p-2 border border-black">
                                    ₱ 00.00
                                </td>
                                <td class="p-2 border border-black">
                                    ₱ 00.00
                                </td>
                                <td class="p-2 border border-black">
                                    ₱ 00.00
                                </td>
                                <td
                                    class="{{ !$loop->last ? 'border-b-white' : 'border-b-black' }} border border-t-black bg-black p-2 text-white">
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach (\App\Models\Transaction::TYPES as $key => $type)
                                        @php
                                            $transaction = $transactions[$floor->id] ?? 0;
                                        @endphp
                                        @if ($transaction)
                                            @php
                                                $total += $transaction->where('type', $key)->sum('payable_amount');
                                            @endphp
                                        @endif
                                    @endforeach
                                    @if ($total > 0)
                                        ₱ {{ number_format($total, 2) }}
                                    @else
                                        ₱ 00.00
                                    @endif
                                </td>
                                <td class="p-2 border border-black">
                                    @php
                                        $deposit = $deposits[$floor->id] ?? 0;
                                    @endphp
                                    @if ($deposit)
                                        ₱ {{ number_format($deposit->sum('amount'), 2) }}
                                    @else
                                        ₱ 00.00
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-10">
                <table class="w-full text-sm uppercase border border-black table-auto">
                    <tbody>
                        <tr class="bg-orange-600">
                            <td class="w-[380px] border border-black px-10 py-2">TOTAL NEW GUEST</td>
                            <td class="px-10 py-2 pr-10 text-right border border-black">
                                {{ $new_guest_count }}
                            </td>
                        </tr>
                        <tr class="bg-yellow-400">
                            <td class="w-[380px] border border-black px-10 py-2">TOTAL EXTENDED GUEST</td>
                            <td class="px-10 py-2 pr-10 text-right border border-black">
                                {{ $unique_extensions_today_count }}
                            </td>
                        </tr>
                        <tr class="bg-green-400">
                            <td class="w-[380px] border border-black px-10 py-2">TOTAL # OF ORDER SLIP</td>
                            <td class="px-10 py-2 pr-10 text-right border border-black">
                                0
                            </td>
                        </tr>
                        <tr class="bg-pink-300">
                            <td class="w-[380px] border border-black px-10 py-2">TOTAL # OF UNOCCUPIED ROOM</td>
                            <td class="px-10 py-2 pr-10 text-right border border-black">
                                {{ count($unoccupied_rooms) }}
                            </td>
                        </tr>
                        <tr class="">
                            <td colspan="2"
                                class="px-10 py-2 pr-10 text-right border border-black">
                                UNOCCUPIED ROOMS:
                            </td>
                        </tr>
                        <tr class="">
                            <td colspan="2"
                                class="px-10 py-2 pr-10 text-right border border-black">
                                @foreach ($unoccupied_rooms as $rooms)
                                    {{ $rooms->number }}
                                    @if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
