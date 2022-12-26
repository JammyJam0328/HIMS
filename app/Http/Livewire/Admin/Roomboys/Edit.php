<?php

namespace App\Http\Livewire\Admin\Roomboys;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
class Edit extends Component
{

    use WithPagination;
    public $floors = [];
    public $user;
    
    public function rules()
    {
        return [
            'user.name' => 'required',
            'user.email' => 'required|email|unique:users,email,'.$this->user->id,
            'user.email_verified_at' => 'nullable|date',
            'user.last_transaction_at' => 'nullable|date',
            'user.branch_id' => 'nullable',
            'user.branch_name' => 'nullable',
            'user.room_boy_assigned_floor_id' => 'nullable',
            'user.room_boy_cleaning_room_id'=> 'nullable',
        ];
    }

    public function update()
    {

        $this->validate();
        DB::beginTransaction();
        
        $this->user->save();

        $this->user->assignRole('roomboy');

        DB::commit();

        session()->flash('alert',[
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Roomboy updated successfully',
        ]);

        return redirect()->route('admin.roomboys');
    }

    public function mount($roomboy)
    {
        abort_unless($this->user = User::find($roomboy), 404);
        $this->floors = auth()->user()->branch->floors;
    }
    public function render()
    {
        return view('livewire.admin.roomboys.edit');
    }
}
