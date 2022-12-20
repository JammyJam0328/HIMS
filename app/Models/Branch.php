<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function frontdesk()
    {
        return $this->hasOne(Frontdesk::class);
    }

    public function floors()
    {
        return $this->hasMany(Floor::class);
    }

    public function rooms()
    {
        return $this->hasManyThrough(Room::class, Floor::class);
    }

    public function guests()
    {
        return $this->hasManyThrough(Guest::class, Room::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function roomTypes()
    {
        return $this->hasMany(Type::class, 'branch_id');
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function amenities()
    {
        return $this->hasMany(Amenities::class);
    }

    public function assets()
    {
        return $this->hasMany(Asset::class);
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }
}
