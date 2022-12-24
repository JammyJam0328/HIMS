<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomTransfer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public function fromRoom()
    {
        return $this->belongsTo(Room::class, 'from_room_id');
    }

    public function toRoom()
    {
        return $this->belongsTo(Room::class, 'to_room_id');
    }

    public function fromType()
    {
        return $this->belongsTo(Type::class, 'from_type_id');
    }

    public function toType()
    {
        return $this->belongsTo(Type::class, 'to_type_id');
    }
}
