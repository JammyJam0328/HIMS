<?php

namespace App\Http\Livewire\Frontdesk\Transactions\Extend;

use Carbon\Carbon;
use App\Models\Rate;
use App\Models\Guest;
use App\Models\Extend;
use Livewire\Component;
use App\Models\StayingHour;
use App\Models\Transaction;
use App\Traits\WithCaching;
use App\Models\ExtensionRate;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests , WithCaching;

    public $guest;

    public $extensionRates = [];

    public $extensionId;
    public $extensionHour;
    public $extensionAmount = 0;

    public $totalAmountToPay = 0;

    public $additionalAmount = 0;

    public function updatedExtensionId()
    {
        DB::beginTransaction();
        $guestTotalHours = $this->guest->staying_hours;
        $extensionRate = $this->extensionRates->find($this->extensionId);
        $expectedTotalHours = $extensionRate->hour + $guestTotalHours;
        $branchResettingHour =  auth()->user()->branch->setting_extension_resetting_hours;

        if ($expectedTotalHours % $branchResettingHour == 0) {
            $this->extensionAmount = $extensionRate->amount;
        }else{
            if ($expectedTotalHours < $branchResettingHour) {
                $this->extensionAmount = $extensionRate->amount;
            }else{
                $remainderHour = $expectedTotalHours % $branchResettingHour;
                // ex. guest total hours is 18 and wants to add 12 hours, the total hours will be 30
                // 6 hours was added to make the reseting hour 24 and the remaining 6 hours will be added to the next day
                // the amount of 6 hours to make the resetting hour 24 is from the extension rate
                // the amount of 6 hours to add to the next day is from the Rate table
                $hoursAddedBeforeRemainder = $extensionRate->hour - $remainderHour;
                $hoursAddedBeforeRemainderAmount = ExtensionRate::whereBranchId(auth()->user()->branch_id)
                                                                ->whereHour($hoursAddedBeforeRemainder)
                                                                ->first()->amount;
                $remainderAmount = Rate::whereBranchId(auth()->user()->branch_id)
                                   ->whereTypeId($this->guest->type_id)
                                   ->whereHas('stayingHour', function ($query) use ($remainderHour) {
                                       $query->where('number','<=', $remainderHour);
                                   })
                                   ->first()->amount;

                $this->extensionAmount = $hoursAddedBeforeRemainderAmount + $remainderAmount;
            }
        }

        $this->totalAmountToPay = $this->extensionAmount + $this->additionalAmount;

        $this->extensionHour = $extensionRate->hour;
        
        DB::commit();
    }

    public function updatedAdditionalAmount()
    {
       $this->totalAmountToPay =  $this->additionalAmount != '' ?  $this->extensionAmount + $this->additionalAmount : $this->extensionAmount;
    }

    public function getTransactionsProperty()
    {
        return $this->cache(function(){
            return $this->guest->transactions()->whereType(Transaction::EXTENSION)->get();
        });
    }

    public function saveExtend()
    {
        $this->validate([
            'extensionId'=>'required',
            'additionalAmount'=>'nullable|numeric',
        ]);


        DB::beginTransaction();
       
        Extend::create([
            'branch_id'=>auth()->user()->branch_id,
            'room_id'=>$this->guest->room_id,
            'type_id'=>$this->guest->type_id,
            'floor_id'=>$this->guest->floor_id,
            'guest_id'=>$this->guest->id,
            'extension_rate_id'=>$this->extensionId,
            'room_number'=>$this->guest->room_number,
            'floor_number'=>$this->guest->floor->number,
            'type_name'=>$this->guest->roomType->name,
            'hours'=>$this->extensionHour,
            'total_hours'=>$this->guest->staying_hours + $this->extensionHour,
            'amount'=>$this->totalAmountToPay,
        ]);

        Transaction::create([
            'branch_id' => auth()->user()->branch_id,
            'floor_id' => $this->guest->room->floor_id,
            'room_id' => $this->guest->room_id,
            'guest_id' => $this->guest->id,
            'description' => 'Extend for : '.$this->extensionHour.' hours',
            'type' => Transaction::EXTENSION,
            'payable_amount' => $this->totalAmountToPay,
        ]);

        $this->guest->update([
            'staying_hours'=>$this->guest->staying_hours + $this->extensionHour,
            'expected_checkout_at'=>Carbon::parse($this->guest->expected_checkout_at)->addHours($this->extensionHour),
            'extended_hours' => $this->guest->extended_hours + $this->extensionHour,
        ]);

        $this->guest->room->update([
            'check_out_time'=>Carbon::parse($this->guest->expected_checkout_at)->addHours($this->extensionHour),
        ]);

        DB::commit();

        $this->dispatchBrowserEvent('alert', [
            'type' =>'success',  
            'title' => 'Syuccess', 
            'message' => 'Guest extended successfully',
        ]);
        $this->dispatchBrowserEvent('close-form');
        $this->guest->refresh();
    }
    public function mount($guest)
    {
        abort_unless($this->guest = Guest::find($guest), 404);
        $this->authorize('view', $this->guest);

        $this->extensionRates = ExtensionRate::whereBranchId(auth()->user()->branch_id)->get();

    }
    public function render()
    {
        return view('livewire.frontdesk.transactions.extend.index',[
            'transactions'=>$this->transactions,
        ]);
    }
}


// $guestTotalHours = $this->guest->staying_hours;
// $extensionRate = $this->extensionRates->find($extensionId);
// $expectedTotalHours = $extensionRate->hour + $guestTotalHours;
// $branchResettingHour =  uth()->user()->branch->setting_extension_resetting_hours;

// $resetHoursAmount = StayingHour::whereBranchId(auth()->user()->branch_id)
//                     ->where('number', '>=', $extensionRate->hour)
//                     ->orderBy('number', 'ASC')
//                     ->first()
//                     ->rates()
//                     ->whereTypeId($this->guest->type_id)
//                     ->first()->amount;

// $branchResettingRate = Rate::whereBranchId(auth()->user()->branch_id)
//                        ->whereTypeId($this->guest->type_id)
//                        ->whereHas('stayingHour', function ($query) use ($branchResettingHour) {
//                            $query->where('number', $branchResettingHour);
//                        })->first();

//  if ($expectedTotalHours % $branchResettingHour == 0) {
//         if ($extensionRate->hour < $branchResettingHour) {
//             $this->extensionAmount = $resetHoursAmount;
//         }else{
//             $days = floor($extensionRate->hour / $branchResettingHour);
//             $hours = $extensionRate->hour % $branchResettingHour;
//             $dailyAmount = $branchResettingRate->amount * $days;
//             $hourlyRateAmount = $hours > 0 ? Rate::whereTypeId($this->guest->type_id)
//                 ->whereHas('stayingHour', function ($query) use ($hours) {
//                     $query->where('number', '>=', $hours);
//                 })->first()->amount : 0;
//             $totalExtendAmount = StayExtension::whereHas('transaction', function ($query) {
//                 $query->where('guest_id', $this->guestId);
//             })->sum('amount');
//             $totalCheckedInAmountAndExtensionAmount = $this->checkInDetailRoomRateAmount + $totalExtendAmount;
//             $total_amount = $dailyAmount + $hourlyRateAmount;
//             $this->extensionAmount =  $total_amount - $totalCheckedInAmountAndExtensionAmount;
//         }
//     } 

