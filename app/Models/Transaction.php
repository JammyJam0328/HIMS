<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = [];

    const TYPES = [
        'checked_in_room' => 'Checked In',
        'food' => 'Food',
        'laundry' => 'Laundry',
        'load' => 'Load',
        'extension' => 'Extension',
        'amenities' => 'Amenities',
        'beverage' => 'Beverage',
        'damage' => 'Damage',
        'transfer_room' => 'Transfer Room',
    ];

    const CHECKED_IN_ROOM = 'checked_in_room';

    const FOOD = 'food';

    const LAUNDRY = 'laundry';

    const LOAD = 'load';

    const EXTENSION = 'extension';

    const AMENITIES = 'amenities';

    const BEVERAGE = 'beverage';

    const DAMAGE = 'damage';

    const TRANSFER_ROOM = 'transfer_room';

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function frontdesks()
    {
        return \json_decode($this->frontdesks);
    }
}
