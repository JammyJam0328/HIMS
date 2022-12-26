<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $guarded = [];

    const STATUSES = [
        'AVAILABLE' => 'Available',
        'SELECTED_IN_KIOSK' => 'Selected in Kiosk',
        'OCCUPIED' => 'Occupied',
        'OUT_OF_ORDER' => 'Out of Order',
        'CLEANING' => 'Cleaning',
        'UNCLEAN' => 'Unclean',
        'CLEANED' => 'Cleaned',
        'RESERVED' => 'Reserved',
    ];

    const AVAILABLE = 'AVAILABLE';

    const SELECTED_IN_KIOSK = 'SELECTED_IN_KIOSK';

    const OCCUPIED = 'OCCUPIED';

    const OUT_OF_ORDER = 'OUT_OF_ORDER';

    const CLEANING = 'CLEANING';

    const UNCLEAN = 'UNCLEAN';

    const CLEANED = 'CLEANED';

    const RESERVED = 'RESERVED';

    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function guests()
    {
        return $this->hasMany(Guest::class);
    }

    public function numberWithFormat()
    {
        return 'ROOM #'.$this->number;
    }

    public function statusClass()
    {
        return match ($this->status) {
            self::AVAILABLE => 'test-green-700 bg-green-100',
            self::SELECTED_IN_KIOSK => 'test-yellow-700 bg-yellow-100',
            self::OCCUPIED => 'test-red-700 bg-red-100',
            self::OUT_OF_ORDER => 'test-gray-700 bg-gray-100',
            self::CLEANING => 'test-blue-700 bg-blue-100',
            self::UNCLEAN => 'test-orange-700 bg-orange-100',
            self::CLEANED => 'test-purple-700 bg-purple-100',
            self::RESERVED => 'test-indigo-700 bg-indigo-100',
            default => 'test-gray-700 bg-gray-100',
        };
    }

    public function statusWithFormat()
    {
        return str_replace('_', ' ', $this->status);
    }


    public function user()
    {
        return $this->belongsTo(user::class,'room_boy_cleaning_room_id');
    }

}
