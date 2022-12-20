<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StayingHour extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function hoursWithFormat()
    {
        return \Str::plural($this->number.' Hr', $this->number);
    }
}
