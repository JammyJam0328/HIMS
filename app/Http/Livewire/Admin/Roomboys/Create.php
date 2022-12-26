<?php

namespace App\Http\Livewire\Admin\Roomboys;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Create extends Component
{
    use WithPagination;
    public $floors = [];
    public $user;
    
    public function rules()
    {
        return [
            'user.name' => 'required',
            'user.email' => 'required|email|unique:users,email',
            'user.password' => 'nullable|min:8',
            'user.email_verified_at' => 'nullable|date',
            'user.last_transaction_at' => 'nullable|date',
            'user.branch_id' => 'nullable',
            'user.branch_name' => 'nullable',
            'user.room_boy_assigned_floor_id' => 'nullable',
            'user.room_boy_cleaning_room_id'=> 'nullable',
        ];
    }

    public function store()
    {
        $this->validate();
        DB::beginTransaction();
        $this->user->password = bcrypt('password');
        
        $this->user->save();

        $this->user->assignRole('roomboy');

        DB::commit();

        session()->flash('alert',[
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Roomboy created successfully',
        ]);

        return redirect()->route('admin.roomboys');
    }

    public function mount()
    {
        $this->floors = auth()->user()->branch->floors;

        $this->user = User::make([
            'branch_id' => auth()->user()->branch_id,
            'branch_name' => auth()->user()->branch->name,
        ]);
    }

    public function render()
    {
        return view('livewire.admin.roomboys.create');
    }
}
