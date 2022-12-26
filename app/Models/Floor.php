<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function numberWithFormat()
    {
        $ends = ['th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th'];
        if ((($this->number % 100) >= 11) && (($this->number % 100) <= 13)) {
            return $this->number.'th'.' Floor';
        } else {
            return $this->number.$ends[$this->number % 10].' Floor';
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class,'room_boy_assigned_floor_id');
    }
}
