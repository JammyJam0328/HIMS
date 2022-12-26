<?php

namespace App\Http\Livewire\Admin\Roomboys;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
class Index extends Component
{
    use WithPagination;

    public $search ='';

    public $filterFloor ='';

    public $floors = [];


    public function mount()
    {
        $this->floors = auth()->user()->branch->floors;
    }

    public function render()
    {
        return view('livewire.admin.roomboys.index',[
            'users' => User::role('roomboy')
                        ->when(strlen($this->search) > 2 , function($query){
                           $query->where('name','like','%'.$this->search.'%')
                                ->orWhere('email','like','%'.$this->search.'%');
                        })
                        ->when($this->filterFloor != '', function($query){
                            $query->whereRoomBoyAssignedFloorId($this->filterFloor);
                        })
                        ->paginate(10)
        ]);
    }
}
