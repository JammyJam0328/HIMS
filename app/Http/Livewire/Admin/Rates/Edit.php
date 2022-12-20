<?php

namespace App\Http\Livewire\Admin\Rates;

use App\Models\Rate;
use App\Models\StayingHour;
use App\Models\Type;
use Livewire\Component;

class Edit extends Component
{
    public $rate;

    public $stayingHours = [];

    protected $validationAttributes = [
        'rate.branch_id' => 'branch',
        'rate.staying_hour_id' => 'staying hour',
        'rate.type_id' => 'type',
        'rate.amount' => 'amount',
    ];

    protected $messages = [
        'rate.staying_hour_id.unique' => 'Staying Hour must be unique in each type',
        'rate.amount.unique' => 'Amount must be unique in each type and staying hour',
    ];

    public function rules()
    {
        return [
            'rate.branch_id' => 'nullable',
            // staying hour id must be unique in each type in the same branch except the current record
            'rate.staying_hour_id' => 'required|in:'.$this->stayingHours->pluck('id')->implode(',').'|unique:rates,staying_hour_id,'.$this->rate->id.',id,type_id,'.$this->rate->type_id.',branch_id,'.auth()->user()->branch_id,
            'rate.type_id' => 'required|in:'.$this->types->pluck('id')->implode(','),
            'rate.amount' => 'required|numeric|min:0',
        ];
    }

    public function hasDuplicates()
    {
        $branchId = auth()->user()->branch_id;

        return  Rate::whereBranchId($branchId)
                   ->where('staying_hour_id', $this->rate->staying_hour_id)
                   ->where('type_id', $this->rate->type_id)
                   ->where('amount', $this->rate->amount)
                   ->where('id', '!=', $this->rate->id)
                   ->exists();
    }

    public function update()
    {
        $this->validate();

        if ($this->hasDuplicates()) {
            $this->addError('rate.amount', 'Duplicate record found');

            return;
        }

        $this->rate->save();

        session()->flash('alert', [
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Record has been created successfully',
        ]);

        return redirect()->route('admin.rates');
    }

    public function mount($rate)
    {
        \abort_unless($this->rate = Rate::find($rate), 404);

        $branchId = auth()->user()->branch_id;

        $this->types = Type::whereBranchId($branchId)->get();

        $this->stayingHours = StayingHour::whereBranchId($branchId)->get();
    }

    public function render()
    {
        return view('livewire.admin.rates.edit');
    }
}
