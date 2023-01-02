<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $guarded = [];

    const STATUSES = [
        'IN_KIOSK' => 'In Kiosk',
        'CHECKED_IN' => 'Checked In',
        'CHECKED_OUT' => 'Checked Out',
        'CANCELLED' => 'Cancelled',
        'TERMINATED' => 'Terminated',
    ];

    const IN_KIOSK = 'IN_KIOSK';

    const CHECKED_IN = 'CHECKED_IN';

    const CHECKED_OUT = 'CHECKED_OUT';

    const CANCELLED = 'CANCELLED';

    const TERMINATED = 'TERMINATED';

    const TYPES = [
        'WALK_IN' => 'Walk In',
        'RESERVATION' => 'Reservation',
    ];

    const WALK_IN = 'WALK_IN';

    const RESERVATION = 'RESERVATION';

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function roomType()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }

    public function staying_hours()
    {
        return $this->hasMany(StayingHour::class);
    }

    public function rate()
    {
        return $this->belongsTo(Rate::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }
    public function roomCheckinInterval()
    {
        return $this->hasOne(RoomCheckinInterval::class);
    }

    public function roomTransfers()
    {
        return $this->hasMany(RoomTransfer::class);
    }
}
