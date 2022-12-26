<?php

namespace App\Http\Livewire\Admin\Roomboys;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
class Index extends Component
{
    use WithPagination;

    public $search ='';

    public function render()
    {
        return view('livewire.admin.roomboys.index',[
            'users' => User::role('roomboy')
                        ->when(strlen($this->search) > 2 , function($query){
                           $query->where('name','like','%'.$this->search.'%')
                                ->orWhere('email','like','%'.$this->search.'%');
                        })
                        ->paginate(10)
        ]);
    }
}
